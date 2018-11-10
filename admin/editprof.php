<?php
if (!empty($_GET['id'])) {
    $db = mysqli_connect('localhost', 'itbois', 'password', 'it');
    $result = mysqli_query($db, "SELECT * FROM prof WHERE id = {$_GET['id']}");
    $row = $result->fetch_assoc();
}
if(isset($_POST['edit'])){
    $db = mysqli_connect('localhost', 'itbois', 'password', 'it');
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
    mysqli_query($db,"UPDATE prof SET fname = '$fname', lname = '$lname', email = '$email',web = '$web',linkedin = '$linkedin' WHERE id=$id");
    header('location: prof.php?id='.$id);
}
?>


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
  			<textarea type="text" name="qual" value=""><?php echo $row['email']; ?></textarea>
    	</div>
    	<div class="input-group">
  			<label>Area of interest</label>
  			<textarea type="text" name="aoi" value=""><?php echo $row['aoi']; ?></textarea>
  		</div>    
    	<div class="input-group">
  			<label>Achivements</label>
  			<textarea name="achi" value=""><?php echo $row['achi']; ?></textarea>
		</div>
		<div class="input-group">
  			<label>Publications</label>
  			<textarea name="pub" value=""><?php echo $row['pub']; ?></textarea>
		</div>
		<div class="input-group">
  			<label>Past Experience</label>
  			<textarea name="exp" value=""><?php echo $row['exp']; ?></textarea>
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
  			<input type="file" name="image" value="UPLOAD">
  		</div>  
    	<div class="input-group">
  			<button type="submit" class="btn" name="edit">Save Changes</button>
  		</div>
		</form>