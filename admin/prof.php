<?php
if (!empty($_GET['id'])) {
    $db = mysqli_connect('localhost', 'itbois', 'password', 'it');
    $result = mysqli_query($db, "SELECT * FROM prof WHERE id = {$_GET['id']}");
    $row = $result->fetch_assoc();
}
?>

<div>
    <?php
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" width="290" height="290"><br>';
        echo "Name:". $row['fname'] . " " . $row['lname']."<br>";
        echo "Email:".$row['email']."<br>";
        echo "Website:".$row['web']."<br>";
        echo "Linkedin:".$row['linkedin']."<br>";
        echo "Qualification:".nl2br($row['qual'])."<br>";
        echo "Area of Interest".nl2br($row['aoi'])."<br>";
        echo "Achivements".nl2br($row['achi'])."<br>";
        echo "Publications".nl2br($row['pub'])."<br>";
        echo "Present & Past Work:".nl2br($row['exp'])."<br>";
    ?>
</div>

<a href="editprof.php?id=<?php echo $row['id'] ?>">Edit Details</a>