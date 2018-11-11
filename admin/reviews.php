<?php
session_start();

if (!isset($_SESSION['username']) || !$_SESSION['admin'] ) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
$db = mysqli_connect('localhost', 'root', 'password', 'it');
$result = mysqli_query($db, "SELECT * FROM reviews");
?>


<!DOCTYPE html>
<html>
    <head>
        <title>KMP</title>
    </head>
    <body>
        <h1>List of Reviews</h1>
        <ul>
            <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "<li>";
                    echo $row['review'] . " for ". mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM prof WHERE id = {$row['id']} "))['fname'];
                    echo "</li>";
                }
            ?>
        </ul>
    </body>
</html>