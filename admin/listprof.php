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
            <?php while ($row = mysqli_fetch_array($result)) :?>
            <div>
                <a href = "prof.php?id=<?php echo $row[id] ?> " >
                    <li>
                        <?php echo $row['fname'] . " ". $row['lname']; ?></li>
                </a></div>

            <?php endwhile ;?>    
        </ul>
    </body>
</html>