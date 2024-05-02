<?php


session_start();
$conn = mysqli_connect('localhost', 'root', '', 'clubevent');
if (!$_SESSION['user']){
    header('Location: Login.php');
}

else{
		$idevent = $_GET['id'];
		$user = $_SESSION['userID'];
		
    	$req = "DELETE FROM events WHERE event_id='$idevent' and organizer='$user'";
        $res = mysqli_query($conn,$req);
        
        
	    if($res){
	            header('Location: manage_events.php?res=Dsuccess');
		        
	    }
	    else{
	    	header('Location: manage_events.php?res=Dfailed');
	    }
}

?>


