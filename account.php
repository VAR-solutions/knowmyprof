<?php
session_start();
$errors = array();
include('config.php');
    if(isset($_POST['check_veri'])){
        $code = mysqli_real_escape_string($db, $_POST['veri']);
        if($code == $_SESSION['verifycode']){
            mysqli_query($db,"UPDATE users set verifi = 1 where username = {$_SESSION['tempusername']}");
            $_SESSION['verified'] = 1;
            $_SESSION['username'] = $_SESSION['tempusername'];
            header('location: index.php');
        }
        else{
            array_push($errors, "Wrong Verification code");
            header('location: account.php');
        }
    }

?>
<?php include('errors.php') ?>
<form action="account.php" method="post">
    <input name="veri" placeholder="Verification code" >
    <button name="check_veri" type="submit">Submit</button>
</form>