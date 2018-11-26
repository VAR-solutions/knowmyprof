<?php
    session_start();

    if (!isset($_SESSION['username']) || !$_SESSION['admin'] ) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    //database configuration
    require ('../config.php');
    if (!empty($_GET['id'])) {
        $result = mysqli_query($db, "SELECT * FROM prof WHERE id = {$_GET['id']}");
        $row = $result->fetch_assoc();
    }
?>

    <?php include('templates/header.php') ?>
    <script>
	    document.title = " <?php echo "Dr. " . $row['fname'] . " " . $row['lname'];?> | Know My Professor";
    </script>
    <div class="container">
        <div class="row headertitle">
            <div class="col-xs-8">
                <div class="row">
                    <p id="prfname">
                        <?php echo "Dr. " . $row['fname'];?>
                    </p>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <p id="prlname">
                            <?php echo $row['lname'];?>
                        </p>
                    </div>
                    <div class="col-xs-4">
                        <a href="editprof.php?id=<?php echo $row['id'] ?>">
                            <button type="button" class="btn btn-light" id="editbtn">Edit</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-4">
                <img id="primg" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($row['image']) ?>" alt="Card image">    
            </div>
        </div>
        <div class="row">
            <hr id="hrule">
        </div>
        <div class="side-body">
            <div class="row">
                <div class="detailtitle">
                    <p>Qualifications</p>
                </div>
                <ul class="detaillist">
                    <?php $w = preg_split('/$\R?^/m', $row['qual']); ?>
                    <?php foreach ($w as $qua) : ?>
                        <li><?php echo $qua; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="row">
                <div class="detailtitle">
                    <p>Present & Past Works</p>
                </div>
                <ul class="detaillist">    
                    <?php $ww = preg_split('/$\R?^/m', $row['achi']); ?>
                    <?php foreach ($ww as $ex) : ?>
                        <li><?php echo $ex; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="row">
                <div class="detailtitle">
                    <p>Area of Interest</p>
                </div>
                <ul class="detaillist">
                    <?php $ww = preg_split('/$\R?^/m', $row['aoi']); ?>
                    <?php foreach ($ww as $ex) : ?>
                        <li><?php echo $ex; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="row">
                <div class="detailtitle">
                    <p>Teaches</p>
                </div>
                <ul class="detaillist">
                    <?php $ww = preg_split('/$\R?^/m', $row['exp']); ?>
                    <?php foreach ($ww as $ex) : ?>
                    <li><?php echo $ex; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="row">
                <div class="detailtitle">
                    <p>Publications</p>
                </div>
                <ul class="detaillist">
                    <?php $ww = preg_split('/$\R?^/m', $row['pub']); ?>
                    <?php foreach ($ww as $ex) : ?>
                    <li><?php echo $ex; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="row">
                <div class="detailtitle">
                    <p>Contact</p>
                </div>
                <ul class="detaillist">
                    <span class = "cont" style="padding-right:10px; font-size:18px;"><i class="far fa-envelope cont "></i><?php echo "  " . $row['email'] ?></span><br>
                    <span class = "cont" style="padding-right:10px; font-size:18px;"><i class="fab fa-linkedin cont"></i><?php echo "  " . $row['linkedin'] ?></span><br>
                    <span class = "cont" style="padding-right:10px; font-size:18px;"><i class="fas fa-globe-americas cont"></i> <?php echo "  " . $row['web'] ?></span><br>
                </ul>
            </div>
        </div>
    </div>

<?php include('templates/footer.php') ?>