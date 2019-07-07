<?php 

require_once "../config/cfgPagSeguro.php"; // inclui as  as constantes da conta

//monta a url do pag seguro com as credencias (que foram setadas na config.php)
$url="https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email=".EMAIL_PAGSEGURO."&token=".TOKEN_SANDBOX."";
$curl=curl_init($url);
curl_setopt($curl,CURLOPT_HTTPHEADER,array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
curl_setopt($curl,CURLOPT_POST,1);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
$return = curl_exec($curl);
curl_close($curl);

$xml = simplexml_load_string($return);
echo json_encode($xml);

 ?>