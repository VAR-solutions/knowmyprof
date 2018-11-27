<?php
session_start();

if (!isset($_SESSION['username']) || !$_SESSION['admin'] ) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
//database configuration
require ('../config.php');


$result = mysqli_query($db, "SELECT * FROM reviews");
?>

    <!-- Main Content -->
    <?php include('templates/header.php') ?>
    <script>
	    document.title = "List of Reviews | Know My Professor | ADMIN | Dashboard";
    </script>
    <div class="container">
        <div class="headertitle">
            <p>User Reviews</p>
            <hr>
        </div>
        <div class="side-body detaillist">
            <ul>
                <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<li>";
                        echo $row['review'] . " for ". mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM prof WHERE id = {$row['id']} "))['fname'];
                        echo "</li>";
                    }
                ?>
            </ul>

        </div>
    </div>

<?php include('templates/footer.php') ?>
