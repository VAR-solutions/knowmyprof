<?php
  
  $errors = array();
  //database configuration
  require_once('config.php');
  
  $result = mysqli_query($db, "SELECT * FROM prof");

  include('serv.php');
  include('process.php');
  include('templates/header.php');

?>


<div class="container-fluid">
    
    
  
  
  
<p style="font-family: 'Dancing Script', cursive; text-align: center; font-size: 30px; font-weight: 550; color:#4b4949 ;margin-bottom:20px;"><q>Good teachers know how to bring out the best in students.</q></p>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner row w-100 mx-auto">
    <div class="carousel-item col-md-3 active ">
    <?php $r = mysqli_fetch_assoc($result); ?>
      <a href = "prof.php?id=<?php echo $r['id'] ?>" class = "prof" >
        <div class="card w-75.2 p-70">
        <img class="card-img-top img-fluid" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($r['image']) ?>"> 
          <div class="card-body">
            <h6 class="card-title"><?php echo $r['fname'] . " " . $r['lname']; ?></h6>
            <p class="card-text"><i class="far fa-envelope " id="emai"> </i> <?php echo $r['email'] ?></p>
            
          </div>
        </div></a>
      </div>
    <?php while ($row = mysqli_fetch_array($result)) : ?>
      <div class="carousel-item col-md-3 ">
      <a href = "prof.php?id=<?php echo $row[id] ?>" class="prof" >
        <div class="card w-75.2 p-70" >
        <img class="card-img-top img-fluid" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($row['image']) ?>"> 
          <div class="card-body">
            <h6 class="card-title"><?php echo $row['fname'] . " " . $row['lname']; ?></li></h6>
            <p class="card-text"><i class="far fa-envelope" id="emai"> </i> <?php echo $row['email'] ?></p>
            
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
  <script type="text/javascript">
    $(document).ready(function(){
      $('.searchTerm').on("keyup input", function(){
          /* Get input value on change */
          var inputVal = $(this).val();
          var resultDropdown = $(this).siblings(".livesearch");
          if(inputVal.length){
              $.get("livesearch.php", {term: inputVal}).done(function(data){
                  // Display the returned data in browser
                  resultDropdown.html(data);
              });
          } else{
              resultDropdown.empty();
          }
      });
      
      // Set search input value on click of result item
      $(document).on("click", ".livesearch p", function(){
          $(this).parents(".search").find('.searchTerm').val($(this).text());
          $(this).parent(".livesearch").empty();
      });
    });
  </script>
  <div class="wrap-check">
  <div class="wrap">
  <div class="search">
      <form method="get" action="search.php" target="_blank">
     <input type="text" class="searchTerm" placeholder="SEARCH HERE" name = "q" autocomplete="off">      
     <button type="submit" class="searchButton" >
       <i class="fa fa-search"></i>
    </button>
    <div class="livesearch"></div>
    </form>
    
  </div>
</div>
</div>
</div>
<?php include('templates/footer.php') ?>
