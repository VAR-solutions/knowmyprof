<?php 
  $db = mysqli_connect('localhost', 'root', 'password', 'it');
  if (isset($_POST['username_check'])) {
  	$username = $_POST['username'];
  	$sql = "SELECT * FROM users WHERE username='$username'";
  	$results = mysqli_query($db, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "taken";	
  	}else{
  	  echo 'not_taken';
  	}
  	exit();
  }
  if (isset($_POST['email_check'])) {
  	$email = $_POST['email'];
  	$sql = "SELECT * FROM users WHERE email='$email'";
  	$results = mysqli_query($db, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "taken";	
  	}else{
  	  echo 'not_taken';
  	}
  	exit();
  }
//   if (isset($_POST['save'])) {
//   	$username = $_POST['username'];
//   	$email = $_POST['email'];
// 	$password = $_POST['password2'];
// 	$fname = $_POST['fname'];
// 	$lname = $_POST['lname'];
//   	$sql = "SELECT * FROM users WHERE username='$username'";
//   	$results = mysqli_query($db, $sql);
//   	if (mysqli_num_rows($results) > 0) {
//   	  echo "exists";	
//   	  exit();
//   	}else{
//   	  $query = "INSERT INTO users (username, email, password, fname, lname) 
//   	       	VALUES ('$username', '$email', '".md5($password)."', $fname, $lname)";
//         $results = mysqli_query($db, $query);
//         $_SESSION['username'] = $username;
//   	$_SESSION['success'] = "You are now logged in";
//   	header('location: index.php');
//   	  echo 'Saved!';
//   	  exit();
//   	}
//   }

?>