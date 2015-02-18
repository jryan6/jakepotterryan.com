<?php
	class API{ //code modified from : http://blog.chrisdlangton.com/ - REST API logic such as authentication, processing request headers, storing request paths, processing request data, and setting response http headers. 
			//hard coded directories, change these if the file ever moves. set via __construct
		public $fsToHere; #hardcoded fs directory to here
		public $root; # hardcoded web root directory

			//production and debug flags
		static public $IN_PRODUCTION=false;
		static public $IS_SILENT=false;

			//request level parameters. Parsed from URL or $_SERVER variables
		public $method;
		public $resource; //1st parameter, /api/resource/id/field
		public $id; //2nd parameter, /api/resource/id/field
		public $field; //3rd parameter, /api/resource/id/field
		public $data=NULL;
		public $httpAccept;
		public $httpContentType;
		public $body;

		function __construct(){

				//hardcoded FS and URL paths
			$this->root = ((@$_SERVER["HTTPS"])?'https://':'http://').$_SERVER["SERVER_NAME"]."/~cdavenp1/blink"; //Hardcoded root directory, accounts for localhost; oldcode ($_SERVER["SERVER_NAME"]=="localhost")? conditional
				//$fsToHere in output, for logfile

				//HTTP REQUEST
			$this->method = strtolower($_SERVER['REQUEST_METHOD']);
			$this->url=$_SERVER['PHP_SELF']; //php_self
			@$this->httpOrigin=$_SERVER['HTTP_ORIGIN']; 
			@$this->content=$_SERVER['CONTENT_TYPE']; //content type
			@$this->boolJson=(strpos(strtolower($_SERVER['CONTENT_TYPE']), 'json')) ? true:false; //bool for whether or not we are using json $_SERVER['HTTP_ACCEPT']
			@$this->referrer = $_SERVER['HTTP_REFERER'];
			$this->getResourceURL(); #parse the url
				//HTTP REQUEST

				//get data and issue API Request
			$this->data = array();
			$this->getData(); # load the page payload, put it into $data
			$this->loadDAO(); #loads Database Access Object, see template.dao.php for reference, dies if not found
			$this->execDAO(); #executes overridden methods on overridden DAO, dies if improper http verb
				//should have responded by now, once it has executed the DAO or encountered an error. Just incase, let's issue an error.
			$this->output(array("status"=>"Error", "code"=>"500", "err"=>"End Of File Without Response", "location"=>"class.api.php")); 
		}

		public static function output($value=''){ //debug function, can take array, object, or string. Make Console.log mode IF Production, and Error Response
			date_default_timezone_set('America/New_York');
			$dt=date('Y.m.d.H:i:s-',$_SERVER['REQUEST_TIME']); // convert UNIX timestamp to PHP DateTime
			$fsToHere = ($_SERVER["SERVER_NAME"]=="localhost")?"/var/www/~cdavenp1/blink/api/m":"/users/c/d/cdavenp1/public_html/blink/api/m"; //hardcoded fs directory to here
			$logFile=$fsToHere.'/log.txt';
			$btr=debug_backtrace();
			
			// echo "<pre>"; //uncomment these for a LOT of information
			// print_r($btr);
			// echo "</pre>";
			
			$line=$btr[0]['line']; 
			$file=basename($btr[0]['file']); 

			if (API::$IN_PRODUCTION){ //outputs API responses instead of debugs
				if( is_array($value) ){	//array was passed in with "status", meaning its probably a page response.
					$value=array_change_key_case($value,CASE_LOWER);
					if (isset($value["status"] ) ){
						if(is_numeric($value["code"]) || ctype_digit($value["code"]) ){ //the first section of the string was numeric
							//print_r($value);
							switch ($value["code"] ) { 
								//submit a success page
								case "200": //ok     
								case "202": //accepted 
								case '302': // found
								case '201': // created
								case "otherDataResponseCodes":
									##### TODO LOG FILE
									$body = (isset($value['data'])) ? json_encode($value['data']):'';
									$contentType = (isset($value['data'])) ? 'application/json':'text/html';
									error_log ($dt." success: ".$value["data"]." location: ".$value["location"]." user-agent: ".$_SERVER['HTTP_USER_AGENT']."\n", 3, $logFile);
									API::respond($status = $value['code'], $body, $contentType );

								default: //submit an error page    
								//304 (not modified)
								//400 (bad request)
								//404(not found)
								//409(conflict)
									$bodyArr = array(); #implode/join strings into an array for json?
									$bodyArr["err"]=@$value['err'];
									$bodyArr["location"]=@$value['location'];
									error_log ($dt." error: ".$value["err"]." location: ".$value["location"]." user-agent: ".$_SERVER['HTTP_USER_AGENT']."\n", 3, $logFile);
									API::respond( $status = $value['code'], $body = json_encode($bodyArr), $contentType = 'application/json');
								exit; //api::respond should have exited the program
							}
						} // /end array code is numeric
					} else {// !"status" in array, probably just a normal array	
						if (!API::$IS_SILENT){
							// print"<pre>"; 
							print_r($value); 
							// print"</pre>\n"; 
						}
					}
				} else { //something other than the response array was passed in, !array
					if (!	API::$IS_SILENT){
						if(is_object($value)){ 
							echo "obj";
							print"<pre>"; 
							var_dump($value); 
							print"</pre>\n";
						}else{ 
							print("<p>&gt;${value}&lt;</p>"); 
						} 
					}
				}
			} else { //not in production, normal debug
				print"<span>----$file:$line</span>"; 
				if(is_array($value)){ 
					print"<pre>"; 
					print_r($value); 
					print"</pre>\n"; 
				}elseif(is_object($value)){ 
					print"<pre>"; 
					var_dump($value); 
					print"</pre>\n";
				}else{ 
					print("<p>&gt;${value}&lt;</p>"); 
				} 
			}
		}

		function getResourceURL(){ //break apart URL, sets class variables resource, id, field according to: www. ... ./api/resource/id/field
			$filtered = array(); $sanitized = array(); #initialize empty arrays
			$arr = explode("/", $_SERVER['PHP_SELF']);
			$filtered = array_slice($arr, array_search('apiEngine.php', $arr)+1 );

			foreach ($filtered as $value) if ($value || $value=="0") $sanitized[] = $this->sanitize($value); #sanitize each, remove blank entries

			unset($filtered); unset($arr); //tidying up, deleting temps
			
			//resource check 
			if ($this->existsAndAlphaNum( $sanitized[0] ) ) $this->resource = array_shift($sanitized); #set resource ##### TODO: include resource checking, based on .dao files?
			else $this->output(array("status"=>"Error", "code"=>"400", "err"=>"Bad Request - Resource Unavailable", "location"=>"getResourceURL@class.api.php") ); // there was no resource
			
			//id check
			if (count($sanitized) && $this->existsAndAlphaNum($sanitized[0] ) ) $this->id = array_shift($sanitized); #set ID
			else if (count($sanitized) ) $this->output(array("status"=>"Error", "code"=>"400", "err"=>"Bad Request - ID Not Acceptable", "location"=>"getResourceURL@class.api.php") ); //id existed but was not clean

			//param check
			if ( count($sanitized) && is_string($sanitized[0]) && $this->existsAndAlphaNum($sanitized[0]) ) {
				$this->field = array_shift($sanitized); #else { $this->output("no param");} # set Parameters (field)
			} else if ( count($sanitized) ) $this->output(array("status"=>"Error", "code"=>"400", "err"=>"Bad Request - Param Not Acceptable", "location"=>"getResourceURL@class.api.php") ); //param existed but was not clean		

			//anything else
			if (count($sanitized)) $this->output(array("status"=>"Error", "code"=>"414", "err"=>"URI Too Large - Too Many Parameters", "location"=>"getResourceURL@class.api.php")); # too many params supplied, die( API::respond( 400 ), or warn? //return a 400 and die
			//$this->output($sanitized);
			unset($sanitized);			
		}

		public function existsAndAlphaNum($string){ //checks if it exists and it is alpha numberic
			return isset($string) && preg_match('/^[A-Za-z0-9@.-_]+$/', $string); //ctype_alnum($string);
		} 

		public static function sanitize($string){ return htmlspecialchars( $string); } // cleans user input strings to prevent injection. used internally
		//MYSQL BIND PARAMS WOULD BE BETTER

		public static function getHttpCode($status){
			// these could be stored better, in an .ini file and loaded via parse_ini_file()
			$codes = Array( #the ones in use are hashed
				100 => 'Continue', 
				101 => 'Switching Protocols',
				200 => 'OK',###
				201 => 'Created',### given for successful post 
				202 => 'Accepted',###
				203 => 'Non-Authoritative Information',
				204 => 'No Content', # DO NOT USE! Browser's won't load the rest of the JSON Content
				205 => 'Reset Content',
				206 => 'Partial Content', # use this instead of a 204
				300 => 'Multiple Choices',
				301 => 'Moved Permanently',
				302 => 'Found',### given for a successful get
				303 => 'See Other',###
				304 => 'Not Modified', ###
				305 => 'Use Proxy',
				306 => '(Unused)',
				307 => 'Temporary Redirect',
				400 => 'Bad Request',### issued upon syntax or validation error in request body
				401 => 'Unauthorized',
				402 => 'Payment Required',
				403 => 'Forbidden',
				404 => 'Not Found',### self explanatory
				405 => 'Method Not Allowed',
				406 => 'Not Acceptable',
				407 => 'Proxy Authentication Required',
				408 => 'Request Timeout',
				409 => 'Conflict', #### issued upon data conflict. If data entry already exists
				410 => 'Gone',
				411 => 'Length Required',
				412 => 'Precondition Failed',
				413 => 'Request Entity Too Large',
				414 => 'Request-URI Too Long',
				415 => 'Unsupported Media Type',
				416 => 'Requested Range Not Satisfiable',
				417 => 'Expectation Failed',
				500 => 'Internal Server Error',
				501 => 'Not Implemented',
				502 => 'Bad Gateway',
				503 => 'Service Unavailable',
				504 => 'Gateway Timeout',
				505 => 'HTTP Version Not Supported'
			);
			return (isset( $codes[$status]) ) ? $codes[$status] : ''; //if the number is on the list, give the status, else return ''
		}

		public function getData(){
			switch ( $this->method ){ //made lowercase in getMethod
				case 'get': $this->data = $_GET; #not really ever going to get data, just resource url and method required for GET
				break;

				case 'post':
					//API::output(file_get_contents( 'php://input' )); //html encoded
					$data = json_decode( file_get_contents( 'php://input' ), true );
					//API::output($data);
					if (!$data){ 
						API::output(array("status"=>"Error", "code"=>"400", "err"=>"JSON Wasn't Parsed Properly", "location"=>"getData@class.api.php"));
					} else {
						$this->data = $data;
					}
				break;

				case 'put': $this->data = json_decode( file_get_contents( 'php://input' ), true ); break;

				case 'delete': break; //there shouldn't be any data, just a URI

				default:
					API::output(array("status"=>"Error", "code"=>"400", "err"=>"An incorrect HTTP method was supplied", "location"=>"getData@class.api.php"));
				break;
			}
		}

		static public function respond($status = 200, $body = '', $contentType = 'text/html'){
			//function to send headers and body in response to API request. At least one input param should be overridden. See getHttpCode for a list of response codes
			header('HTTP/1.1 '.$status .' '. API::getHttpCode($status) );
			header("Content-Type:".$contentType. '; charset=utf-8');
			if($body != ''){
				// send the body
				echo $body;
				exit;
			} else exit; #send headers, there isn't a body.
		}

		function printServer(){ $this->output($_SERVER); }

		function printphp(){ phpinfo(); }

		function execDAO(){ //executes overloaded method on loaded DAO, fails with a 405 if not allowed
			API::output($this->data);
			switch ($this->method) {
				case 'get': @$this->dao->GET($this->id,$this->field); break; #tell DAO to execute overloaded GET
				case 'post': @$this->dao->POST($this->data,$this->id); break;#tell DAO to execute overloaded POST
				case 'put': @$this->dao->PUT($this->data, $this->id,$this->field); break; #tell DAO to execute overloaded PUT
				case 'delete': @$this->dao->DELETE($this->id); break; #tell DAO to execute overloaded DELETE
				default: $this->output(array("status"=>"Error", "code"=>"405", "err"=>"Method Not Allowed", "location"=>"execDAO@class.api.php")); break;	# Somehow its a different HTTP verb.... die here
			}
		}

		function loadDAO(){ //loads DAO modules conditionally, fails with a 404 if not found
			switch ($this->resource) {
				case 'device': require('device.dao.php'); $this->dao = new dao(); break;//overriden object dependent upon load
				case 'user': require('user.dao.php'); $this->dao = new dao(); break;
				//case 'auth': require('auth.dao.php'); $this->dao = new dao(); break;
				// case 'test': require('class.DB.php'); $this->dao = new DB(); break; // $dao->talkTest("yo! sup!");
				default: $this->output( array("status"=>"Error", "code"=>"404", "err"=>"Resource Not Found", "location"=>"loadDAO@class.api.php") ); break; #if not listed above, it doesn't exist, and dies with an error
					########################### MAKE IT AUTO LOCATE RESOURCE.dao FILES???
			}
		}
	}
?>