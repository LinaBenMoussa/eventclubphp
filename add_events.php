<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'clubevent');

if ($_SESSION['role']!="ClubPresident"){
    header('Location: index.php');
}

else{
        if (isset($_POST['Add'])){
            $ename = $_POST['eventname'];
            $eplace = $_POST['nbplace'];
            $org = $_SESSION['user'];
            $eclub = $_POST['clubname'];
            $edate = $_POST['date'];
            $date = date("Y-m-d\TH:i:s", strtotime($edate));
            $userID=$_SESSION['userID'];

        $req="INSERT INTO events VALUES(null,'$userID','$date','$eplace','$ename','$eclub')";
        $res = mysqli_query($conn,$req);
        if($res){
            header('Location: all_events.php');
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
                  <em>add new event</em> .
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
                    <div class="form-floating mb-3">
                      <input class="form-control" id="email" type="email" name="user" placeholder="E-mail" readonly="" value="<?php echo($_SESSION['user'])?>" data-sb-validations="required" />
                      <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="clubName" type="text" name="clubname" value="<?php echo $_SESSION['clubname'] ?>" readonly="" data-sb-validations="required" />
                      <label for="clubName">Club Name</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="eventname" type="text" placeholder="Event name" name="eventname" data-sb-validations="required" required=""  />
                      <label for="eventname">Event Name</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="seatAvailability" type="number" placeholder="Seat availability" name="nbplace" data-sb-validations="required" required="" oninput="check_event()" />
                      <label for="seatAvailability">Seat availability</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="dateOfEvent" type="datetime-local" name="date"  placeholder="Date of event" data-sb-validations="required" required="" />
                      <label for="dateOfEvent">Date of event</label>
                    </div>
                   
                   
                    <div class="d-grid">
                      <button class="btn btn-primary btn-lg " value="Add Event" name="Add" id="submitButton" type="submit" disabled="">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
    
        
var currentDate = new Date();


var formattedDate = currentDate.toISOString().slice(0, 16);


document.getElementById('dateOfEvent').min = formattedDate;


document.getElementById('dateOfEvent').value = formattedDate;


document.getElementById('dateOfEvent').addEventListener('keydown', function(event) {
  event.preventDefault();
});


document.getElementById('dateOfEvent').addEventListener('paste', function(event) {
  event.preventDefault();
});
    </script>
  </body>
</html>
<script type="text/javascript" src="verify.js"></script>
