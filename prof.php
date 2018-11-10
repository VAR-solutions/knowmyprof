<?php
    session_start();
    include('serv.php');
    $tt;
    $db = mysqli_connect('localhost', 'itbois', 'password', 'it');
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
    $review = mysqli_real_escape_string($db, $_POST['review']);
    mysqli_query($db,"INSERT INTO reviews (id,review,username) VALUES ('$id','$review','$username')");
    header("location: prof.php?id=".$id);
}
if(isset($_POST['editr'])){
    $id = $_GET['id'];
    $review = mysqli_real_escape_string($db, $_POST['review']);
    mysqli_query($db,"UPDATE reviews SET review = '$review' WHERE id = {$_GET['id']} AND username = {$_SESSION['username']}");
    header("location: prof.php?id=".$id);
}

?>

<?php include('templates/header.php') ?>

<div class = "container">
    <div class = "row">
        <div class = "col-md-4">
        <img class = "dp" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($row['image']) ?>" alt="Card image cap">
             
        </div>
        <div class = "col-md-8 data">    
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
            
            <br>
            <?php $ww = preg_split('/$\R?^/m', $row['exp']); ?>
            <?php foreach ($ww as $ex) : ?>
                <li><?php echo $ex; ?></li>
            <?php endforeach; ?>
            <!-- <li >
                Assistant Professor,IIT Kanpur (2017-present)
            </li>
            <li>
                Teaching Assistant,IIIT Vadodara (2012-2017)
            </li> -->
        </ul>
        </div>
    </div>
    <div class = "row contacts">
        <div class = "col-md-4 review ">
                <a id="aaaa" href="#review"><i class="far fa-edit"></i>Add a Review
                </a></div>
        <div class ="col-md-8 mail">
               <span class = "cont"> <i class="far fa-envelope cont "></i>  <?php echo $row['email'] ?></span>
               <span class = "cont"> <i class="fab fa-linkedin cont"></i> <?php echo $row['linkedin'] ?> </span>
                <span class = "cont"><i class="fas fa-globe-americas cont"></i> <?php echo $row['web'] ?> </span>
                    
        </div>
    </div>
    <hr class="part"> 
    <div class = "row">
    <div class="col-md-4 inter">
        <div class = "head">
            Area Of Interest:
            <p class = "matter">
               <?php echo nl2br($row['aoi']); ?>     
            </p>
        </div>
    </div>
    <div class="col-md-4 achievements">
        <div class = "head">
            Achievements:
            <p class = "matter">
                <?php echo $row['achi'] ?>
            </p>
        </div>
    </div>
    <div class="col-md-4 publi">
        <div class = "head">
            Publications:
            <p class =  "matter"><?php echo nl2br($row['pub']) ?></p>
        </div>
    </div>
    </div>
    <hr class="part"> 

    <div class="revi">
        <h2 id="heading">Reviews</h2>
        <?php if($tt == 1 ) : ?>
        <div class= "alt">
                <p class = "reviewdata">
                    <?php echo nl2br($rev['review']) ?>
                    <i class="fa fa-pencil-square-o" data-toggle = "collapse" data-target="#editrev" ></i>
                    <div class="area collapse" id="editrev">
                    <form method="post" action="prof.php?id=<?php echo $row[id] ?>">
                        <textarea  name="review" rows = "2" cols = "70" placeholder="Write a review.."><?php echo $rev['review'] ?></textarea>
                        <br>
                        <button name="editr" class="button"style="height:45px;width:200px ;padding:10px;font-size: 18px ;box-shadow: 7px 7px 40px grey"><span>Save Changes</span></button>

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
        <!-- <div class= "alt" ><p class = "reviewdata">
            <q>Kaise kaiso ko diya hai ,aise waiso ko diya Mujhko bhi to lift kara de
            Thodi si to lift kara de</q> </p></div>
        <hr class = "seprate">
        <div class= "alt" ><p class = "reviewdata">
                Kaise kaiso ko diya hai ,aise waiso ko diya Mujhko bhi to lift kara de
                Thodi si to lift kara de jdwbjdjwhjd 
             whfrkefk 
            f3kfnk jl </p></div>
        <hr class = "seprate">
        <div class= "alt" ><p class = "reviewdata">
             Kaise kaiso ko diya hai ,aise waiso ko diya Mujhko bhi to lift kara de
             Thodi si to lift kara de </p></div> -->
    </div>
    <div class="area">
        <form method="post" action="prof.php?id=<?php echo $row[id] ?>">
            <textarea id="review" name="review" rows = "2" cols = "70" placeholder="Write a review.."></textarea>
            <br>
            <button class="button"
            <?php if(!$_SESSION['username']){
                // echo "disabled";
                $temp = 1;
            }?> type="submit" name="n_review" onmouseover="<?php if($temp===1){
                echo "ale()";
            } ?>"
            style="height:45px;width:200px ;padding:10px;font-size: 18px ;box-shadow: 7px 7px 40px grey"><span>Submit</span></button>
            
        </form>
    </div>
    <br>
    <br>
</div>
    
   
   <br>  
  
  <script>
      function ale(){
          alert("You need to login first to review!!!");
      }
  </script>
  
<?php include('templates/footer.php') ?>