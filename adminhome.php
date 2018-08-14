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
  <h1>Welcome <?php echo $login_session; ?></h1> 
  <h2><a href = "logout.php">Sign Out</a></h2>
  <div class="panel panel-primary" style="padding:3px; border: solid 1px #333333;">
	<div class="panel-heading"><b></b></div>	
    <div class="panel-body">
		<button class="btn btn-primary" onclick="window.location.href='adddeleteconsole.php'">Add / Delete Console</button><br />
		<br/>
		<button class="btn btn-primary" onclick="window.location.href='adddeletecontroller.php'">Add / Delete Controller</button><br />
	</div>
	</div>
</div>
</body>
</html>

   