<?php
function ProcessForm()
 {
     if(!isset($_POST['submitted']))
     {
        return false;
     }
     if(!$this->Validate())
     {
         $this->error_message = implode('<br/>',$this->errors);
         return false;
     }
     $this->CollectData();
 
     $ret = $this->SendFormSubmission();
 
     return $ret;
 }
?>