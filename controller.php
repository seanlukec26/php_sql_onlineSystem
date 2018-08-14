<?php
   include('session.php');
?>
<html>
   
   <head>
      <title>Welcome </title>
     <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	<!--echo prints the user that is signed in-->
  <h1>Welcome <?php echo $login_session; ?></h1> 
  <h2><a href = "logout.php">Sign Out</a></h2>
  <h2><a href = "home.php">Home</a></h2>
  <div class="panel panel-primary" style="padding:3px; border: solid 1px #333333;">
	<div class="panel-heading"><b>Controllers</b></div>	
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
					//calls the procedure
					$sql = "CALL ControllerTable";
					$result = mysqli_query($db,$sql);
					//while there is data in the array it does what is in the brackets
					while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
					{
						echo '<tr>';
						echo'<td>'.$row['controller_name'].'</td>';
						echo'<td><input type = "submit" class="btn btn-primary" name="purchase" value="'.$row['controller_price'].'"/></td>';
						echo '</tr>';
					}
					?>
				</tbody>
			  </table>
		</div>
	</div>
	</div>
</div>
</body>
</html>