<?php
session_start();

if (!isset($_SESSION['username']) || !$_SESSION['admin'] ) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}


$email    = "";
$fname = "";
$lname = "";
$aoi = "";
$qual = "";
$achi = "";
$imgContent;
$errors = array();

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
					$query = "INSERT INTO prof (fname, lname, aoi,email,qual, achi,image,pub,web,linkedin,exp)
								VALUES('$fname', '$lname','$aoi' ,'$email','$qual', '$achi', '$imgContent','$pub','$web','$linkedin','$exp')";
					mysqli_query($db, $query);
					$_SESSION['success'] = "You are now logged in";
					header('location: index.php');
				}
		}	
?>

	<!-- Main Content -->
	<?php include('templates/header.php') ?>
    <script>
	    document.title = "Add Professor | Know My Professor | ADMIN";
    </script>
    <div class="container">
        <div class="headertitle">
            <p>Add Professor</p>
        </div>
        <div class="row">
            <hr id="hrule">
        </div>
        <form method="post" action="newprof.php" enctype="multipart/form-data">
            <?php include('errors.php'); ?>

            <div class="side-body">

                <div class="row">
                    <div class="col-xs-8">
                        <div class="row detailtitle">
                            <!-- First Name -->
                            <div class="input-group" id="prfname">
                                <input type="text" placeholder="First Name" name="fname" value="<?php echo $fname; ?>" required>
                            </div>
                        </div>
                        <div class="row detailtitle">
                            <!-- Last Name -->
                            <div class="input-group" id="prlname">
                                <input type="text" placeholder="Last Name" name="lname" value="<?php echo $lname; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <!-- Image -->
                        <input type="file" name="image" onchange="readURL(this);" value="UPLOAD">
                        <img id="primg" style="float: none;" src="#" alt="Professor Image">    
                        <img id="blah" src="#" alt="your image" hidden/>
                    </div>
                </div>

                <!-- Qualifications -->
                <div class="row">
                    <div class="detailtitle">
                        <p>Qualifications</p>
                    </div>
                    <div class="input-group detaillist">
                        <textarea rows="5" cols="40" placeholder="Write Here..." type="text" name="qual" value="" required><?php echo $qual; ?></textarea>
                    </div>
                </div>

                <!-- Present & Past Works -->

                <div class="row">
                    <div class="detailtitle">
                        <p>Present & Past Works</p>
                    </div>
                    <div class="input-group detaillist">
                        <textarea rows="5" cols="40" placeholder="Write Here..." name="achi" value="" required><?php echo $achi; ?></textarea>
                    </div>
                </div>

                <!-- Area of Interest -->

                <div class="row">
                    <div class="detailtitle">
                        <p>Area of Interest</p>
                    </div>
                    <div class="input-group detaillist">
                        <textarea type="text" name="aoi" placeholder="Write Here..." rows="5" cols="40" value="" required><?php echo $aoi; ?></textarea>
                    </div> 
                </div>

                <!-- Teaches -->

                <div class="row">
                    <div class="detailtitle">
                        <p>Teaches</p>
                    </div>
                    <div class="input-group detaillist">
                        <textarea rows="5" cols="40" placeholder="Write Here" name="exp" value="" required><?php echo $exp; ?></textarea>
                    </div>
                </div>

                <!-- Publications -->

                <div class="row">
                    <div class="detailtitle">
                        <p>Publications</p>
                    </div>
                    <div class="input-group detaillist">
                        <textarea rows="5" cols="40" placeholder="Write Here..." name="pub" value="" required><?php echo $pub; ?></textarea>
                    </div>
                </div>

                <!-- Contacts -->

                <div class="row">
                    <div class="detailtitle">
                        <p>Contacts</p>
                    </div>
                    <div class="input-group detaillist">
                        <span class="input-group-addon" id="sizing-addon2">Email</span>
                        <input type="email" name="email" placeholder="prof@example.com" class="form-control" value="<?php echo $email; ?>" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group detaillist">
                        <span class="input-group-addon" id="sizing-addon2">Website</span>
                        <input type="url" name="web" placeholder="http://www.example.com" class="form-control" value="<?php echo $web; ?>" aria-describedby="sizing-addon2">
                    </div>
                    <div class="input-group detaillist">
                        <span class="input-group-addon" id="sizing-addon2">Linkedin</span>
                        <input name="linkedin" placeholder="http://www.linkedin.com/username" class="form-control" value="<?php echo $linkedin; ?>" aria-describedby="sizing-addon2">
                    </div>
                </div>
                <div class="row">
                    <!-- Save Button -->
                    <div class="input-group">
                        <button type="submit" class="btn btn-light" name="reg_user" id="editbtn">Add</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


<script>
	function readURL(input) {
        if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#blah')
				.attr('src', e.target.result)
                .attr('max-width', "100%")
                .attr('height', "180px")
                .attr('margin', "0")
                .attr('display', "block")
                .attr('hidden',false);
                $('#primg').remove();
			};
			reader.readAsDataURL(input.files[0]);
    	}
    }
</script>


<?php include('templates/footer.php') ?>