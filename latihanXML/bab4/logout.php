<?php
	//memulai session
	session start();
	//cek adanya session, jika session ada maka akan di unset 
	//dan dilanjutkan dengan session_destroy
	if(ISEET($_SESSION['username'])){
	UNSET ($_SESSION['username']);
	}
	header ("location: index.php");
	session_destroy();
	?>