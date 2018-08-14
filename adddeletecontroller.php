<?php
   include('session.php');
	
	//if variable name is addcnt do the following code
   if( isset( $_REQUEST['addcnt'] ))
	{
		$mycontrollername = mysqli_real_escape_string($db,$_POST['controllername']);
		$mycontrollerprice = mysqli_real_escape_string($db,$_POST['controllerprice']);
      
      //$sql = "INSERT INTO controllers(controller_id, controller_name,controller_price) VALUES (null, '$mycontrollername', '$mycontrollerprice')";
	  //stored procedure that does the above sql code
	  $sql = "CALL addController(null, '$mycontrollername', '$mycontrollerprice')";
      $result = mysqli_query($db,$sql);
	  //var_dump($result);
	  //print_r($result);
	  
	  //if sql query is true go to the file
	  if($result = true)
	  {
		 header("Location: adddeletecontroller.php"); 
	  }
	  else {
         $error = "Invalid Details.";
      }
	}
	//if variable name is deletecnt do the following code
	else if( isset( $_REQUEST['deletecnt'] ))
	{
		$mycontrollername = mysqli_real_escape_string($db,$_POST['controllername']);
      //$sql = "DELETE FROM controllers WHERE controller_name = '$mycontrollername'";
	  //stored procedure in the database that does the above sql code
	  $sql = "CALL deleteController('$mycontrollername')";
      $result = mysqli_query($db,$sql);
	  //var_dump($result);
	  //print_r($result);
	  //if sql query is true do the following code
	  if($result = true)
	  {
		 header("Location: adddeletecontroller.php"); 
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
					<th>Price</th>
				  </tr>
				</thead>
				<tbody>
				 <?php
				 //stored procedure in the database
					$sql = "CALL ControllerTable";
					$result = mysqli_query($db,$sql);
					//while there is data in the database table do the following code
					while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
					{
						echo '<tr>';
						//for each value in the sql array do the following code
						foreach($row as $key=>$value)
						{
							echo '<td>',$value,'</td>';
						}
						echo '</tr>';
					}
					?>
				</tbody>
			  </table>
			  <button id="addBtn" class="btn btn-primary">Add / Delete Controller</button>
			   </div>
			   <!-- The Modal -->
				<div id="addmodal" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
					<div class="modal-header">
					  <span class="close">×</span>
					  <h2>Add / Delete Controller</h2>
					</div>
					<div class="modal-body">
					  <form class="form-horizontal" method = "POST">
							<div class="form-group">
							<label for="inputcontrollername" class="col-sm-2 control-label">Name</label>
							<div class="col-sm-10">
							  <input type="controllername" class="form-control" name = "controllername" placeholder="Controller Name">
							</div>
						  </div>
						  <div class="form-group">
							<label for="inputcontrollerprice" class="col-sm-2 control-label">Price</label>
							<div class="col-sm-10">
							  <input type="controllerprice" class="form-control" name = "controllerprice" placeholder="00.00">
							</div>
						  </div>
						  <input type = "submit" class="btn btn-primary" name="addcnt" value="Add Controller"/><br />
						  <br/>
						  <input type = "submit" class="btn btn-danger" name="deletecnt" value="Delete Controller"/><br />
					 </form>
					</div>
					<div class="modal-footer">
					</div>
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