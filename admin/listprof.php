<?php
session_start();

if (!isset($_SESSION['username']) || !$_SESSION['admin'] ) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
$db = mysqli_connect('localhost', 'root', 'password', 'it');

$result = mysqli_query($db, "SELECT * FROM prof");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>KMP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
 
<div class="container">
    <div class="row">
<?php while ($row = mysqli_fetch_array($result)) :?>
  <div class="card" style="width:200px">
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

</body>
</html>

