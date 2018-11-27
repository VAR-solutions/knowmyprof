<?php
session_start();

if (!isset($_SESSION['username']) || !$_SESSION['admin'] ) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

//database configuration
require ('../config.php');

if (!empty($_GET['id'])) {
    $result = mysqli_query($db, "SELECT * FROM prof WHERE id = {$_GET['id']}");
    $row = $result->fetch_assoc();
}
if(isset($_POST['edit'])){
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

    <?php include('templates/header.php') ?>
    <script>
	    document.title = "Edit Details |  <?php echo "Dr. " . $row['fname'] . " " . $row['lname'];?> | Know My Professor";
    </script>
    <div class="container">
        <form method="post" action="editprof.php?id=<?php echo $row['id'] ?>" enctype="multipart/form-data">
            <div class="row headertitle">
                <div class="col-xs-8">
                    <div class="row">
                        <!-- First Name -->
                        <div class="input-group" id="prfname">
                            <input type="text" name="fname" value="<?php echo $row['fname']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <!-- Last Name -->
                            <div class="input-group" id="prlname">
                                <input type="text" name="lname" value="<?php echo $row['lname'] ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <!-- Save Button -->
                            <div class="input-group">
                                <button type="submit" class="btn btn-light" name="edit" id="editbtn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <!-- Image -->
                    <input type="file" name="image" onchange="readURL(this);" value="UPLOAD">
                    <img id="primg" style="float: none;" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($row['image']) ?>" alt="Card image">    
                    <img id="blah" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($row['image']) ?>" alt="your image" hidden/>
                </div>
            </div>
            <div class="row">
                <hr id="hrule">
            </div>
            <div class="side-body">
                <div class="row">
                    <div class="detailtitle">
                        <p>Qualifications</p>
                    </div>
                    <div class="input-group detaillist">
                        <textarea rows="5" cols="40" type="text" name="qual" value=""><?php echo $row['qual']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="detailtitle">
                        <p>Present & Past Works</p>
                    </div>
                    <div class="input-group detaillist">
                        <textarea rows="5" cols="40"  name="achi" value=""><?php echo $row['achi']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="detailtitle">
                        <p>Area of Interest</p>
                    </div>
                    <div class="input-group detaillist">
                        <textarea type="text" name="aoi"  rows="5" cols="40" value=""><?php echo $row['aoi']; ?></textarea>
                    </div> 
                </div>
                <div class="row">
                    <div class="detailtitle">
                        <p>Teaches</p>
                    </div>
                    <div class="input-group detaillist">
                        <textarea rows="5" cols="40"  name="exp" value=""><?php echo $row['exp']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="detailtitle">
                        <p>Publications</p>
                    </div>
                    <div class="input-group detaillist">
                        <textarea rows="5" cols="40"  name="pub" value=""><?php echo $row['pub']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="detailtitle">
                        <p>Contact</p>
                    </div>
                    <div class="input-group detaillist">
                        <span class="input-group-addon" id="sizing-addon2">Email</span>
                        <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" aria-describedby="sizing-addon2">
                    </div>
                    <div class="input-group detaillist">
                        <span class="input-group-addon" id="sizing-addon2">Website</span>
                        <input type="url" name="web" class="form-control" value="<?php echo $row['web']; ?>" aria-describedby="sizing-addon2">
                    </div>
                    <div class="input-group detaillist">
                        <span class="input-group-addon" id="sizing-addon2">LinkedIn</span>
                        <input name="linkedin" class="form-control" value="<?php echo $row['linkedin']; ?>" aria-describedby="sizing-addon2">
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