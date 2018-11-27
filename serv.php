<?php
// REGISTER USER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location:".$_SESSION['page']);
  }
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

  	$_SESSION['verifycode'] = mt_rand(100000, 999999);
    include_once "PHPMailer/PHPMailer.php";
		include_once "PHPMailer/Exception.php";
		$mail = new PHPMailer();
		$mail->setFrom('admin@knowmtprof.com',"admin");
		$mail->addAddress($email);
		$mail->Subject = "Verify your account";
		$mail->isHTML(true);
		$mail->Body = "Enter the code to verify your account: ".$_SESSION['verifycode'];
	
   if(!$mail->send()){
    echo "Something went wrong !";
  }
    else{
    echo "Done";
    $query = "INSERT INTO users (username, email, password, fname, lname,verifi)
  			  VALUES('$username', '$email', '$password', '$fname', '$lname',0)";
  	mysqli_query($db, $query);
  	$_SESSION['tempusername'] = $username;
    $_SESSION['success'] = "You are now logged in";
    $_SESSION['verific'] = 1;  
  	header('location: index.php');
    }
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
      $_SESSION['tempusername'] = $username;
      
      if(mysqli_num_rows(mysqli_query($db,"SELECT * FROM users WHERE username='$username' AND password='$password' AND verifi = 1"))){
      
        session_destroy();
        $_SESSION['username'] = $username;
        header('location:'.$_SESSION['page'] );
        
      }else{
        $eee = mysqli_fetch_assoc(mysqli_query($db,$query));
        $email = $eee['email'];
        array_push($errors,"Your account is not verified");
        $err = 1;
        $_SESSION['verifycode'] = mt_rand(100000, 999999);
        include_once "PHPMailer/PHPMailer.php";
        include_once "PHPMailer/Exception.php";
        $mail = new PHPMailer();
        $mail->setFrom('admin@knowmtprof.com',"admin");
        $mail->addAddress($email);
        $mail->Subject = "Verify your account";
        $mail->isHTML(true);
        $mail->Body = "Enter the code to verify your account: ".$_SESSION['verifycode'];
      
        if(!$mail->send()){
          array_push($errors,"Internal error occured");
        }
        else{
          echo "Done";
          $_SESSION['verific'] = 1;
          header("location: index.php");
        }
      }
  	}else {
      array_push($errors, "Wrong username/password combination");
      $errl = 1;
      
  	}
  }
}

// Change Password

if (isset($_POST['changepwd'])) {
  $oldpassword = mysqli_real_escape_string($db, $_POST['oldpassword']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }else{
    if($_SESSION['forget_cpwd'] == 1){
      if (count($errors) == 0) {
        $password = md5($password_1);
        $_SESSION['forget_cpwd'] = null;
        mysqli_query($db,"UPDATE users SET password = '$password'");
        header("location: index.php");
    }
    }else{
      $checkpwd = mysqli_fetch_assoc(mysqli_query($db,"SELECT password FROM users WHERE username = {$_SESSION['username']}"));
      if ($checkpwd['password'] != md5($oldpassword)){
      array_push($errors,"Wrong current password !!!");
      }
      if (count($errors) == 0) {
      $password = md5($password_1);
      mysqli_query($db,"UPDATE users SET password = '$password'");
  	  header("location: index.php");
  }
}
}
}
// verify account
if(isset($_POST['check_veri'])){
  $code = mysqli_real_escape_string($db, $_POST['veri']);
  if($code == $_SESSION['verifycode']){
      mysqli_query($db,"UPDATE users set verifi = 1 where username = {$_SESSION['tempusername']}");
      $_SESSION['verific'] = null;
      $_SESSION['forget_cpwd'] = 1;
      $_SESSION['username'] = $_SESSION['tempusername'];
      header('location: index.php');
  }
  else{
      array_push($errors, "Wrong Verification code");
      $err = 1;
      header('location: index.php');
  }
}

// forget password
if(isset($_POST['forget_pwd'])){
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $query = "SELECT * FROM users WHERE username='$username'";
  $results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
      $eee = mysqli_fetch_assoc(mysqli_query($db,$query));
      $email = $eee['email'];
      $_SESSION['tempusername'] = $username;
      $_SESSION['verifycode'] = mt_rand(100000, 999999);
        include_once "PHPMailer/PHPMailer.php";
        include_once "PHPMailer/Exception.php";
        $mail = new PHPMailer();
        $mail->setFrom('admin@knowmtprof.com',"admin");
        $mail->addAddress($email);
        $mail->Subject = "Verify your account";
        $mail->isHTML(true);
        $mail->Body = "Enter the code to verify your account: ".$_SESSION['verifycode'];
        if(!$mail->send()){
          array_push($errors,"Internal error occured");
        }
          else{
            $_SESSION['mailed'] = "We have sent verification code on your registered email .";
            $_SESSION['verific'] = 1;
            
            header("location: index.php");
          }
      }else{
        array_push($errors,"Sorrry, You are not registered !!!");
        $errl = 1;
      }
}

?>