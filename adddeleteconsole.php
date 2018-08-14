<?php
   include('session.php');
	
	//if variable name is addcns do the following code
   if( isset( $_REQUEST['addcns'] ))
	{
		$myconsolename = mysqli_real_escape_string($db,$_POST['consolename']);
      
      //$sql = "INSERT INTO consoles(console_id, console_name) VALUES (null, '$myconsolename')";
	  //stored procedure in the database that does the above sql code
	  $sql = "CALL addConsole(null, '$myconsolename')";
      $result = mysqli_query($db,$sql);
	  //var_dump($result);
	  //print_r($result);
	  
	  if($result = true)
	  {
		 header("Location: adddeleteconsole.php"); 
	  }
	  else {
         $error = "Invalid Details.";
      }
	}
	//else if variable name is deletecns do the following code
	else if( isset( $_REQUEST['deletecns'] ))
	{
		$myconsolename = mysqli_real_escape_string($db,$_POST['consolename']);
      //$sql = "DELETE FROM consoles WHERE console_name = '$myconsolename'";
	  //stored procedure that does the above sql code
	  $sql = "CALL deleteConsole('$myconsolename')";
      $result = mysqli_query($db,$sql);
	  //var_dump($result);
	  //print_r($result);
	  
	  //if sql query is correct go to the file
	  if($result = true)
	  {
		 header("Location: adddeleteconsole.php"); 
	  }
	  else {
         $error = "Invalid Details.";
      }
	}
?>
<html">
   
   <head>
      <title>Add / Delete Console</title>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
      <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
   </head>
   
   <body>
   <div class="container">
      <h1>Welcome <?php echo $login_session; ?></h1> 
      <h2><a href = "logout.php">Sign Out</a></h2>
	  <h2><a href = "adminhome.php">Home</a></h2>
	  <div class="panel panel-primary" style="padding:3px; border: solid 1px #333333;">
	<div class="panel-heading"><b>Console</b></div>	
    <div class="panel-body">
			  <table class="table">
				<thead>
				  <tr>
					<th>Name</th>
				  </tr>
				</thead>
				<tbody>
				 <?php
				 //stored procedure in the database
					$sql = "CALL ConsoleTable";
					$result = mysqli_query($db,$sql);
					//while there is data do the following code
					while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
					{
						echo '<tr>';
						// for each value in the array 
						foreach($row as $key=>$value)
						{
							echo '<td>',$value,'</td>';
						}
						echo '</tr>';
					}
					?>
				</tbody>
			  </table>
			  <button id="addBtn" class="btn btn-primary">Add / Delete Console</button>
			   </div>
			   <!-- The Modal -->
				<div id="addmodal" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
					<div class="modal-header">
					  <span class="close">×</span>
					  <h2>Add / Delete Console</h2>
					</div>
					<div class="modal-body">
					  <form class="form-horizontal" method = "POST">
							<div class="form-group">
							<label for="inputconsolename" class="col-sm-2 control-label">Name</label>
							<div class="col-sm-10">
							  <input type="consolename" class="form-control" name = "consolename" placeholder="Console Name">
							</div>
						  </div>
						  <input type = "submit" class="btn btn-primary" name="addcns" value="Add Console"/><br />
						  <br/>
						  <input type = "submit" class="btn btn-danger" name="deletecns" value="Delete Console"/><br />
					 </form>
					</div>
					<div class="modal-footer">
					</div>
				  </div>
			  </div>
			  </div>
		
   </body>
   
</html>
<script>
	// Get the modal
	var modal = document.getElementById('addmodal');

	// Get the button that opens the modal
	var btn = document.getElementById("addBtn");

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