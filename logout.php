<?php
   session_start();
   //if the session is no longer active it goes to the login file
   if(session_destroy()) {
      header("Location: login.php");
   }
?>