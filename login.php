<?php require("login.class.php") ?>
<?php 
	if(isset($_POST['submit'])){
		$user = new LoginUser($_POST['FN'], $_POST['SN'], $_POST['DoB']);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="styles.css">
	<title>Log in form</title>
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
		<h2>Login form</h2>
		<h4>All Fields are <span>Required</span></h4>

		<label>Family Name</label>
		<input type="text" name="FN">

		<label>Student Number</label>
		<input type="text" name="SN">

        <label>Date of Birth</label>
        <input type="date" name="DoB">

		<button type="submit" name="submit">Log in</button>

		<p class="error"><?php echo @$user->error ?></p>
		<p class="success"><?php echo @$user->success ?></p>
	</form>

</body>
</html>