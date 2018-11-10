<?php
  $_SESSION['page'] = $_SERVER['REQUEST_URI'];
  
?>
<!DOCTYPE html>
<html>

<head>
  <title>KMP</title>
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
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>


<body>

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
      <?php if (isset($_SESSION['username'])) : ?>
      <li class="nav-item">
        <a class="nav-link" href="index.php?logout='1'">LOGOUT</a>
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
          <p class="modal-title">LOGIN</p>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <!-- body -->
        <div class="modal-body">
          <form role="form" action="index.php" method="post">
            <div class="form-group">
              <input type="number" name="username" class="form-control" placeholder="Roll Number" />
              <input type="password" name="password" class="form-control" placeholder="Password" />

            </div>
          
        
        <!-- footer -->
        <div class="modal-footer">
          <button type="submit" name="login_user" class="btn btn-primary btn-block" id="sign">LOGIN</button>
        </div>
        </form>
        </div>
      </div>
    </div>
  </div>