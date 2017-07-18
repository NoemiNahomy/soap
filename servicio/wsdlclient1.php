<?php
require_once('../lib/nusoap.php');
$proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
$proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';
$client = new nusoap_client('http://sfv-ciclos-cc.impuestos.gob.bo/SIN/Recaudacion/WsFacturacion/WsFacturacionContrato.svc?wsdl', 'wsdl',
						$proxyhost, $proxyport, $proxyusername, $proxypassword);
$client->soap_defencoding = 'UTF-8';
$err = $client->getError();
if ($err) {
	echo '<h2>Error</h2><pre>' . $err . '</pre>';
}
// Doc/lit parameters get wrapped
$param = array('Usuario'=> 'CONEXION2016');
$result = $client->call('PruebaConexion',$param, '', '', false, true);
$client->timeout = 90;
 if ($client->fault) {
  	echo '<h2>Fault</h2><pre>';
 	print_r($result);
 	echo '</pre>';
	} else {
	$err = $client->getError();
 	if ($err) {
		 		// Display the error
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
			}
		}
 echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
 echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
// echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
?>
