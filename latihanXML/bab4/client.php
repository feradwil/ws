<?php
	//memulai session
	session_start();
	//panggil library
	require_once('nusoap/lib/nusoap.php');
	//mendefinisikan alamat url service yang disediakan oleh client
	$url='http://localhost/dev/ws.git/latihanXML/bab4/server.php?wsdl';
	$client=new nusoap_client ($url, 'WSDL');
	$username=isset($_POST["username"]) ? $_POST["username"] : 'admin';
	$password=isset($_POST["password"]) ? $_POST["password"] : '123';
	$result-$client->call('login_ws', array('username'=>$username, 'password'=>$password));
	if($result=="Login Berhasil"){
	$_SESSION['username']=$username;
	header ("location: index.php");
	} else {
	header ("location:login.php");
	}
	?>
	