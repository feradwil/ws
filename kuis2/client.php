<?
require_once('nusoap.php');
$param = array('getCountiesByList' => $getCountiesByList);
$client = new
soapclient(' http://api.radioreference.com/soap2/?wsdl&v=latest');
$response = $client->call('getCountiesByList', $param);
if ($client->fault) {
echo "FAULT:<br>";
echo "Code: { $client->faultcode }<br>";5
echo "String: { $client->faultstring }";
} else {
echo $response;
}
$client=new soapclient($wsdl, 'wsdl');
$wsdl="http://localhost/ws.git/kuis2/server.php?wsdl";
echo $response = $client->call('ContryName', $param);
?>