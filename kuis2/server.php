
<?
require_once('nusoap.php');
$ns = "http://localhost:8084/";
$server = new soap_server;
$server->configureWSDL('CountryName', $ns);
$server->wsdl->schemaTargetNamespace = $ns;
$server->register('CountryName', array('countryname' => 'xsd:string'),
array('return'=>'xsd:string'), $ns);
function CountryName($countryname) {
if (!$countryname) {
return new soap_fault('Client', '', 'Harus ada nilainya!', '');
}
if ($conn = mysql_connect("localhost", "root", "country")) {
if ($db = mysql_select_db("country")) {
$result = mysql_query("SELECT * FROM country WHERE
countryname = '$countryname'");
while ($row = mysql_fetch_array($result)) {
$id = $row["id"];
$countryname = $row["countryname"];
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
<b>countryname: </b>$countryname<br>
<b>code: </b>$code<br>;
}
$server->service($HTTP_RAW_POST_DATA);
exit();
?>