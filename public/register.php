<?php
/**
 * Created by PhpStorm.
 * User: voldemort
 * Date: 4/10/18
 * Time: 9:30 AM
 */
if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";

    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $new_user = array(
            "firstname" => $_POST['firstname'],
            "lastname"  => $_POST['lastname'],
            "email"     => $_POST['email'],
            "password"  => $_POST['password'],
            "id"  => $_POST['id']
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "users",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote><?php echo $_POST['firstname']; ?> successfully added.</blockquote>
<?php } ?>

    <h2>Add a user</h2>

    <form method="post">
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" id="firstname"><br>
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" id="lastname"><br>
        <label for="email">Email Address</label>
        <input type="text" name="email" id="email"><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password"><br>
        <label for="id">Roll No.</label>
        <input type="text" name="id" id="id"><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>