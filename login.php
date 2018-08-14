<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      //sql way "SELECT user_id FROM user WHERE username = '$myusername' and password = '$mypassword'";
	  //stored procedure that does the the above sql code
	  $sql = "CALL login('$myusername','$mypassword')";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	 //print_r($result);
	     
      $count = mysqli_num_rows($result);
	  
	        
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
		
         //checks if username = admin if it is it goes to admin page otherwise user page
		 if ($myusername == 'admin'){
			$_SESSION['login_user'] = $myusername;
			header("location: adminhome.php");
		 }
		 else{
			$_SESSION['login_user'] = $myusername;
			header("location: home.php");
		 }
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
      <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
   </head>
   
   <body bgcolor = "#FFFFFF">
      <div align = "center">
         
            <div class="panel panel-primary" style="padding:3px; width:300px; border: solid 1px #333333;" align = "left">
			<div class="panel-heading"><b>Login</b></div>	
            <div class="panel-body" style = "margin:30px">
               
               <form action = "" method = "post">

				<div class="form-group">
					<label>Username:</label>
					<input type="username" class="form-control" name = "username" placeholder="Username">
				  </div>
				  <div class="form-group">
					<label>Password:</label>
					<input type="password" class="form-control" name = "password" placeholder="Password">
				  </div>
                  <input type = "submit" class="btn btn-primary" value="Submit"/><br />
				  
				  <br/><br/>
				  <label>Don't have an account yet? Register Now.</label><br />
               </form>
			   
			   <button id="RegisterBtn" class="btn btn-danger">Register</button>
			   </div>
			   <!-- The Modal -->
				<div id="Registermodal" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
					<div class="modal-header">
					  <span class="close">×</span>
					  <h2>Register</h2>
					</div>
					<div class="modal-body">					  
					  <form class="form-horizontal" method = "POST" action="register.php">
						  <div class="form-group">
							<label for="inputEmail" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
							  <input type="email" class="form-control" name = "email" placeholder="Email">
							</div>
							</div>
							<div class="form-group">
							<label for="inputusername" class="col-sm-2 control-label">Username</label>
							<div class="col-sm-10">
							  <input type="username" class="form-control" name = "username" placeholder="Username">
							</div>
						  </div>
						  <div class="form-group">
							<label for="inputPassword" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
							  <input type="password" class="form-control" name = "password" placeholder="Password">
							</div>
						  </div>
						  <input type = "submit" class="btn btn-primary" value="Submit"/><br />
					 </form>
					</div>
					<div class="modal-footer">
					</div>
				  </div>

				</div>

				<script>
				// Get the modal
				var modal = document.getElementById('Registermodal');

				// Get the button that opens the modal
				var btn = document.getElementById("RegisterBtn");

				// Get the <span> element that closes the modal
				var span = document.getElementsByClassName("close")[0];

				// When the user clicks the button, open the modal 
				btn.onclick = function() {
					modal.style.display = "block";
				}

				// When the user clicks on <span> (x), close the modal
				span.onclick = function() {
					modal.style.display = "none";
				}

				// When the user clicks anywhere outside of the modal, close it
				window.onclick = function(event) {
					if (event.target == modal) {
						modal.style.display = "none";
					}
				}
				</script>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         
			
      </div>

   </body>
</html>
<style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 2px;
         }
</style>
<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 400;
    top: 0;
    width: 50%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #771710;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    background-color: #771710;
    color: white;
}
</style>