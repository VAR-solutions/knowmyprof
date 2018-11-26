<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$fname = "";
$lname = "";
$errors = array();

// connect to the database
// $db = mysqli_connect('localhost', 'root', 'password', 'it');
//database configuration
require ('../config.php');


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
            array_push($errors, "Invalid Username OR Password");
        }
    }
}
?>

<html>
    <head>
        <title>LOGIN | Know My Professor | ADMIN</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans" rel="stylesheet"
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    </head>
    <body>
        <div class="container">
            <div class="header col-xs-8">
                <div class="brand-image">
                    <a href="index.php">
                        <img src="title.png" id="brand-img">
                    </a>
                </div>
            </div>
            <div class="admin col-xs-4">
                    <p>|  ADMIN</p>
            </div>
            <div class="container-fluid col-xs-12">
                <form method="post" action="login.php">
                    <div class="group">
                        <input type="text" name="username" placeholder="&nbsp;" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Username</label>
                    </div>
                    <div class="group">
                        <input type="password" name="password" placeholder="&nbsp;" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Password</label>
                    </div>
                    <?php include('errors.php'); ?>
                    <div class="input-group">
                        <button type="submit" class="button" name="login_user"><span>Login</span></button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
