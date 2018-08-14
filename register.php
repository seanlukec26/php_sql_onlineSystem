<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // email, username and password sent from form 
      
      $myemail = mysqli_real_escape_string($db,$_POST['email']);
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      //$sql = "INSERT INTO usertable(user_id, email, username, password) VALUES (null, '$myemail','$myusername','$mypassword')";
	  //stored procedure of the above sql code
	  $sql = "CALL adduser(null, '$myemail','$myusername','$mypassword')";
	  //echo($sql);
      $result = mysqli_query($db,$sql);
	  //var_dump($result);
	  //print_r($result);
	  
	  if($result = true)
	  {
		 header("Location: login.php"); 
	  }
	  else {
         $error = "Invalid Details.";
      }
	  
	        
   
	
   }
?>
