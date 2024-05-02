<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'clubevent');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Club Event
    </title>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
<link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php include 'header.php';?>
   <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">

          <div class="live-stream">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Our</em> Clubs</h4>
              </div>
            </div>
            <div class="row">
              <?php
                
                $req = "SELECT * FROM users WHERE club_name!=''";
                $res = mysqli_query($conn,$req);
                while($row = mysqli_fetch_array($res,MYSQLI_BOTH)){
                  echo "
              <div class='col-lg-3 col-sm-6'>
                <div class='item'>
                  <div class='thumb'>
                    <img src='assets/images/featured-02.jpg ' >
                    
                  </div>
                  <div class='down-content'>
                   
                    <span><i class='fa fa-check'></i> $row[6]</span>
                  </div> 
                </div>
              </div>";}

              ?>
              
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php';?>
  </body>
</html>
