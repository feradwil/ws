
<?
require_once('nusoap.php');
$ns = "http://localhost/";
$server = new soap_server;
$server->configureWSDL('getCountiesByList', $ns);
$server->wsdl->schemaTargetNamespace = $ns;
$server->register('getCountiesByList', array('getCountiesByList' => 'xsd:string'),
array('return'=>'xsd:string'), $ns);
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
$server->service($HTTP_RAW_POST_DATA);
exit();
?>