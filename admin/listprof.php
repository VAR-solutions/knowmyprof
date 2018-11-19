<?php
session_start();

if (!isset($_SESSION['username']) || !$_SESSION['admin'] ) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
// $db = mysqli_connect('localhost', 'root', 'password', 'it');
//database configuration
require ('../config.php');


$result = mysqli_query($db, "SELECT * FROM prof");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>KMP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
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
        <div class="row">
<?php while ($row = mysqli_fetch_array($result)) :?>
  <div class="card" style="width:200px">
  <a href = "prof.php?id=<?php echo $row[id] ?>" class="prof" >
    <img class="card-img-top img-responsive" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($row['image']) ?>" alt="Card image" style="width:100%;height:200px; ">
    <div class="card-body">
      <h4 class="card-title"><?php echo $row['fname'] . " " . $row['lname']; ?></h4>
    </div>
  </a>
  </div>
  <?php endwhile ;?> 
  </div>

        </div>
    </div>
</div>

<script src="panel.js" ></script>




<div class="container">
    
</div>

</body>
</html>

