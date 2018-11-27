<?php
session_start();

if (!isset($_SESSION['username']) || !$_SESSION['admin'] ) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
// $db = mysqli_connect('localhost', 'root', 'password', 'it');
//database configuration
require ('../config.php');


$result = mysqli_query($db, "SELECT * FROM prof");

?>

    <!-- Main Content -->
    <?php include('templates/header.php') ?>
    <script>
	    document.title = "Professors | Know My Professor | ADMIN";
    </script>
    <div class="container">
		<div class="headertitle">
            <p>List of Professors</p>
            <hr>
        </div>
        <div class="side-body">
            <div class="row" style="display: flex; flex-wrap: wrap; margin: auto; width: 90%">
                <?php while ($row = mysqli_fetch_array($result)) :?>
                <div class="card" style="width: 200px; margin: 10px;">
                    <a href = "prof.php?id=<?php echo $row[id] ?>" class="prof" >
                        <img class="card-img-top img-responsive" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($row['image']) ?>" alt="Card image" style="width:100%;height:200px; ">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $row['fname'] . " " . $row['lname']; ?></h4>
                        </div>
                    </a>
                </div>
                <?php endwhile ;?> 
            </div>
        </div>
        
    </div>
        

<?php include('templates/footer.php') ?>
