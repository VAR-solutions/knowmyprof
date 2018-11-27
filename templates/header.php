<?php
  $_SESSION['page'] = $_SERVER['REQUEST_URI'];
  
?>
<!DOCTYPE html>
<html>

<head>
  <title>KMP</title>
  <link rel="shortcut icon" type="image/png" href="favicon.png"/>
  <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/solid.css" integrity="sha384-uKQOWcYZKOuKmpYpvT0xCFAs/wE157X5Ua3H5onoRAOCNkJAMX/6QF0iXGGQV9cP"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/fontawesome.css" integrity="sha384-HU5rcgG/yUrsDGWsVACclYdzdCcn5yU8V/3V84zSrPDHwZEdjykadlgI6RHrxGrJ"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
    crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Alegreya" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/pro.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
  
</head>


<body background="gradient_back.png">

  <nav class="navbar navbar-expand-sm sticky-top">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="index.php">
      <img src="title.png" alt="logo" style="width: 300px">
    </a>

    <!-- Links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">HOME</a>
      </li>
      <?php if (isset($_SESSION['username']) && $_SESSION['admin']!=1 ) : ?>
      <li class="nav-item dropdown" id="dropdown-nav">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
            $user = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM users WHERE username = $_SESSION[username]")); 
            echo strtoupper($user[fname] . " " . $user[lname]);

          ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" data-toggle="modal" data-target="#changepwd" href="">Change Password</a>
          <!-- <a class="dropdown-item" href="#">Another action</a> -->
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?logout='1'">LOGOUT</a>
        </div>
      </li>
      <?php elseif(isset($_SESSION['username']) && $_SESSION[admin] ==1  ): ?>
      <li class="nav-item">
        <a class="nav-link" href="admin">ADMIN</a>
      </li>
      <?php else : ?>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#popUpWindow">SIGN UP</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#popUp">LOGIN</a>
      </li>
      <?php endif; ?>

    </ul>
  </nav>
  <!-- Modal -->
  <div class="modal fade" id="popUpWindow">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- header -->
        <div class="modal-header">
          <p class="modal-title">SIGN UP</p>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <!-- body -->
        <div class="modal-body">
          <form id="register_form" role="form" method="post" action="index.php">

            <div class="form-group">
              <div id="error_msg"></div>
              <div id="succ"></div>
              <div>
                <input id="fname" name="fname" class="form-control" placeholder="First Name" required />
              </div>
              <div>
                <input id="lname" name="lname" class="form-control" placeholder="Last Name" required />
              </div>
              <div>
                <input id="username" name="username" type="number" class="form-control" placeholder="Roll Number"
                  required />
                <span></span>
              </div>
              <div>
                <input id="email" name="email" type="email" class="form-control" placeholder="Email" required />
                <span></span>
              </div>
              <div>
                <input id="password1" name="password_1" type="password" class="form-control" placeholder="Password"
                  required />
              </div>
              <div>
                <input id="password2" name="password_2" type="password" class="form-control" placeholder="Re-enter Password"
                  required />
              </div>
              <!-- footer -->
              <div class="modal-footer">
                <button type="submit" name="reg_user" class="btn btn-primary btn-block" id="signup">SIGN UP</button>
              </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  </div>

  <!-- modal for login -->
  <div class="modal fade" id="popUp">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- header -->
        <div class="modal-header">
          
          </p>
          <p class="modal-title">LOGIN</p>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <!-- body -->
        <div class="modal-body">
        <?php  if (count($errors) > 0&& $errl == 1 ): ?>
        <p style="color:red;"><?php foreach ($errors as $error) : ?>
  	      <p><?php echo $error ?></p>
          <?php endforeach ?>
          <?php echo '<script type="text/javascript">
            $(window).on("load",function(){
            $("#popUp").modal("show");
            });
            </script>' ?>
          <?php endif ?>  

          <form role="form" action="index.php" method="post">
            <div class="form-group">
            <input type="number" name="username" class="form-control" placeholder="Roll Number" required/>
            <input type="password" name="password" class="form-control" placeholder="Password" />

            </div>
          
        
        <!-- footer -->
        <div class="modal-footer">
          <button type="submit" name="login_user" class="btn btn-primary btn-block" id="sign">Login</button><br>
          <button type="submit" name="forget_pwd" class="btn btn-primary btn-block" id="forgt" >Forget Password</button>
        </div>
        </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for change password -->
  <div class="modal fade" id="changepwd">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- header -->
        <div class="modal-header">
          
          </p>
          <p class="modal-title">Change Password</p>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <!-- body -->
        <div class="modal-body">
        <?php  if ((count($errors) > 0 && $_SESSION['username'] ) || $_SESSION['forget_cpwd'] ==1 ): ?>
        <p style="color:red;"><?php foreach ($errors as $error) : ?>
  	      <p><?php echo $error ?></p>
          <?php endforeach ?>
          <?php echo '<script type="text/javascript">
            $(window).on("load",function(){
            $("#changepwd").modal("show");
            });
            </script>' ?>
          <?php endif ?>  

          <form role="form" action="index.php" method="post">
            <div class="form-group">
              <input type="password" name="oldpassword" class="form-control" placeholder="Current Password" <?php if($_SESSION['forget_cpwd'] == 1){echo "hidden";}else{echo "required";} ?>/>
                <input name="password_1" type="password" class="form-control" placeholder="Password" required />
                <input name="password_2" type="password" class="form-control" placeholder="Re-enter Password" required />
            </div>
          
        
        <!-- footer -->
        <div class="modal-footer">
          <button type="submit" name="changepwd" class="btn btn-primary btn-block" id="cpwd">Change Password</button>
        </div>
        </form>
        </div>
      </div>
    </div>
  </div>

  <!-- modal for verify account -->



    <div class="modal fade" id="veri">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- header -->
        <div class="modal-header">
          
          </p>
          <p class="modal-title">Verify Account</p>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <!-- body -->
        <div class="modal-body">
          <p>Enter the 6- digit verification code sent to your email</p>
        <?php  if ($err == 1): ?>
        <p style="color:red;"><?php foreach ($errors as $error) : ?>
  	      <p><?php echo $error ?></p>
          <?php endforeach ?>
          
        <?php endif ?>  

          <form role="form" action="index.php" method="post">
            <div class="form-group">
              <input type="number" name="veri" class="form-control" placeholder="Verification Code" required/>
            </div>
          
        
        <!-- footer -->
        <div class="modal-footer">
          <button type="submit" name="check_veri" class="btn btn-primary btn-block" id="">Verify</button>
        </div>
        </form>
        </div>
      </div>
    </div>
  </div>


  <?php if($_SESSION['verific'] == 1): ?>
  <?php echo '<script type="text/javascript">
            $(window).on("load",function(){
            $("#veri").modal("show");
            });
            </script>' ?>
  <?php endif ?>