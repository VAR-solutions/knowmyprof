<?php
$db = mysqli_connect('localhost', 'root', 'password', 'it');
$result = mysqli_query($db, "SELECT * FROM prof");

?>

<!DOCTYPE html>
<html>
    <head>
        <title>KMP</title>
    </head>
    <body>
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