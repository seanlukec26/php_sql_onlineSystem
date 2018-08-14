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
				 //calls the procedure from the database
					$sql = "CALL ConsoleTable";
					$result = mysqli_query($db,$sql);
					//while there is data it does what is in the brackets
					while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
					{
						echo '<tr>';
						// for each value from the database table it does what is in the brackets
						foreach($row as $key=>$value)
						{
							//prints a button with a href to another file, gets the console_name from the database to use as the value
							echo'<td><a href="controller.php"><button id="'.$row['console_name'].'" class="btn btn-danger">'.$row['console_name'].'</button></a></td>';
						}
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