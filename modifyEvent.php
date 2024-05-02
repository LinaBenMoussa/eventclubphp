<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'clubevent');
function sendEmail($email,$pass){
  $mail = new PHPMailer(true);

try {
  $mail->isSMTP();
  $message = file_get_contents('Notification.html');                  
  $mail->Host  = 'smtp.gmail.com;';       
  $mail->SMTPAuth = true;             
  $mail->Username = 'clubevent.isamm@gmail.com';        
  $mail->Password = '';         
  $mail->SMTPSecure = 'ssl';              
  $mail->Port  = 465;

  $mail->setFrom('clubevent.isamm@gmail.com', 'Club Event ISAMM');    
  $mail->addAddress($email);
  
  $mail->isHTML(true);                
  $mail->Subject = 'Event Update !';
  $mail->MsgHTML($message);
  $mail->send();
  echo "Mail has been sent successfully!";
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
if ($_SESSION['role']!="ClubPresident"){
    header('Location: index.php');
}

else{
    if (isset($_GET['id'])){
        $idevent = $_GET['id'];
        $organizer=$_SESSION['userID'];
        $req = "SELECT * FROM events WHERE organizer='$organizer'";
        $res = mysqli_query($conn,$req);
        $row = mysqli_fetch_array($res,MYSQLI_BOTH);
        
    }
    if (isset($_POST['Modify'])){
            $organizer=$_SESSION['userID'];
            $idevent = $_POST['idevent'];
            $ename = $_POST['eventname'];
            $eplace = $_POST['nbplace'];
            $org = $_SESSION['user'];
            $eclub = $_POST['clubname'];
            $edate = $_POST['date'];
            $date = date("Y-m-d\TH:i:s", strtotime($edate));
            $userID=$_SESSION['userID'];

            $req="UPDATE events set event_name='$ename' ,nbplaces='$eplace' , date_event='$date' WHERE event_id='$idevent' and organizer='$organizer'";

            $res = mysqli_query($conn,$req);
            if($res){
                if (isset($_POST['sendEmail'])) {
                  $req = "SELECT u.email FROM reserved_events as rs,users as u WHERE rs.id_event_reserved='$idevent' and rs.id_user_reserverd=u.user_id ";
                  $res = mysqli_query($conn,$req);
                  while($row = mysqli_fetch_array($res,MYSQLI_BOTH))
                  {
                    sendEmail($row[0],"aaa");
                  }
                }
                header('Location: manage_events.php?res=Msuccess');
                
            }
            else{
              header('Location: manage_events.php?res=Mfailed');
            }

    
        }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Club Event</title>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
  </head>
  <body> <?php include 'header.php';?> <div class="container d-flex justify-content-center">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="page-content">
            <div class="main-banner">
              <div class="header-text">
                <h4>
                  <em>Modify My event</em> .
                </h4>
                <div class="container px-5 my-5">
                  <form id="contactForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="alert alert-light col-lg-12" role="alert" id="message" style="display: none;">
                      <div>
                          <ul class="list-group list-group-flush">
                                <li class="list-group-item" id="invalid-feedback"></li>
                                <li class="list-group-item" id="valid-feedback"></li>
                          </ul>
                        </div>
                    </div>
                    <input type="text" name="idevent" hidden=""  value="<?php echo $row[0] ?>" >
                    <div class="form-floating mb-3">
                      <input class="form-control" id="email" type="email" name="user" placeholder="E-mail" readonly="" value="<?php echo($_SESSION['user'])?>" data-sb-validations="required" />
                      <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="clubName" type="text" name="clubname" value="<?php echo $_SESSION['clubname'] ?>" readonly="" data-sb-validations="required" />
                      <label for="clubName">Club Name</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="eventname" type="text" placeholder="Event name" name="eventname" data-sb-validations="required" required="" value="<?php echo $row[4] ?>"  />
                      <label for="eventname">Event Name</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="seatAvailability" type="number" placeholder="Seat availability" name="nbplace" data-sb-validations="required" required="" oninput="check_event()" value="<?php echo $row[3] ?>" />
                      <label for="seatAvailability">Seat availability</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="dateOfEvent" type="datetime-local" name="date"  placeholder="Date of event" data-sb-validations="required" required="" value="<?php echo $row[2] ?>" />
                      <label for="dateOfEvent">Date of event</label>
                    </div>
                    <div class="mb-3">
                      <div class="form-check form-switch">
                          <input class="form-check-input" id="sendEmail" type="checkbox" name="sendEmail" />
                          <label class="form-check-label text-white bg-dark" for="sendEmail">Would you like to send a notification to all the students ?</label>
                      </div>
                    </div>
                   
                    <div class="d-grid">
                      <button class="btn btn-primary btn-lg " value="Modify Event" name="Modify" id="submitButton" type="submit" disabled="">Modify</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </body>
</html>
<script type="text/javascript" src="verify.js"></script>
