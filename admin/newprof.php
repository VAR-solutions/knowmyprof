<?php
session_start();

if (!isset($_SESSION['username']) || !$_SESSION['admin'] ) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
// initializing variables
// $username = "";
$email    = "";
$fname = "";
$lname = "";
$aoi = "";
$qual = "";
$achi = "";
$imgContent;
$errors = array();

// connect to the database
// $db = mysqli_connect('localhost', 'root', 'password', 'it');
//database configuration
require ('../config.php');



if (isset($_POST['reg_user'])) {
  $email = trim(mysqli_real_escape_string($db, $_POST['email']));
  $fname = trim(mysqli_real_escape_string($db, $_POST['fname']));
	$lname = mysqli_real_escape_string($db, $_POST['lname']);
	$aoi = mysqli_real_escape_string($db,$_POST['aoi']);
  	$qual = mysqli_real_escape_string($db, $_POST['qual']);
  	$achi = mysqli_real_escape_string($db, $_POST['achi']);
  	$pub = mysqli_real_escape_string($db,$_POST['pub']);
  	$web = mysqli_real_escape_string($db,$_POST['web']);
  	$linkedin = mysqli_real_escape_string($db,$_POST['linkedin']);
	$exp = mysqli_real_escape_string($db,$_POST['exp']);
	if (empty($email)) { array_push($errors, "Email is required"); }
	$check = getimagesize($_FILES['image']['tmp_name']);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
				$imgContent = addslashes(file_get_contents($image));
				$ttt = true;
			}
				if (count($errors) == 0 && $ttt) {
					// $password = md5($password_1);//encrypt the password before saving in the database
			
					$query = "INSERT INTO prof (fname, lname, aoi,email,qual, achi,image,pub,web,linkedin,exp)
								VALUES('$fname', '$lname','$aoi' ,'$email','$qual', '$achi', '$imgContent','$pub','$web','$linkedin','$exp')";
					mysqli_query($db, $query);
					// $_SESSION['username'] = $username;
					$_SESSION['success'] = "You are now logged in";
					header('location: index.php');
				}
		}	
?>
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


<!DOCTYPE html>
<html>
  <head>
      <title>KMP</title>
	  <link rel="stylesheet" type="text/css" href="style.css">
	  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  </head>
  <body>
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
		<form method="post" action="newprof.php" enctype="multipart/form-data">
  		<?php include('errors.php'); ?>
  		
  		<div class="input-group">
	  		<label>First Name</label>
  			<input type="text" name="fname" value="<?php echo $fname; ?>" required>
  		</div>
    	<div class="input-group">
  			<label>Last Name</label>
  			<input type="text" name="lname" value="<?php echo $lname; ?>" required>
  		</div>
  		<div class="input-group">
  			<label>Email</label>
  			<input type="email" name="email" value="<?php echo $email; ?>" required>
    	</div>
    	<div class="input-group">
  			<label>Qualification</label>
  			<textarea class="" rows="5" cols="36" type="text" name="qual" value="" required><?php echo $qual; ?></textarea>
    	</div>
    	<div class="input-group">
  			<label>Area of interest</label>
  			<textarea type="text" name="aoi" rows="5" cols="36"  value="" required><?php echo $aoi; ?></textarea>
  		</div>    
    	<div class="input-group">
  			<label>Present & Past Experience</label>
  			<textarea  rows="5" cols="36" name="achi" value="" required><?php echo $achi; ?></textarea>
		</div>
		<div class="input-group">
  			<label>Publications</label>
  			<textarea  rows="5" cols="36"  name="pub" value="" required><?php echo $pub; ?></textarea>
		</div>
		<div class="input-group">
  			<label>Subjects</label>
  			<textarea  rows="5" cols="36"  name="exp" value="" required><?php echo $exp; ?></textarea>
		</div>
		<div class="input-group">
  			<label>Website</label>
  			<input name="web" value="<?php echo $web; ?>">
		</div>
		<div class="input-group">
  			<label>Linkedin Profile</label>
  			<input name="linkedin" value="<?php echo $linkedin; ?>">
    	</div>
    	<div class="input-group">
  			<label>Display Picture</label>
  			<input type="file" name="image" onchange="readURL(this);" value="UPLOAD">
  		</div>  
		<img id="blah" src="#" alt="your image" hidden />
		<div class="input-group">
  			<button type="submit" class="btn" name="reg_user">Register</button>
  		</div>
		</form>

        </div>
    </div>
</div>

<script src="panel.js" ></script>

	
	</body>
	<script>
		     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(150)
						.attr('hidden',false);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
	</script>
</html>