<?php
if (!empty($_GET['id'])) {
    $db = mysqli_connect('localhost', 'itbois', 'password', 'it');
    $result = mysqli_query($db, "SELECT * FROM prof WHERE id = {$_GET['id']}");
    $row = $result->fetch_assoc();
}
?>

<div>
    <li>
    <?php echo $row['fname'] . " " . $row['lname']; ?>
    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" width="290" height="290">'; ?>
    </li>
</div>