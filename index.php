<?php require("register.class.php") ?>

<?php
    if(isset($_POST['submit'])){
        $user = new RegisterUser($_POST['FN'], $_POST['SN'], $_POST['DoB']);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device.width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register form</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
        <h2>Register form</h2>
        <h4>All fields are <span>required</span></h4>

        <label>Family Name</label>
        <input type="text" name="FN">

        <label>Student Number</label>
        <input type="number" name="SN">

        <label>Date of Birth</label>
        <input type="date" name="DoB">

        <button type="submit" name="submit">Register</button>

        <p class="error"></p>
        <p class="success"></p>
</body>
</html>