<?php
  require_once 'nusoap/lib/nusoap.php';
  require_once 'adodb/adodb.inc.php';
  
  $db = NewADOConnection('mysql');
 
  $server = new nusoap_server();
  $server->configureWSDL('server','urn:server');
  $server->wsdl->schemaTargetNamespace = 'urn:server';
  //register a function that works on server 
  $server->register('login_ws', 
    array(
      'username' => 'xsd:string', 
      'password'=>'xsd:string'), //parameters 
      array(
        'return' => 'xsd: string'
      ), //output 
      'urn:server', //namespace 
      'urn:server#loginServer', //soapaction
      'rpc', // style 
      'encoded', // use 
      'login'
    ); //description
      
    //create function
    function login_ws($username, $password) { //enkripsi password dengan md5 $password = md5($password);
      //buat koneksi
      $db = NewADOConnection('mysql');
      $password = md5($password);
      $db -> Connect('localhost','root','','user'); //cek username dan password dari database
      $sql = $db -> Execute("SELECT * FROM user where username='$username' AND password='$password'");
      //Cek adanya username dan password di database
      if ($sql->RecordCount() >= 1) //sama dengan mysql_num_rows pada php biasa
      {
        return "Login Berhasil";
      } else {
        return "Login gagal";
      } 
    }
	
	function getCountiesByList($getCountiesByList) {
if (!$getCountiesByList) {
return new soap_fault('Client', '', 'Harus ada nilainya!', '');
}
if ($conn = mysql_connect("localhost", "root", "country")) {
if ($db = mysql_select_db("country")) {
$result = mysql_query("SELECT * FROM country WHERE
getCountiesByList = '$getCountiesByList'");
while ($row = mysql_fetch_array($result)) {
$id = $row["id"];
$getCountiesByList = $row["getCountiesByList"];
$code = $row["code"];

}
} else {
return new soap_fault('Database Server', '', 'Koneksi ke
database gagal!', '');
}
} else {
return new soap_fault('Database Server', '', 'Koneksi ke database
gagal!', '');
}
return "<b>CountryList: </b>$country<br>
<b>id: </b>$id<br>
<b>getCountiesByList: </b>$getCountiesByList<br>
<b>code: </b>$code<br>;
}
	
    //create HTTP listener
    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ''; $server->service($HTTP_RAW_POST_DATA);
?>


