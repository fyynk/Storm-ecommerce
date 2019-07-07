<?php 
session_start();

// if(!empty($_POST)) {
require_once"../config/cfg.php";
require_once"../config/cfgPagSeguro.php";

$itemCart = new Carrinho();

$userid = $_SESSION['userid'];
$cartCode = $itemCart->selectCartById($userid);
$tokenCard = $_POST["tokenCard"];
$hashCard = $_POST["hashCard"];
$qtdParcelas = filter_input(INPUT_POST,'qtdParcelas',FILTER_SANITIZE_SPECIAL_CHARS);
$valorParcelas = filter_input(INPUT_POST,'valorParcelas',FILTER_SANITIZE_SPECIAL_CHARS);
$cpfCartao = filter_input(INPUT_POST,'cpfCartao',FILTER_SANITIZE_SPECIAL_CHARS);
$donoCartao = filter_input(INPUT_POST,'donoCartao',FILTER_SANITIZE_SPECIAL_CHARS);
$nomeComprador = filter_input(INPUT_POST,'nomeComprador',FILTER_SANITIZE_SPECIAL_CHARS);
$dddComprador = filter_input(INPUT_POST,'dddComprador',FILTER_SANITIZE_SPECIAL_CHARS);
$telComprador = filter_input(INPUT_POST,'telComprador',FILTER_SANITIZE_SPECIAL_CHARS);
$enderecoComprador = filter_input(INPUT_POST,'enderecoComprador',FILTER_SANITIZE_SPECIAL_CHARS);
$numeroComprador = filter_input(INPUT_POST,'numeroComprador',FILTER_SANITIZE_SPECIAL_CHARS);
$complementoComprador = filter_input(INPUT_POST,'complementoComprador',FILTER_SANITIZE_SPECIAL_CHARS);
$bairroComprador = filter_input(INPUT_POST,'bairroComprador',FILTER_SANITIZE_SPECIAL_CHARS);
$cidadeComprador = filter_input(INPUT_POST,'cidadeComprador',FILTER_SANITIZE_SPECIAL_CHARS);
$uf = filter_input(INPUT_POST,'uf',FILTER_SANITIZE_SPECIAL_CHARS);
$cepComprador = filter_input(INPUT_POST,'cepComprador',FILTER_SANITIZE_SPECIAL_CHARS);

$cpfComprador = $_POST["cpfComprador"];

//Definindo variáveis do método POST CARTÃO
$numCartao = trim($_POST["numCartao"]);
$mesValidade = trim($_POST["mesValidade"]);
$anoValidade = trim($_POST["anoValidade"]);
$CVV = trim($_POST["CVV"]);

//Validação DADOS USUÁRIO
if ($nomeComprador == "") //Validação NOME VAZIO
{
	$_SESSION['error'][0] = 'Digite seu nome!';
	header("Location: ../compra.php");
	exit;
}

if ($cpfComprador == "") //Validação CPF VAZIO
{
	$_SESSION['error'][1] = 'Digite seu CPF!';
	header("Location: ../compra.php");
	exit;
}

if ($dddComprador == "") //Validação DDD VAZIO
{
	$_SESSION['error'][2] = 'Digite seu DDD!';
	header("Location: ../compra.php");
	exit;
}

if ($telComprador == "") //Validação Telefone VAZIO
{
	$_SESSION['error'][3] = 'Digite seu Telefone!';
	header("Location: ../compra.php");
	exit;
}

	//Validação dos DADOS de Residência
if ($cepComprador == "") //Validação CEP VAZIO
{
	$_SESSION['error'][4] = 'Digite seu CEP!';
	header("Location: ../compra.php");
	exit;
}

if ($enderecoComprador == "") //Validação Endereço VAZIO
{
	$_SESSION['error'][5] = 'Digite seu Endereço!';
	header("Location: ../compra.php");
	exit;
}

if ($numeroComprador == "") //Validação Numéro do Endereço VAZIO
{
	$_SESSION['error'][6] = 'Digite o número do Endereço!';
	header("Location: ../compra.php");
	exit;
}

if ($complementoComprador == "") //Validação Complemento VAZIO
{
	$_SESSION['error'][7] = 'Digite o Complemento!';
	header("Location: ../compra.php");
	exit;
}

if ($bairroComprador == "") //Validação Bairro do comprador VAZIO
{
	$_SESSION['error'][8] = 'Digite o Bairro!';
	header("Location: ../compra.php");
	exit;
}

if ($cidadeComprador == "") //Validação Cidade do comprador VAZIO
{
	$_SESSION['error'][9] = 'Digite a Cidade!';
	header("Location: ../compra.php");
	exit;
}

if ($uf == "") //Validação UF VAZIO
{
	$_SESSION['error'][10] = 'Digite a Cidade!';
	header("Location: ../compra.php");
	exit;
}


//Validação CARTÃO
if ($numCartao == "") //Validação número de cartão vazio
{
	$_SESSION['error'][11] = 'Digite o número do cartão!';
    header("Location: ../compra.php");
    exit;
}

if (strlen($numCartao) != 16) //Validação tamanho de cartão
{
	$_SESSION['error'][12] = 'Número de cartão inválido, tente novamente!';
	header("Location: ../compra.php");
	exit;
}

if ($mesValidade == "") //Validação mês de validação do cartão vazio
{
	$_SESSION['error'][13] = 'Digite o mês de validade do cartão!';
    header("Location: ../compra.php");
    exit;
}

if ($mesValidade > 12 || $mesValidade == 0) //Validação mês de validade do cartão
{
	$_SESSION['error'][14] = 'Coloque um mês existente!';
	header("Location: ../compra.php");
	exit;
}

if ($anoValidade == "") //Validação ano de validade do cartão vazio
{
	$_SESSION['error'][15] = 'Digite o ano de validade do cartão!';
	header("Location: ../compra.php");
	exit;
}

if (strlen($anoValidade) != 4) //Validação tamanho de caracteres do ano
{
	$_SESSION['error'][16] = 'Digite o ano de validade de forma correta!';
	header("Location: ../compra.php");
	exit;
}

if ($anoValidade < 2019 || $anoValidade > 3000) //Validação do ano de validade do cartão
{
	$_SESSION['error'][17] = 'Digite um ano de validade correto!';
	header("Location: ../compra.php");
	exit;
}

if ($CVV == "") //Validação do CVV vazio
{
	$_SESSION['error'][18] = 'Digite o CVV do cartão!';
	header("Location: ../compra.php");
	exit;
}

if (strlen($CVV) != 3) //Validação da quantidade de caracteres do CVV
{
	$_SESSION['error'][19] = 'Digite o tamanho correto do CVV!';
	header("Location: ../compra.php");
	exit;
}

if (isset($qtdParcelas) == "") //Validação Quantidade de parcelas VAZIA
{
    $_SESSION['error'][20] = 'Escolha a quantidade de parcelas!';
    header("Location: ../compra.php");
    exit;
}

if ($donoCartao == "") //Validação dono do cartão VAZIA
{
	$_SESSION['error'][21] = 'Digite o nome do titular do cartão!';
	header("Location: ../compra.php");
	exit;
}

if ($cpfCartao == "") //Validação CPF do titular VAZIA
{
	$_SESSION['error'][22] = 'Digite o número de CPF do titular do cartão!';
	header("Location: ../compra.php");
	exit;
}

if (strlen($cpfCartao) != 11) //Validação de CPF tamanho de caracteres
{
	$_SESSION['error'][23] = 'Digite o número de CPF do titular do cartão corretamente!';
	header("Location: ../compra.php");
	exit;
}

$data["email"]=EMAIL_PAGSEGURO;
$data["token"]=TOKEN_SANDBOX;

$data["paymentMode"]="default";
$data["paymentMethod"]="creditCard";
$data["receiverEmail"]=EMAIL_PAGSEGURO;
$data["currency"]="BRL";

$result = $itemCart->selectItemCart($userid); 
	$i = 1;
	foreach ($result as $key => $itens) {
			$key++;
			$data['itemId'.$key] =$itens['cd_jogo'];
			$data['itemDescription'.$key] = $itens['nm_jogo'];
			$data['itemAmount'.$key] = $itens['vl_jogo'];
			$data['itemQuantity'.$key] = 1;
			$data['itemWeight'.$key] = 1;
			;
		}

$data["notificationURL="]="http://localhost/TCCProgamacao/pagseguro/notificacao.php";
$data["reference"]= $cartCode;
$data["senderName"]=$nomeComprador;
$data["senderCPF"]=$cpfCartao;
$data["senderAreaCode"]=$dddComprador;
$data["senderPhone"]=$telComprador;
$data["senderEmail"]="c42759087911424803436@sandbox.pagseguro.com.br";

$data["senderHash"]=$hashCard;
$data["shippingAddressRequired"] = false;
$data["creditCardToken"]=$tokenCard;
$data["installmentQuantity"]=$qtdParcelas;
$data["installmentValue"]=$valorParcelas;
$data["noInterestInstallmentQuantity"]=2;

// Dados do Dono do Cartão
$data["creditCardHolderName"]=$donoCartao;
$data["creditCardHolderCPF"]=$cpfCartao;
$data["creditCardHolderBirthDate"]='27/10/1987';
$data["creditCardHolderAreaCode"]=$dddComprador;
$data["creditCardHolderPhone"]=$telComprador;


// Dados do Comprador
$data["billingAddressStreet"]=$enderecoComprador;
$data["billingAddressNumber"]=$numeroComprador;
$data["billingAddressComplement"]=$complementoComprador;
$data["billingAddressDistrict"]=$bairroComprador;
$data["billingAddressPostalCode"]=$cepComprador;
$data["billingAddressCity"]=$cidadeComprador;
$data["billingAddressState"]=$uf;
$data["billingAddressCountry"]="BRA";


	$buildQuery=http_build_query($data);
$url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions";

$curl = curl_init($url);
curl_setopt($curl,CURLOPT_HTTPHEADER,Array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
curl_setopt($curl,CURLOPT_POST,true);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_POSTFIELDS,$buildQuery);
$return = curl_exec($curl);
curl_close($curl);

$xml = simplexml_load_string($return);

// if($xml->error) {
// 	$_SESSION['error'] = $xml->error->message;
// }

$code = $xml->code;
// $itemCart->updateCode($code, $cartCode[0]['cd_carrinho']);

header('location: ../email.php?id='.$_SESSION['userid']);
// }else {
// 	header('location: ../index.php');
// }

 ?>