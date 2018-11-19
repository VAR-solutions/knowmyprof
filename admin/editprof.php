<?php
session_start();

if (!isset($_SESSION['username']) || !$_SESSION['admin'] ) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

//database configuration
require ('../config.php');

if (!empty($_GET['id'])) {
    // $db = mysqli_connect('localhost', 'itbois', 'password', 'it');
    $result = mysqli_query($db, "SELECT * FROM prof WHERE id = {$_GET['id']}");
    $row = $result->fetch_assoc();
}
if(isset($_POST['edit'])){
    // $db = mysqli_connect('localhost', 'itbois', 'password', 'it');
    $id = $_GET['id'];
    $email = mysqli_real_escape_string($db, $_POST['email']);
  	$fname = mysqli_real_escape_string($db, $_POST['fname']);
	$lname = mysqli_real_escape_string($db, $_POST['lname']);
	$aoi = mysqli_real_escape_string($db,$_POST['aoi']);
  	$qual = mysqli_real_escape_string($db, $_POST['qual']);
  	$achi = mysqli_real_escape_string($db, $_POST['achi']);
  	$pub = mysqli_real_escape_string($db,$_POST['pub']);
  	$web = mysqli_real_escape_string($db,$_POST['web']);
  	$linkedin = mysqli_real_escape_string($db,$_POST['linkedin']);
	$exp = mysqli_real_escape_string($db,$_POST['exp']);
	$check = getimagesize($_FILES['image']['tmp_name']);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
				$imgContent = addslashes(file_get_contents($image));
				$ttt = true;
			}
				if (count($errors) == 0 && $ttt) {
    mysqli_query($db,"UPDATE prof SET fname = '$fname', lname = '$lname', email = '$email',web = '$web',linkedin = '$linkedin',aoi = '$aoi',pub = '$pub',qual = '$qual',exp = '$exp',achi = '$achi',image='$imgContent' WHERE id=$id");
	header('location: prof.php?id='.$id);
				}
}
?>
<!DOCTYPE html>
<html>
  <head>
      <title>KMP</title>
	  <link rel="stylesheet" type="text/css" href="style.css">
	  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	  <style>
		  form, .content {
  width: 30%;
  margin: 0px auto;
  padding: 20px;
  border: 1px solid #B0C4DE;
  background: white;
  border-radius: 0px 0px 10px 10px;
}
	  </style>
	  
  </head>
  <body></body>

<form method="post" action="editprof.php?id=<?php echo $row['id'] ?>" enctype="multipart/form-data">
  		<?php include('errors.php'); ?>
  		
  		<div class="input-group">
	  		<label>First Name</label>
  			<input type="text" name="fname" value="<?php echo $row['fname']; ?>">
  		</div>
    	<div class="input-group">
  			<label>Last Name</label>
  			<input type="text" name="lname" value="<?php echo $row['lname'] ?>">
  		</div>
  		<div class="input-group">
  			<label>Email</label>
  			<input type="email" name="email" value="<?php echo $row['email']; ?>">
    	</div>
    	<div class="input-group">
  			<label>Qualification</label>
  			<textarea rows="5" cols="36" type="text" name="qual" value=""><?php echo $row['qual']; ?></textarea>
    	</div>
    	<div class="input-group">
  			<label>Area of interest</label>
  			<textarea type="text" name="aoi"  rows="5" cols="36" value=""><?php echo $row['aoi']; ?></textarea>
  		</div>    
    	<div class="input-group">
  			<label>Past Experiences</label>
  			<textarea rows="5" cols="36"  name="achi" value=""><?php echo $row['achi']; ?></textarea>
		</div>
		<div class="input-group"></div>
  			<label>Publications</label>
  			<textarea rows="5" cols="36"  name="pub" value=""><?php echo $row['pub']; ?></textarea>
		</div>
		<div class="input-group"></div>
  			<label>Subjects</label>
  			<textarea rows="5" cols="36"  name="exp" value=""><?php echo $row['exp']; ?></textarea>
		</div>
		<div class="input-group">
  			<label>Website</label>
  			<input name="web" value="<?php echo $row['web']; ?>">
		</div>
		<div class="input-group">
  			<label>Linkedin Profile</label>
  			<input name="linkedin" value="<?php echo $row['linkedin']; ?>">
    	</div>
    	<div class="input-group">
  			<label>Display Picture</label>
  			<input type="file" name="image" onchange="readURL(this);" value="UPLOAD">
  		</div>  
		<img id="blah" src="#" alt="your image" hidden />
    	<div class="input-group">
  			<button type="submit" class="btn" name="edit">Save Changes</button>
  		</div>
		</form>
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