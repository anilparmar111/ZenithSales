<?php
   session_start();
   error_reporting(0);
   if( !isset( $_SESSION['party'] ) ) 
   {
       $msg="Please Select Party";
       header("Location: login.php?msg={$msg}");  
   }
?>
