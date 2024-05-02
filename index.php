<?php

session_start();
$conn = mysqli_connect('localhost', 'root', '', 'clubevent');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Club Event</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    

</head>
<body>
	<?php include 'header.php';?>
	<?php echo $_SESSION["changedd"] ; ?>
	<div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">

          <div class="main-banner">
            <div class="row">
              <div class="col-lg-7">
                <div class="header-text">
                  <h6>Welcome To Club Event</h6>
                  <h4><em>Explore</em> The latest events Here</h4>
                  <div class="main-button">
                    <a href="all_events.php">Browse Now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          
          <div class="most-popular">
            <div class="row">
              <div class="col-lg-12">
                <div class="heading-section">
                  <h4><em>Most Popular Clubs</em> Right Now</h4>
                </div>
                <div class="row">
                  
                  
                  <?php
                
                $req = "SELECT * FROM users WHERE club_name!='' LIMIT 4";
                $res = mysqli_query($conn,$req);
                while($row = mysqli_fetch_array($res,MYSQLI_BOTH)){
                  echo "
                  <div class='col-lg-3 col-sm-6'>
                    <div class='item'>
                      <img src='assets/images/popular-03.jpg' >
                      <h4 align='center'>$row[6]</h4>
                      <ul>
                        <li><i class='fa fa-star'></i></li>
                      </ul>
                    </div>
                  </div>";}
                  ?>
                  <div class="col-lg-12">
                    <div class="main-button">
                      <a href="clubs.php">Discover All</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="gaming-library">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Recent Events</em> </h4>
              </div>
              <?php
                
                $req = "SELECT * FROM events  ORDER BY date_event DESC LIMIT 3";
                $res = mysqli_query($conn,$req);
                while($row = mysqli_fetch_array($res,MYSQLI_BOTH)){
                  echo "
                    <div class='item'>
                      <ul>
                        <li><img src='https://cdn-icons-png.flaticon.com/512/2558/2558944.png' class='templatemo-item'></li>
                        <li><h4>Club Name</h4><span>$row[5]</span></li>
                        <li><h4>Date Added</h4><span>$row[2]</span></li>
                        <li><h4>Event Name</h4><span>$row[4]</span></li>
                        <li><h4>Seat availability</h4><span>$row[3]</span></li>
                      </ul>
                    </div>";}
            ?>
            <div class="col-lg-12">
              <div class="main-button">
                <a href="all_events.php">View All Events</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php';?>
 <div class="modal" tabindex="-1" id="exampleModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
      <div class="modal-body">
        <div class="alert alert-light col-lg-12" role="alert" id="message" style="display: none;">
                      <div>
                          <ul class="list-group list-group-flush">
                                <li class="list-group-item" id="invalid-feedback"></li>
                                <li class="list-group-item" id="valid-feedback"></li>
                          </ul>
                        </div>
                    </div>
        <p>Your password has been changed recently . Would you like to change it again ?</p>
        <div class="form-floating mb-3">
                      <input oninput ='verifyPassword()' class="form-control" id="password" name="password" type="password" placeholder="Password"  required="" />
                      <label for="password">Password</label>
                    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="submit" class="btn btn-primary" disabled="" data-bs-dismiss="modal">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>
  <?php if (isset($_GET['ch'])) {
    if ($_GET['ch']==1){
    echo "<script type='text/javascript'> $(window).on('load',function(){ $('#exampleModal').modal('show'); }); </script>";}

  }
  ?>
            
          
</body>
  
</html>

<script>
var toast = function(){const toastContainer =
`<div class="toast-container position-fixed bottom-0 end-0 p-3">
<div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="me-auto">Notification</strong>
        <small>1 sec ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    Your password has been changed successfully.
    </div>
</div>
</div>`;
document.body.insertAdjacentHTML('afterbegin', toastContainer);
test = document.getElementById('toast');
const toast = bootstrap.Toast.getOrCreateInstance(test);
toast.show();
}
$(document).ready(function(){
 
    $("#submit").click(function(e){
        e.preventDefault();
 
        $.post(
            'changepassword.php', 
            {
                password : $("#password").val()
            },
 
            function(data){
 
                if(data == 'success'){
                    toast();
                     <?php
                        $_SESSION['changedd']='0';
                     ?>
                }
                else{
                    return "f";
 
                     
                }
         
            },
            'text'
         );
    });
});
</script>
        <script type="text/javascript" src="verify.js"></script>
