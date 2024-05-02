<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'clubevent');
$connect="";
if(empty($_SESSION['user'])){
if (isset($_POST['Connect'])){
    $user = $_POST['email'];
    $pwd = md5($_POST['password']);

  
    $req = " SELECT * FROM users WHERE email='$user' and password='$pwd'";
    $res = mysqli_query($conn,$req);

    $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
    if(mysqli_num_rows($res)==1){
       if($row['active']==1){ 
            $_SESSION['Connected'] = 1;
            $_SESSION["role"] = $row['role'];
            $_SESSION['user'] = $row['username'];
            $_SESSION['userID'] = $row['user_id'];
            $_SESSION['clubname'] = $row['club_name'];
            $_SESSION['changedd'] = $row['changed'];
            
            header('Location: index.php?ch='.$row['changed']);
        }
        else{
            header('Location: Login.php?active=no');
        }
    }
    else{
        $connect='failed';
    }

    
}}
else{
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Club Event</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/style.css">
    
  </head>
  <body> <?php include 'header.php';?> 
  <div class="container d-flex justify-content-center">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="page-content">
            <div class="main-banner">
              <div class="header-text">
                <h4>
                  <em>Login</em> To your account
                </h4>
                <?php
                    if ($connect=='failed') {
                        echo '<div class="alert alert-danger" role="alert">Wrong Email or password !</div>';}
                    
                ?>
                <?php
                    if (isset($_GET['active'])) {
                        if($_GET['active']=="yes"){
                            echo '<div class="alert alert-success" role="alert">Signup success.</div>';
                        }
                        else{
                        echo '<div class="alert alert-danger" role="alert">You account is not active yet!</div>';}
                    }
                ?>
                <div class="container px-5 my-5">
                  <form id="contactForm" data-sb-form-api-token="API_TOKEN" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-floating mb-3">
                      <input class="form-control" id="emailAddress" name="email" type="email" placeholder="Email Address" data-sb-validations="required,email" required="" />
                      <label for="emailAddress">Email Address</label>
                      
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="password" name="password" type="password" placeholder="Password" data-sb-validations="required" required="" />
                      <label for="password">Password</label>
                    </div>
                    <div class="d-grid">
                      <a href="forgetpassword.php"><span>Forgot your password ?</span></a>
                    </div>
                   
                    <div class="d-grid">
                      <button class="btn btn-primary btn-lg " id="submitButton" name="Connect" type="submit">Submit</button>
                    </div>
                  </form>
                </div>
                <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">

    </script>
      <?php include 'footer.php';?>

  </body>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>
</html>