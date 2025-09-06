<?php

namespace DerckJunior\mpesa;
require_once('Tokenizer.php');

// ------------------------------------------

// RECEBENDO OS PARAMETROS
$numero = '258' . $_POST['numero'];
$valor = $_POST['valor'];



// DADOS DA API
$url = 'https://api.sandbox.vm.co.mz:18352/ipg/v1x/c2bPayment/singleStage/';

$API_KEY = 'COLOQUE SUA API_KEY AQUI';

$PUBLIC_KEY = 'COLOQUE SUA PUBLIC_KEY AQUI';

// CRIANDO O BEARER TOKEN
$bearerToken = Tokenizer::token($API_KEY, $PUBLIC_KEY);


// INICIO DA REQUISICAO
// CONFIGURANDO A MESNAGEM
$mensagem = [
	"input_Amount" => $valor,
	"input_CustomerMSISDN" =>  $numero,
	"input_ServiceProviderCode" => 171717,
	"input_TransactionReference" => 33331,
	"input_ThirdPartyReference" => 1234567,
];
$mensagem = json_encode($mensagem);
$tamanhoDaMensagem = strlen($mensagem);



// CONFIGURANDO OS CABECALHOS
$headers = [
	"Content-Lenght: $tamanhoDaMensagem",
	"Content-Type: application/json",
	"Origin: *",
	"Authorization: Bearer $bearerToken",
];




// INICIANDO O CURL COM O PARAMETRO DA URL
$curl = curl_init($url);

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

// ALTERENDO O METODO PADRAO GET PARA POST e ALTERANDO AOUTAS CONFIGURACAOES
curl_setopt_array($curl, [

	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POSTFIELDS => $mensagem

]);



// CONTROLANDO O RETORNO
$resposta_do_servidor = curl_exec($curl);
$resposta_do_servidor = json_decode($resposta_do_servidor, true);




//// TRATAMENTO DA RESPOSTA
//	SE A RESPOSTA FOR POSITIVA
if ($resposta_do_servidor['output_ResponseDesc'] == 'Request processed successfully') {




	//	SE A RESPOSTA FOR NEGATIVA
} else {

	
}
