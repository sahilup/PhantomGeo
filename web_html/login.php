<!DOCTYPE html>
<html>
<head>
	<title>safeway Login</title>
	<style type="text/css">
		body {
			font-family: Arial, Helvetica, sans-serif;
			background-color: #333;
			color: #fff;
			text-align: center;
			padding-top: 150px;
		}
		h1 {
			font-size: 36px;
			margin-bottom: 30px;
		}
		input[type="text"], input[type="password"] {
			padding: 10px;
			margin-bottom: 20px;
			border: none;
			border-radius: 5px;
			background-color: #fff;
			color: #333;
			font-size: 18px;
			width: 250px;
		}
		input[type="submit"] {
			padding: 10px;
			border: none;
			border-radius: 5px;
			background-color: #4CAF50;
			color: #fff;
			font-size: 18px;
			cursor: pointer;
		}
		input[type="submit"]:hover {
			background-color: #3E8E41;
		}
	</style>
</head>
<body>
	<h1>Login</h1>
	<form action="login.php" method="post">
		<label>Username:</label><br>
		<input type="text" name="username"><br>
		<label>Password:</label><br>
		<input type="password" name="password"><br>
		<input type="submit" value="Login">
	</form>
</body>
</html>

<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    
    if ($username == "root" && $password == "12345") {
        $_SESSION['username'] = $username;
        header('Location: adminpanel.php');
    } else {
        echo "Invalid username or password";
    }


}
?>
