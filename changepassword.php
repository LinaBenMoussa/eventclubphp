<?php
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'clubevent');
	if (isset($_POST['password'])) $password=MD5($_POST['password']);
	$user = $_SESSION['user'];
	$req = " UPDATE users set password = '$password' , changed=0 WHERE email='$user'";
       $res = mysqli_query($conn,$req);
       if($res){ 
       		echo "success";
       }
       else{
       		echo("failed");
       }

?>