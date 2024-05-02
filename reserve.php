<?php


session_start();
$conn = mysqli_connect('localhost', 'root', '', 'clubevent');
if (!$_SESSION['user']){
    header('Location: Login.php');
}

else{
		$idevent = $_GET['id'];
		$user = $_SESSION['userID'];
		$req1 = "SELECT * FROM reserved_events	 WHERE id_event_reserved=$idevent and id_user_reserverd='$user'";
		$res1 = mysqli_query($conn,$req1);
		if(mysqli_num_rows($res1)>=1){
			header('Location: all_events.php?res=failed');
	    }
	    else{
	    	$req = "INSERT INTO reserved_events(id_event_reserved,id_user_reserverd) 
	        		VALUES ($idevent,'$user')";
	        $res = mysqli_query($conn,$req);
	        $req2 = "UPDATE events SET nbplaces=nbplaces-1 WHERE event_id=$idevent";
	        $res2 = mysqli_query($conn,$req2);
		        if($res){
		            header('Location: all_events.php?res=success');
		        }
	    }
}

?>




?>