<?php
session_start();
$errors = array();
$db = mysqli_connect('localhost', 'itbois', 'password', 'it');
$result = mysqli_query($db, "SELECT * FROM prof");
$k = mysqli_query($db, "SELECT * FROM prof");
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: index.php");
}
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password, fname, lname)
  			  VALUES('$username', '$email', '$password', '$fname', '$lname')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }else{
    header('location: index.php');
  }
}
// login user
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
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>
<?php 
  include('process.php');
  include('templates/header.php');
?>

<div class="container-fluid">
    
    
  
  
  
<p style="font-family: 'Dancing Script', cursive; text-align: center; font-size: 30px; font-weight: 550; color:#4b4949 "><q>Good teachers know how to bring out the best in students. 
</q></p>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner row w-100 mx-auto">
    <div class="carousel-item col-md-3 active ">
    <?php $r = mysqli_fetch_assoc($result); ?>
      <a href = "prof.php?id=<?php echo $r['id'] ?>" class = "prof" >
        <div class="card w-75.2 p-70">
        <img class="card-img-top img-fluid" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($r['image']) ?>"> 
          <div class="card-body">
            <h6 class="card-title"><span class="card-name">Name - </span><?php echo $r['fname'] . " " . $r['lname']; ?></h6>
            <p class="card-text">About professor.</p>
            
          </div>
        </div></a>
      </div>
    <?php while ($row = mysqli_fetch_array($result)) : ?>
      <div class="carousel-item col-md-3 ">
      <a href = "prof.php?id=<?php echo $row[id] ?>" class="prof" >
        <div class="card w-75.2 p-70" >
        <img class="card-img-top img-fluid" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($row['image']) ?>"> 
          <div class="card-body">
            <h6 class="card-title"><span class="card-name">Name - </span><?php echo $row['fname'] . " " . $row['lname']; ?></li></h6>
            <p class="card-text">About professor.</p>
            
          </div>
        </div></a>
        </div>
        <?php endwhile; ?>

    </div>
    <a class="carousel-control-prev arrborder" href="#myCarousel" role="button" data-slide="prev">
      <span aria-hidden="true"><i class="fas fa-chevron-circle-left fa-3x"></i></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next arrborder" href="#myCarousel" role="button" data-slide="next">
      <span  aria-hidden="true"><i class="fas fa-chevron-circle-right fa-3x"></i></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <div class="wrap-check">
  <div class="wrap">
  <div class="search">
      <form method="get" action="search.php" target="_blank">
     <input type="text" class="searchTerm" placeholder="SEARCH HERE" name = "q" >      
     <button type="submit" class="searchButton" >
       <i class="fa fa-search"></i>
    </button>
    </form>
  </div>
</div>
</div>
</div>
<?php include('templates/footer.php') ?>
