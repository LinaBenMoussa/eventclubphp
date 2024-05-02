<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'clubevent');
$connect="";
if (isset($_POST['signup'])){
    $user = $_POST['email'];
    $pwd = md5($_POST['password']);
    if (isset($_POST['clubname'])){
      $cname = $_POST['clubname'];
    }

    $Role = $_POST['Role'];
    $active=1;
    $req = " SELECT * FROM users WHERE email='$user'";
    $res = mysqli_query($conn,$req);
    $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
    if(mysqli_num_rows($res)==0){
        if ($Role=="Student"){
          $req = "INSERT INTO users  VALUES('$user','$user','$pwd',null,'$Role',$active,null,0)";
        }
        else{
          $active=0;
          $req = "INSERT INTO users  VALUES('$user','$user','$pwd',null,'$Role',$active,'$cname',0)";
        }
       
        $res = mysqli_query($conn,$req);
        if (!$res) {
          header('Location: signup.php');
        }
        if($res&&$active==0){
            header('Location: login.php?active=no');
        }
        else{
            header('Location: login.php?active=yes');
        }
    }
    else{
      header('Location: SignUp.php?exist=yes');
    }
    
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
    <link rel="stylesheet" href="assets/css/fontawesome.css">
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
                  <em>SignUp</em> To Join US.
                </h4>
                <div class="container px-5 my-5">
                  <form id="contactForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <?php
                        if(isset($_GET['exist'])=="yes"){
                            echo '<div class="alert alert-light col-lg-12" role="alert">Email already exist.</div>';
                        } 
                    ?>
                    <div class="alert alert-light col-lg-12" role="alert" id="message" style="display: none;">
                      <div>
                          <ul class="list-group list-group-flush">
                                <li class="list-group-item" id="invalid-feedback"></li>
                                <li class="list-group-item" id="valid-feedback"></li>
                          </ul>
                        </div>
                    </div>
                    <div class="mb-3">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" id="clubPresident" value="ClubPresident" name="Role" type="radio" name="role" data-sb-validations="required"  onchange="getValue(this.value)"/>
                        <label class="form-check-label text-white"  for="clubPresident">Club President</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" id="student" checked="" onchange="getValue(this.value)" value="Student" name="Role" type="radio" name="role" data-sb-validations="required" />
                        <label class="form-check-label text-white"  for="student">Student</label>
                      </div>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="email" name="email" type="email" placeholder="Email" data-sb-validations="required" required="" />
                      <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input oninput='check();' class="form-control " id="password" name="password" type="password" placeholder="Password" data-sb-validations="required"  required="" />
                      <label for="password">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input oninput='check();' class="form-control" id="cpassword" name="cpassword" type="password" placeholder="Password" data-sb-validations="required" required="" />
                      <label for="password">Confirm Password</label>
                      
                    </div>
                    <div class="col-lg-12 form-floating mb-3" id="cname" style="display: none;">
                      <input class="form-control" id="clubName" name="clubname" type="text" placeholder="Club Name" data-sb-validations="required"   />
                      <label for="clubName">Club Name</label>
                    </div>
                    
                   
                   
                    <div class="d-grid">
                      <button class="btn btn-primary btn-lg " id="submitButton" name="signup" type="submit" disabled="">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <?php include 'footer.php';?> </body>
    <script type="text/javascript" src="verify.js"></script>
</html>