<?php
  session_start();

  if (!isset($_SESSION['username']) || !$_SESSION['admin'] ) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
  require ('../config.php');

?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Know My Professor | ADMIN</title>
	<link rel="shortcut icon" type="image/png" href="../favicon.png"/>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/panel.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link href='http://fonts.googleapis.com/css?family=Cookie|Merienda|Poiret+One|Quicksand|Proza+Libre|Regular' rel='stylesheet' type='text/css'>
<link href="assets/css/style.css" rel="stylesheet" type="text/css">

</head>

<body>
    <div class="panel">
        <aside class="sidebar-left">

            <a class="company-logo" href="index.php">
                <img class="logo-img" src="title.png">
            </a>

            <div class="sidebar-links">
                <a class="" href="newprof.php">
                <i class="fas fa-plus"></i>
                Add Professor</a>
                <a class="" href="listprof.php">
                <i class="fas fa-chalkboard-teacher"></i>
                Professors</a>
                <a class="" href="listuser.php">
                <i class="fas fa-users"></i>
                Users</a>
                <a class="" href="reviews.php">
                <i class="far fa-edit"></i>
                Reviews</a>
                <a class="" href="../index.php">
                <i class="fas fa-sign-out-alt"></i>    
                View Site</a>
                <a class="" href="index.php?logout='1'">
                <i class="fas fa-sign-out-alt"></i>    
                LOGOUT</a>
            </div>
        
        </aside>

    </div>

    <!-- Main Content -->
    <div class="main-content">
 
  
