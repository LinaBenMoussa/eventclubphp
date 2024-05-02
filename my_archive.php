<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'clubevent');
if(empty($_SESSION['user'])){
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Club Event</title>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
	  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
<link rel="stylesheet" href="assets/css/style.css">
	
</head>
<body>
	<?php include 'header.php';?>
	<div class="container text-white">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="page-content">
            <div class="main-banner">
              <div class="header-text">
                <h4>
                  <em>my archive</em>
                </h4>
		<table id='tab' class='display'>
        
        <thead> 
            <tr><th>Event Name</th><th>Club Name</th><th>Date</th></tr> 
        </thead>
        <tbody>
                <?php
                $user = $_SESSION['userID'];
                $req = "SELECT r.id_event_reserved,event_name,club_name,date_event FROM events ,reserved_events r WHERE r.id_user_reserverd='$user' and r.id_event_reserved=events.event_id";
                $res = mysqli_query($conn,$req);
                while($row = mysqli_fetch_array($res,MYSQLI_BOTH)){
                echo "
                <tr>
                  
                  <td>$row[1]</td>
                  <td>$row[2]</td>
                  <td>$row[3]</td>
                  
               </tr>";
                };
                ?>
              </tbody>
    </table>
	</div>
</div>
</div>
</div>
</div>
</div>
 </div> <?php include 'footer.php';?> </body>
<script >
$(document).ready(function () {
    $('#tab').DataTable();
});
</script>
</body>
</html>

