<?php
session_start();
$db = mysqli_connect('localhost', 'root', 'password', 'it');
$result = mysqli_query($db, "SELECT * FROM prof");
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>KMP</title>
    </head>
    <body>
    <?php  if (isset($_SESSION['username'])) :?>
    	<!-- <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p> -->
        <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php else : ?>
        <a href="login.php" >Login</a>
        <a href="register.php">Signup</a>
    <?php endif ;?>
        
        <h1>List of professors</h1>
        <ul>
            <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "<li>";
                    echo $row['fname'] . " ". $row['lname'];
                    echo "</li>";
                    // echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" width="290" height="290">';
                }
            ?>
        </ul>
    </body>
</html>