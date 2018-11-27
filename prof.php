<?php
    session_start();
    include('serv.php');
    $tt;
    // $db = mysqli_connect('localhost', 'itbois', 'password', 'it');
    //database configuration
  require ('config.php');

  
if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $rev_check = mysqli_query($db,"SELECT * FROM reviews WHERE username = {$_SESSION['username']} AND id = {$_GET['id']}");
        $result = mysqli_query($db, "SELECT * FROM prof WHERE id = {$_GET['id']}");
        $row = $result->fetch_assoc();
        $result1 = mysqli_query($db,"SELECT * FROM reviews WHERE id = {$_GET['id']} AND username != '$username' ");
        if($rev_check->num_rows >0){
            $rev = $rev_check->fetch_assoc();
            $tt = 1;
        }else{
            $tt = 0;
        }
}
if (!empty($_GET['id']) && $tt == 0) {
    $result = mysqli_query($db, "SELECT * FROM prof WHERE id = {$_GET['id']}");
    $row = $result->fetch_assoc();
    $result1 = mysqli_query($db,"SELECT * FROM reviews WHERE id = {$_GET['id']}");
    // $reviw_row = $result1->fetch_assoc();
}

if(isset($_POST['n_review']) && $tt ==0) {
    $id = $_GET['id'];
    $username = $_SESSION['username'];
    $review = trim(mysqli_real_escape_string($db, $_POST['review']));
    mysqli_query($db,"INSERT INTO reviews (id,review,username) VALUES ('$id','$review','$username')");
    header("location: prof.php?id=".$id);
}
if(isset($_POST['editr'])){
    $id = $_GET['id'];
    $review = trim(mysqli_real_escape_string($db, $_POST['review']));
    mysqli_query($db,"UPDATE reviews SET review = '$review' WHERE id = {$_GET['id']} AND username = {$_SESSION['username']}");
    header("location: prof.php?id=".$id);
}

?>

<?php include('templates/header.php') ?>

<script>
	    document.title = "<?php echo $row['fname'] . " " . $row['lname']; ?> | Know My Professor";
    </script>

<div class = "container">
    <div class="row">
        <div class = "col-md-4 col-sm-1 col-xs-1">
        <img class = "dp" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($row['image']) ?>" alt="Card image cap">
             
        </div>
        <div class = "col-md-8 col-sm-1 col-xs-1 data">    
        <div class = "name"><?php echo $row['fname'] . " " . $row['lname']; ?></div>
        <ul>
            <!-- <li style = "color: #296dd2">
                B.tech Information Technology,IIIT Vadodara
            </li>
            <li style = "color: #296dd2" >
                M.tech Information Technology,IIT Bombay
            </li> -->
            <?php $w = preg_split('/$\R?^/m', $row['qual']); ?>
            <?php foreach ($w as $qua) : ?>
                <li style = "color: #296dd2"><?php echo $qua; ?></li>
            <?php endforeach; ?>
            
            <!-- <br> -->
            
            <!-- <li >
                Assistant Professor,IIT Kanpur (2017-present)
            </li>
            <li>
                Teaching Assistant,IIIT Vadodara (2012-2017)
            </li> -->
        <!-- </ul>
        <p>Teaches
            <ul> -->
                <br>
                <?php $w = preg_split('/$\R?^/m', $row['exp']); ?>
                <?php foreach ($w as $qua) : ?>
                    <li style = "color: #296dd2"><?php echo $qua; ?></li>
                <?php endforeach; ?>
                
                <!-- <br> -->
            </ul>
        <!-- </p> -->
        </div>
    </div>
    <div class = "row contacts">
        <div class = "col-md-4 review ">
                <a id="aaaa" href="#review"><i class="far fa-edit"></i>Add a Review
                </a></div>
        <div class ="col-md-8 mail">
                <a href="mailto:<?php echo $row['email'] ?>"><span class = "cont"> <i class="far fa-envelope cont "></i>  <?php echo $row['email'] ?></span></a>
                <span class = "cont"> <i class="fab fa-linkedin cont"></i> <?php echo $row['linkedin'] ?> </span>
                <a href=" <?php echo $row['web'] ?>"><span class = "cont"><i class="fas fa-globe-americas cont"></i>Website</span></a>
                    
        </div>
    </div>
    <hr class="part"> 
    <div class = "row">
    <div class="col-md-4 col-sm-4 col-xs-4 inter">
        <div class = "head">
            Area Of Interest
            <p class = "matter">
            <?php $w = preg_split('/$\R?^/m', $row['aoi']); ?>
            <?php foreach ($w as $qua) : ?>
                <li style = "color: black;text-align:justify;"><?php echo $qua; ?></li>
            <?php endforeach; ?>    
            </p>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4 achievements">
        <div class = "head">
            Past Experiences
            <p class = "matter">
            <?php $w = preg_split('/$\R?^/m', $row['achi']); ?>
            <?php foreach ($w as $qua) : ?>
                <li style = "color: black; text-align:justify;"><?php echo $qua; ?></li>
            <?php endforeach; ?>
            </p>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4 publi">
        <div class = "head">
            Publications
            <p class = "matter">
            <?php $w = preg_split('/$\R?^/m', $row['pub']); ?>
            <?php foreach ($w as $qua) : ?>
                <li style = "color: black; text-align:justify;"><?php echo $qua; ?></li>
            <?php endforeach; ?>
            </p>
        </div>
    </div>
    </div>
    <hr class="part"> 

    <div class="revi">
        <h2 id="heading">Reviews</h2>
        <?php if($tt == 1 ) : ?>
        <div class= "alt">
                <p class = "reviewdata">
                <i class="fa fa-pencil-square-o" data-toggle = "collapse" data-target="#editrev" title="Edit your Review" ></i>
                    <?php echo nl2br($rev['review']) ?>
                    <div class="area collapse" id="editrev">
                    <form method="post" action="prof.php?id=<?php echo $row[id] ?>">
                        <textarea  name="review" rows = "2" cols = "70" ><?php echo $rev['review'] ?></textarea>
                        <br>
                        <button name="editr" class="button" style="height:45px;width:200px ;padding:10px;font-size: 18px ;box-shadow: 7px 7px 40px grey"><span>Save Changes</span></button>

                    </form>
                </div>
                </p>
            </div>
        <hr class = "seprate">            
        <?php endif ; ?>
        <?php while ($row1 = mysqli_fetch_array($result1)) : ?>
            <div class= "alt" >
                <p class = "reviewdata">
                    <?php echo nl2br($row1['review']) ?>
                </p>
            </div>
        <hr class = "seprate">            
        <?php endwhile ; ?>
        
    </div>
    <div class="area">
        <form method="post" action="prof.php?id=<?php echo $row[id] ?>">
            <textarea id="review" name="review" rows = "2" cols = "70" placeholder="Write a review.."></textarea>
            <br>
            <button class="button new-rev"
            <?php 
                if(!$_SESSION['username']){
                // echo "disabled";
                $temp = 1;
            }?> 
            type="submit" name="n_review" 
            onmouseover="<?php if($temp==1){
                echo "ale()";
                }if($tt ==1){
                echo "al()";}?>"
            onmouseout="<?php echo "er()" ;?>"    
            style="height:45px;width:200px ;padding:10px;font-size: 18px ;box-shadow: 7px 7px 40px grey"><span>Submit</span></button>
            <p><span id="erro"></span></p>
        </form>
    </div>
    <br>
    <br>
</div>
        
    <br>
    <br>
    <br>  
  
  <script>
      function ale(){
        //   alert("You need to login first to review!!!");
        $('#erro').replaceWith("You need to login first to give review!!!");
        $('.new-rev').prop('disabled',true);
      }
      function al(){
        //   alert("You have already given review!!!");
        $('#erro').replaceWith("You have already given review!!!<br>You can edit your review.");
        $('.new-rev').prop('disabled',true);
      }
      function er(){
        $('.new-rev').prop('disabled',false);
          $('#erro').replaceWith("");
      }
  </script>
  
<?php include('templates/footer.php') ?>