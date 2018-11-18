<?php
session_start();

if (!isset($_SESSION['username']) || !$_SESSION['admin'] ) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (!empty($_GET['id'])) {
    $db = mysqli_connect('localhost', 'itbois', 'password', 'it');
    $result = mysqli_query($db, "SELECT * FROM prof WHERE id = {$_GET['id']}");
    $row = $result->fetch_assoc();
}
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
    crossorigin="anonymous">
<div class="row">
    <div class="dp">
    <img class="img-responsive " src="<?php echo 'data:image/jpeg;base64,' . base64_encode($row['image']) ?>" alt="Card image" style="width:50%;height:100%;position:fixed; ">    
    </div>
    <div class="" style="float:right;text-align:justify ;width:45%;margin-top:20px;padding:8px;">
        <?php echo "<h1>". $row['fname'] . " " . $row['lname']."</h1><br>";?>
        <h3>Qualification:-</h3>
        <ul>
        <?php $w = preg_split('/$\R?^/m', $row['qual']); ?>
            <?php foreach ($w as $qua) : ?>
                <li style = ""><?php echo $qua; ?></li>
            <?php endforeach; ?>
        </ul>
        <h3>Present & Past Works:-</h3>
        <ul>    
            <?php $ww = preg_split('/$\R?^/m', $row['achi']); ?>
            <?php foreach ($ww as $ex) : ?>
                <li><?php echo $ex; ?></li>
            <?php endforeach; ?>
        </ul>    
        <h3>Area of Interest:-</h3>
        <ul>    
            <?php $ww = preg_split('/$\R?^/m', $row['aoi']); ?>
            <?php foreach ($ww as $ex) : ?>
                <li><?php echo $ex; ?></li>
            <?php endforeach; ?>
        </ul>
        <h3>Teaches:-</h3>    
        <ul>    
            <?php $ww = preg_split('/$\R?^/m', $row['exp']); ?>
            <?php foreach ($ww as $ex) : ?>
                <li><?php echo $ex; ?></li>
            <?php endforeach; ?>
        </ul>
        
        
        
        <h3>Publications:-</h3>
        <ul>    
            <?php $ww = preg_split('/$\R?^/m', $row['pub']); ?>
            <?php foreach ($ww as $ex) : ?>
                <li><?php echo $ex; ?></li>
            <?php endforeach; ?>
        </ul>
        <span class = "cont" style="padding-right:10px; font-size:18px;"><i class="far fa-envelope cont "></i><?php echo $row['email'] ?></span><br>
        <span class = "cont" style="padding-right:10px; font-size:18px;"><i class="fab fa-linkedin cont"></i><?php echo $row['linkedin'] ?></span><br>
        <span class = "cont" style="padding-right:10px; font-size:18px;"><i class="fas fa-globe-americas cont"></i> <?php echo $row['web'] ?></span><br>
        <a href="editprof.php?id=<?php echo $row['id'] ?>">Edit Details</a>
    </div>
</div>

