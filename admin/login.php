<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$fname = "";
$lname = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', 'password', 'it');
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        // $password = md5($password);
        $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            $_SESSION['admin'] = 1;
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
?>

<html>
    <head>
        <title>KMP</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        form, .content {
  width: 30%;
  margin: 0px auto;
  padding: 20px;
  border: 1px solid #B0C4DE;
  background: white;
  border-radius: 0px 0px 10px 10px;
}
    </style>
    </head>
    <body>
        <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
          <button type="submit" class="btn" name="login_user">Login</button>
      </div>
        </form>
    </body>
</html>
