<?php


session_start();
$conn = mysqli_connect('localhost', 'root', '', 'clubevent');
if (!$_SESSION['user']){
    header('Location: Login.php');
}

else{
		$user = $_GET['user'];
		if ($_GET['status']=='yes'){
			$req = "UPDATE users set active=1 WHERE user_id='$user'";}
		else{
			$req = "UPDATE users set active=0 WHERE user_id='$user'";
		}
		$res= mysqli_query($conn,$req);
		if($res){
			header('Location: manage_users.php');
		}
}

?>
