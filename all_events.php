<?php

session_start();
$conn = mysqli_connect('localhost', 'root', '', 'clubevent');
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
                  <em>All Events</em>
                </h4>
		<?php
                if(isset($_GET['res'])){
                    if ($_GET['res']=='failed') {
                        echo '<div class="alert alert-danger" >You have already reserved a place in this event</div>';
                    }
                }
                ?>
		<table id='tab' class='display'>
        
        <thead> 
            <tr><th>#ID</th><th>Club Name</th><th>Event Name</th><th>Date</th><th>Seat availability</th><th>Action</th></tr> 
        </thead>
        <tbody> 
        	<?php
                
                $req = "SELECT * FROM events";
                $res = mysqli_query($conn,$req);
                while($row = mysqli_fetch_array($res,MYSQLI_BOTH)){
                echo "
                <tr>
                  
                  <td>$row[0]</td>
                  <td>$row[5]</td>
                  <td>$row[4]</td>
                  <td>$row[2]</td>
                  <td>$row[3]</td>";
                  if (empty($_SESSION['user'])){echo "<td></td>";}
                  
                  else{
                   if($row[3]>0) {echo "<td><a class='btn btn-success' href='reserve.php?id=$row[0]'><span >Reserve</span></a></td>";}
                	else{echo "<td><span class='btn btn-danger' >Full</span></a>";}
                  }
                  
                
               "</tr>";
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
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
 </div> <?php include 'footer.php';?> 
 <script type="text/javascript">
var toast = function(){const toastContainer =
`<div class="toast-container position-fixed bottom-0 end-0 p-3">
<div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="me-auto">Notification</strong>
        <small>1 sec ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    Your have reserved a seat successfully.
    </div>
</div>
</div>`;
document.body.insertAdjacentHTML('afterbegin', toastContainer);
test = document.getElementById('toast');
const toast = bootstrap.Toast.getOrCreateInstance(test);
toast.show();
}
 <?php
 if (($_GET['res']=="success")) {

    echo("toast();");
 }

  ?>
</script>
</body>
<script >
$(document).ready(function () {
    $('#tab').DataTable();
});
</script>
</body>
</html>