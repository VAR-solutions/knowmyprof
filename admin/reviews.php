<?php
session_start();

if (!isset($_SESSION['username']) || !$_SESSION['admin'] ) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
// $db = mysqli_connect('localhost', 'root', 'password', 'it');
//database configuration
require ('../config.php');


$result = mysqli_query($db, "SELECT * FROM reviews");
?>


<!-- <!DOCTYPE html>
<html>
    <head>
        <title>KMP</title>
    </head>
    <body> -->
    <?php
//   session_start();

//   if (!isset($_SESSION['username']) || !$_SESSION['admin'] ) {
//   	$_SESSION['msg'] = "You must log in first";
//   	header('location: login.php');
//   }
//   if (isset($_GET['logout'])) {
//   	session_destroy();
//   	unset($_SESSION['username']);
//   	header("location: login.php");
//   }
?>

<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->

<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
<!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!-- <link href="panel.css" rel="stylesheet" type="text/css">  -->
<!------ Include the above in your HEAD tag ---------->


    <!-- Main Content -->
    <?php include('templates/header.php') ?>
    <script>
	    document.title = "List of Reviews | Know My Professor | ADMIN | Dashboard";
    </script>
    <div class="container">
        <div class="headertitle">
            <p>User Reviews</p>
            <hr>
        </div>
        <div class="side-body">
            <ul>
                <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<li>";
                        echo $row['review'] . " for ". mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM prof WHERE id = {$row['id']} "))['fname'];
                        echo "</li>";
                    }
                ?>
            </ul>

        </div>
    </div>

<?php include('templates/footer.php') ?>
