<!DOCTYPE html>
<html>
  <head>
    <title>safeway Login</title>
    <link rel="stylesheet" href="login.css" />
  </head>

  <body>
    <div class="login-box">
      <h1>Login</h1>
      <form action="login.php" method="post">
        <label>Username:</label><br />
        <input type="text" name="username" /><br />
        <label>Password:</label><br />
        <input type="password" name="password" /><br />
        <input type="submit" value="Login" />
      </form>
    </div>
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
