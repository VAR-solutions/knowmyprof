<?php
  session_start();

  if (!isset($_SESSION['username']) && $_SESSION['ttt']=="ok") {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>KMP</title>
    </head>
    <body>
        <h1 >This is admin</h1>
    <a href="newprof.php" >Add Professor</a><br>
    <a href="listprof.php">List of Professor</a><br>
    <a href="listuser.php">List of Users </a><br>
    <a href="#">Remove Professor</a><br>
    <a href="#">Edit Professor</a>
    <?php  if (isset($_SESSION['username'])) : ?>
    	<!-- <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p> -->
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
    </body>
</html>