<?php
        $name = $_POST['name'];
        $email = $_POST['email'];
        $body = $_POST['body'];
        $mail = 'From: $email\nBody: $body\n';
        $to = 'jake.ryan@uvm.edu';

        if ($_POST['submit']){
            if (mail($to, 'you have an incoming message!', $mail)){
                echo'<p>Your message has been sent!</p>';
            }else{
                echo'<p>Oops, something went wrong, please try again</p>';
            }  
        }//end funct
?>