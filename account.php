<?php 
	session_start();
	if(!isset($_SESSION['FN'])){
		header("location: login.php");	exit();
	}

	if(isset($_GET['logout'])){
		unset($_SESSION['FN']);
		header("location: login.php");	exit();
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="styles.css">
	<title>User account</title>
</head>
<body>

	<div class="content">
		<header>
			<h2>Welcome <?php echo $_SESSION['FN']; ?><h2>
			<a href="?logout">Log out</a>	
		</header>

	</div>

</body>
</html>