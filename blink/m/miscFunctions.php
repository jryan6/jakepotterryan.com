<?php 
    function debug($value=''){ 
        if ($_SESSION['debug']){
            $btr=debug_backtrace(); 
            $line=$btr[0]['line']; 
            $file=basename($btr[0]['file']); 
            print"<pre>$file:$line</pre>\n"; 
            if(is_array($value)){ 
                print"<pre>"; 
                print_r($value); 
                print"</pre>\n"; 
            }elseif(is_object($value)){ 
                var_dump($value); 
            }else{ 
                print("<p>&gt;${value}&lt;</p>"); 
            } 
        }
    }

    function chkHeaders(){
        if(headers_sent($file, $line)){
            // ... where were the mysterious headers sent from?
            echo "Headers were already sent in $file on line $line...";
        }
    }

    function getURL(){ //returns array of info about url, and host. 
        $root=((@$_SERVER["HTTPS"])?'https://':'http://').$_SERVER["SERVER_NAME"]."/blink"; 
        if (isset($_GET["q"])){
            $saniQuery = htmlentities($_GET["q"], ENT_QUOTES, "UTF-8");
            $xplodeget=explode("/", $saniQuery);
            $dir=array_shift($xplodeget);
            $return = array("root"=>$root, "dir"=>$dir, "subdirs"=>$xplodeget);
        } else $return=array("root"=>$root);
        return $return;
    }
