<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
session_start();
function sendEmail($email,$pass){
  $mail = new PHPMailer(true);

try {
  $mail->isSMTP();
  $message = file_get_contents('forgetpassword.html'); 
  $message = str_replace('%email%', $$email, $message); 
  $message = str_replace('%password%', $pass, $message);                    
  $mail->Host  = 'smtp.gmail.com;';       
  $mail->SMTPAuth = true;             
  $mail->Username = 'clubevent.isamm@gmail.com';        
  $mail->Password = '';         
  $mail->SMTPSecure = 'ssl';              
  $mail->Port  = 465;

  $mail->setFrom('clubevent.isamm@gmail.com', 'Club Event ISAMM');    
  $mail->addAddress($email);
  
  $mail->isHTML(true);                
  $mail->Subject = 'Your new password is here';
  $mail->MsgHTML($message);
  $mail->send();
  echo "Mail has been sent successfully!";
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); 
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); 
}
$conn = mysqli_connect('localhost', 'root', '', 'clubevent');
$connect="";
if(empty($_SESSION['user'])){
if (isset($_POST['Connect'])){
    $user = $_POST['email']; 
    $req = " SELECT * FROM users WHERE email='$user'";
    $res = mysqli_query($conn,$req);
    $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
    if(mysqli_num_rows($res)==1){
       $newpassword = randomPassword();
       $newpassword2 = md5($newpassword);
       $req = " UPDATE users set password = '$newpassword2' , changed=1 WHERE email='$user'";
       $res = mysqli_query($conn,$req);
       if($res){ 
           
            
            sendEmail($user,$newpassword);
            header('Location: forgetpassword.php?active=yes');
        }
        else{
            header('Location: forgetpassword.php?active=no');
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
                  
                  <h4><em>retreive your</em> account</h4>
                </h4>
                <?php
                    if ($connect=='failed') {
                        echo '<div class="alert alert-danger" role="alert">Verify your email again !</div>';}
                    
                ?>
                <?php
                    if (isset($_GET['active'])) {
                        if($_GET['active']=="yes"){
                            echo '<div class="alert alert-success" role="alert">An Email with a new password has been sent.</div>';
                        }
                        else{
                        echo '<div class="alert alert-danger" role="alert">We Couldnt find your account.</div>';}
                    }
                ?>
                <div class="container px-5 my-5">
                  <form id="contactForm" data-sb-form-api-token="API_TOKEN" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-floating mb-3">
                      <input class="form-control" id="emailAddress" name="email" type="email" placeholder="Email Address" data-sb-validations="required,email" />
                      <label for="emailAddress">Email Address</label>
                      
                    </div>
                    
                   
                    <div class="d-grid">
                      <button class="btn btn-primary btn-lg " id="submitButton" name="Connect" type="submit">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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