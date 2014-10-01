<?php
// header untuk format xml jika dihilangkan akan berbentuk  data string
header('Content-Type: text/xml; charset=ISO-8859-1');
include "koneksi.php";

//check for the path elements
$path_params = array();
$self = $_SERVER['PHP_SELF'];
$extension = substr($self, strlen($self)-3);
$path = ($extension=='php') ? NULL : $_SERVER['PATH_INFO'];


if ($path != null){
$path_params=explode ("/", $path);
}

//metode request untuk get
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
if (isset($path_params[1]) && $path_params[1] != NULL ){
    $query = "SELECT nim, nama, alamat, prodi FROM mahasiswa WHERE nim = '%s'";
    $query = sprintf($query, mysql_real_escape_string($path_params[1]));
	}else{
    $query = "SELECT nim, nama, alamat, prodi FROM mahasiswa";
	}
	$result = mysql_query($query) or die ('Query Failed : '. mysql_error());
	echo "<data>";
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo "<mahasiswa>";
		foreach ($line as $key => $col_value) {
		echo "<$key>$col_value</$key>";
		}
		echo "</mahasiswa>";
		}
	
	echo "</data>";
	mysql_free_result($result);
	}
	
	
	//metode request delete
	
	mysql_close($link);
	?>


