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
?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="panel.css" rel="stylesheet" type="text/css"> 
<!------ Include the above in your HEAD tag ---------->

<div class="row">
    <!-- uncomment code for absolute positioning tweek see top comment in css -->
    <!-- <div class="absolute-wrapper"> </div> -->
    <!-- Menu -->
    <div class="side-menu">
    
    <nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <div class="brand-wrapper">
            <!-- Hamburger -->
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Brand -->
            <div class="brand-name-wrapper">
                <a class="navbar-brand" href="index.php">
                    <img src="title.png" style="width:100%;">
                </a>
            </div>

            
        </div>

    </div>

    <!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">

            <li><a href="newprof.php">Add Professor</a></li>
            
            <li><a href="listprof.php">List of Professor</a></li>

            <li><a href="listuser.php">Users</a></li>
            <li><a href="reviews.php">Reviews</a></li>
            <li><a href="../index.php">View Site</a></li>
            <li><a href="index.php?logout='1'">LOGOUT</a></li>
            

        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
    
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
            <h1>This is Admin</h1>
            <img src="admin.jpg"width="90%">
        </div>
    </div>
</div>

<script src="panel.js" ></script>