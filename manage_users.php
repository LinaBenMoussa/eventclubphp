<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'clubevent');
if(($_SESSION['role']!="admin")){
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
                  <em>Manage All Users</em>
                </h4>
		<table id='tab' class='display'>
        
        <thead> 
            <tr><th>#ID</th><th>Username</th><th>Email</th><th>Club Name</th><th>Active</th></tr> 
        </thead>
        <tbody> 
        	<?php
                
                $req = "SELECT * FROM users";
                $res = mysqli_query($conn,$req);
                while($row = mysqli_fetch_array($res,MYSQLI_BOTH)){
                echo "
                <tr>
                  
                  <td>$row[3]</td>
                  <td>$row[1]</td>
                  <td>$row[0]</td>
                  <td>$row[6]</td>";
                  if($row[5]==0){
                    echo '<td >
                            <a class="btn btn-success" href="activate.php?user='.$row[3].'&status=yes">
                                Activate</a></td>';
                  }
                  else{
                   echo '<td>
                            <a class="btn btn-danger" href="activate.php?user='.$row[3].'&status=no">
                                Deactivate</a></td>';
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

 </div> <?php include 'footer.php';?> </body>
<script >
$(document).ready(function () {
    $('#tab').DataTable();
});
</script>
</body>
</html>

