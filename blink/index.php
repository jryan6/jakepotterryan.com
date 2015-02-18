<!--<?php session_start(); $_SESSION["debug"]=true; //$_SESSION["debug"]=( (isset($_SERVER["REMOTE_USER"]) && ($_SERVER["REMOTE_USER"]=="cdavenp1") ) || $_SERVER["HTTP_HOST"]=="localhost")? true : false; ?>
<?php # MAIN PAGE FOR BLINK WEBSITE
//#### global requires (model functions)
	require_once('m/miscFunctions.php'); //includes debug

//### page init variables
	$url=getURL(); //miscFunctions.php: returns an array with info about the url. uvm.edu/~cdavenp1/blink/store/product/bracelet/1 ["root"=".../blink","dir"="store","subdir"=["product","bracelet","1"]]
	$rootLoc = $url["root"]; //used for absolute links aka most html links
	$pageDesc = "Blink Securities - Your life, secured."; //head.php: meta tag, page description

	if (isset($url["dir"])){ //uvm.edu/~cdavenp1/blink/store/product/... ["dir"="store","subdir"=["product","bracelet","1"]]
		switch ($url["dir"]) {
			case 'phpinfo':
				require_once('v/head.php'); # head, requires $pageDesc (for meta tag), $rootLoc(uvm.edu/~netid/whatever)
				require_once('v/header.php');
				require_once('v/phpinfo.php');
				require_once('v/contactFoot.php');
				require_once('v/footer.php');
				require_once('v/foot.php');
			break;

			case 'debug':
				require_once('v/head.php'); # head, requires $pageDesc (for meta tag), $rootLoc(uvm.edu/~netid/whatever)
				require_once('v/header.php');
				require_once('v/debug.php');
				require_once('v/footer.php');
				require_once('v/foot.php');
			break;
			
			case 'connect':
				require_once('v/head.php'); # head, requires $pageDesc (for meta tag), $rootLoc(uvm.edu/~netid/whatever)
				require_once('v/header.php');
				require_once('v/howtoconnect.html');
				require_once('v/footer.php');
				require_once('v/foot.php');
			break;

			case 'register':
				require_once('v/head.php'); # head, requires $pageDesc (for meta tag), $rootLoc(uvm.edu/~netid/whatever)
				require_once('v/header.php');
				require_once('v/register.php');
				require_once('v/footer.php');
				require_once('v/foot.php');
			break;

			default: // DEFAULT PAGE - if they are at a link that doesn't exist, give them a 404
				require_once('v/head.php'); # head, requires $pageDesc (for meta tag), $rootLoc(uvm.edu/~netid/whatever)
				require_once('v/header.php');
				require_once('v/404.php');
				require_once('v/footer.php');
				require_once('v/foot.php');
			break;
		}
	} else { //just at a directory, serve up just a normal directory page
		require_once('v/head.php'); # head, requires $pageDesc (for meta tag), $rootLoc(uvm.edu/~netid/whatever)
		require_once('v/header.php');
		require_once('v/main.php');
		require_once('v/footer.php');
		require_once('v/foot.php');
	}	

?>-->
<!DOCTYPE html>
<html lang="en">
	<head>
				<meta charset="utf-8">
		<meta name="author" content="Jake P. Ryan">
		<meta name="description" content="Blink Securities - Your life, secured." >
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Blink Securities</title> 
		<script src="http://code.jquery.com/jquery-git.js" type="text/javascript"></script>
        <script src="http://jakepotterryan.com/blink/js/bootstrap.min.js"></script>
		<script src="http://jakepotterryan.com/blink/js/mainPage.js" type="text/javascript"></script>
        <script src="http://jakepotterryan.com/blink/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="http://jakepotterryan.com/blink/js/bootstrap-select.min.js" type="text/javascript"></script>
		<script src='https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?skin=sunburst'></script>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
        <link href="http://jakepotterryan.com/blink/bootstrap.min.css" rel="stylesheet">
        <link href="http://jakepotterryan.com/blink/bootstrap-select.css" rel="stylesheet">
        <link rel="stylesheet" href="http://jakepotterryan.com/blink/style.css" type="text/css" media="screen">
        <link rel="shortcut icon" href="http://jakepotterryan.com/blink/images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="http://jakepotterryan.com/blink/images/favicon.ico" type="image/x-icon">
		<!--[if lt IE 9]> 
			<script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
		<![endif] --> <!-- cond. comment - HTML5 shim for older browsers -->
	</head>
	<body>
<header>
	    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    	<div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="http://www.uvm.edu/~cdavenp1/blink"><img src="images/Blinkblk.png" class="nav-logo img-responsive" /></a>
      	</div>
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
              <li><a id="nav-register" >REGISTER</a></li>
              <li><a href="#">STORE</a></li>
        </ul>
        </div>
    </nav>
</header>	
<div class="main-wrapper">
    <div class="content-section clearfix" id="section1">
        <h3 class="center">THE CURRENT PASSWORD SYSTEM IS HOPELESSLY BROKEN.</h3>
    </br>
    </br>
    	<div class="content-left">
            <iframe width="420" height="315" src="//www.youtube-nocookie.com/embed/8f9BcZGu4d4?rel=0" frameborder="0"></iframe>
        </div>
        <div class="content-right">
        </br>
            <h4><span class="boldtxt">Frustrating</span> to remember.</h4> 
            <h4><span class="boldtxt">Tedious</span> to continuously enter.</h4>
            <h4><span class="boldtxt">Insecure</span> and stolen often.</h4>
            <h4 class="">Blink Secure replaces manual passwords with a wearable bluetooth device offering <span class="boldtxt">proximity-based</span>, dynamic authentication.</h4>
        </div>
    </div>
    <!--<div class="content-pad">
        <h3 class="">Blink Demonstration.</h3>
    </div>-->

    <div class="divider"><img src="images/divider.png" class="img-responsive" /></div>
    <div class="content-section clearfix" id="section2">
   		<div class="content-left">
        	<div class="inner-content-top clearfix">
            	<div class="inner-content-left">
                	<img src="images/step1.png" class="step-img" id="step1" />
                </div>
                <div class="inner-content-right">
                	<span class="glyphicon glyphicon-shopping-cart glyph-format"></span>
                </div>
            </div>
            <div class="inner-content-bottom">
            	<h3>Buy a bracelet.</h3>
                <h4>Available in our store.</h2>
                <button class="btn btn-lg btn-success" href="#" role="button">Buy</button>
            </div>
        </div>
        <div class="content-right">
            <img src="images/bracelets.jpg" id="bracelet-pic" class="img-responsive" alt="Bracelet!" />
        </div>
    </div>
    <div class="divider"><img src="images/divider.png" class="img-responsive" /></div>
    <div class="content-section clearfix" id="section3">
    	<div class="content-left">
			<img src="//www.ri.gov/img/iphone/appstore.png"  id="appstore-pic" class="img-responsive" />
        </div>
        <div class="content-right">
            <div class="inner-content-top clearfix">
            	<div class="inner-content-left">
                	<img src="images/step2.png" class="step-img" id="step2" />
                </div>
                <div class="inner-content-right">
                	<span class="glyphicon glyphicon-save glyph-format"></span>
                </div>
            </div>
            <div class="inner-content-bottom">
           		
                <h3 class="">Download the app.</h3>
                <h4>Available on the AppStore.</h4>
                <button class="btn btn-lg btn-success" href="#" role="button">Download</button>
            </div>
        </div>
    </div>
    <div class="divider"><img src="images/divider.png" class="img-responsive" /></div>
    <div class="content-section clearfix" id="section4">
    	<div class="content-left">
        	<div class="inner-content-top clearfix">
            	<div class="inner-content-left">
                	<img src="images/step3.png" class="step-img" id="step3" />
                </div>
                <div class="inner-content-right">
                	<span class="glyphicon glyphicon-ok glyph-format"></span>
                </div>
            </div>
            <div class="inner-content-bottom">
            	<h3 class="">Register your bracelet.</h3>
                <h4>Get Secured!</h4>
                
            </div>
        </div>
        <div class="content-right">
        	 <img src="images/devices.jpg" id="devices-pic" class="img-responsive" alt="Bracelet!" />
        </div>
    </div>
    <div class="push">
	</div>
    <div id="register-overlay" class="no-select">
    	<div id="register-overlay-content">
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
	$('#nav-register').on('mousedown', function(){
		$('#register-overlay').fadeIn("fast");//addClass('active-overlay');
		$('#register-overlay-content').fadeIn("fast");//addClass('active-overlay');
		$('#register-overlay-content').load('/~cdavenp1/blink/v/register.php');
		
    });
	$('#register-overlay').on('click',function(e){
		if (e.target == this) {
			$('#register-overlay').fadeOut("fast");//addClass('active-overlay');
			$('#register-overlay-content').fadeOut("fast");//addClass('active-overlay');	
		}
    });

});
</script>

<div class="footer-wrapper">
    <footer>
        <section id="contact">
            
        </section>
    </footer>
</div>	</body>
</html>