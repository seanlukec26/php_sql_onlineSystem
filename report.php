<?php
   include('config.php');
  
?>
<html>
   
   <head>
      <title>Report </title>
     <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
			<h2>Report</h2><br/>
			  <table class="table">
				<thead>
				  <tr>
					<th>log_id</th>
					<th>user_id</th>
					<th>email</th>
					<th>username</th>
					<th>userpassword</th>
					<th>console_id</th>
					<th>console_name</th>
					<th>controller_id</th>
					<th>controller_name</th>
					<th>controller_price</th>
					<th>changedate</th>
					<th>action</th>
				  </tr>
				</thead>
				<tbody>
				 <?php
				 //calls stored procedure in the database
					$sql = "CALL logTable";
					$result = mysqli_query($db,$sql);
					//while there is data in the database table do the following in the brackets
					while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
					{
						echo '<tr>';
						// for each value in the database table do the what is in the brackets
						foreach($row as $key=>$value)
						{
						//prints table data with the value retrieved from the database
							echo'<td>',$value,'</td>';
						}
						echo '</tr>';
					}
					?>
				</tbody>
			  </table>

</div>
</body>
</html>