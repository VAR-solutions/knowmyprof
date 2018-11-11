<?php
session_start();
include('serv.php');
$db = mysqli_connect('localhost', 'itbois', 'password', 'it');
if(!empty($_GET['q'])){
    $name = $_GET['q'];
    // $res = mysqli_query($db,"SELECT * FROM prof WHERE First_Name LIKE '" . mysql_real_escape_string( $name ) . "%' OR Last_Name LIKE '" . mysql_real_escape_string( $name ) ."%'";
    $sql="SELECT * FROM prof WHERE fname LIKE '" . mysqli_real_escape_string($db, $name ) . "%' OR lname LIKE '" . mysqli_real_escape_string($db, $name ) ."%'";
    $result = mysqli_query($db,$sql);
}
?>
<?php include('templates/header.php') ?>


<div class="container-fluid">
    
    
  
  
  
    <p style="font-family: 'Dancing Script', cursive; text-align: center; font-size: 30px; font-weight: 550; color:#4b4949 "><q>Good teachers know how to bring out the best in students. 
    </q></p>
    <?php if($result->num_rows >0) :?>
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner row w-100 mx-auto">
        <div class="carousel-item col-md-3 active ">
        <?php $r = mysqli_fetch_assoc($result); ?>
          <a href = "prof.php?id=<?php echo $r['id'] ?>" class = "prof" >
            <div class="card w-75.2 p-70">
            <img class="card-img-top img-fluid" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($r['image']) ?>"> 
              <div class="card-body">
                <h6 class="card-title"><span class="card-name">Name - </span><?php echo $r['fname'] . " " . $r['lname']; ?></h6>
                <p class="card-text">About professor.</p>
                
              </div>
            </div></a>
          </div>
        <?php while ($row = mysqli_fetch_array($result)) : ?>
          <div class="carousel-item col-md-3 ">
          <a href = "prof.php?id=<?php echo $row[id] ?>" class="prof" >
            <div class="card w-75.2 p-70" >
            <img class="card-img-top img-fluid" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($row['image']) ?>"> 
              <div class="card-body">
                <h6 class="card-title"><span class="card-name">Name - </span><?php echo $row['fname'] . " " . $row['lname']; ?></li></h6>
                <p class="card-text">About professor.</p>
                
              </div>
            </div></a>
            </div>
            <?php endwhile; ?>
    
        </div>
        <a class="carousel-control-prev arrborder" href="#myCarousel" role="button" data-slide="prev">
          <span aria-hidden="true"><i class="fas fa-chevron-circle-left fa-3x"></i></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next arrborder" href="#myCarousel" role="button" data-slide="next">
          <span  aria-hidden="true"><i class="fas fa-chevron-circle-right fa-3x"></i></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <?php else : ?>
      <!-- <h2 style="text-align:center">No result Found</h2> -->
      <img src="noresult.png" class="cen" >
    <?php endif ?>
      <div class="wrap-check">
      <div class="wrap">
      <div class="search">
          <form method="get" action="search.php">
         <input type="text" class="searchTerm" placeholder="SEARCH HERE" name = "q" value="<?php echo $_GET['q'] ?>" >      
         <button type="submit" class="searchButton" >
           <i class="fa fa-search"></i>
        </button>
        </form>
      </div>
    </div>
    </div>
    
    </div>
    <?php include('templates/footer.php') ?>