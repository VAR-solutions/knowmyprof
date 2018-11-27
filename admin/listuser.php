<?php
session_start();

if (!isset($_SESSION['username']) || !$_SESSION['admin'] ) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
// $db = mysqli_connect('localhost', 'root', 'password', 'it');
//database configuration
require ('../config.php');


$result = mysqli_query($db, "SELECT * FROM users");

?>

	<!-- Main Content -->
    <?php include('templates/header.php') ?>
    <script>
	    document.title = "List of Users | ADMIN | Dashboard";
    </script>
    <div class="container">
		<div class="headertitle">
            <p>Registered Users</p>
            <hr>
        </div>
        <div class="side-body detaillist">
            <ul>
                <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<li>";
                        echo $row['fname'] . " ". $row['lname'];
                        echo "</li>";
                    }
                ?>
            </ul>

        </div>
    </div>

<?php include('templates/footer.php') ?>
