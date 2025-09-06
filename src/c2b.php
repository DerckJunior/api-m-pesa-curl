<?php

namespace DerckJunior\mpesa;
require_once('Tokenizer.php');

// ------------------------------------------

// RECEBENDO OS PARAMETROS
$numero = '258' . $_POST['numero'];
$valor = $_POST['valor'];



// DADOS DA API
$url = 'https://api.sandbox.vm.co.mz:18352/ipg/v1x/c2bPayment/singleStage/';

$API_KEY = 's598lksiqpibh2ty5wsty8vlj5xvddqy';
$PUBLIC_KEY = 'MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAmptSWqV7cGUUJJhUBxsMLonux24u+FoTlrb+4Kgc6092JIszmI1QUoMohaDDXSVueXx6IXwYGsjjWY32HGXj1iQhkALXfObJ4DqXn5h6E8y5/xQYNAyd5bpN5Z8r892B6toGzZQVB7qtebH4apDjmvTi5FGZVjVYxalyyQkj4uQbbRQjgCkubSi45Xl4CGtLqZztsKssWz3mcKncgTnq3DHGYYEYiKq0xIj100LGbnvNz20Sgqmw/cH+Bua4GJsWYLEqf/h/yiMgiBbxFxsnwZl0im5vXDlwKPw+QnO2fscDhxZFAwV06bgG0oEoWm9FnjMsfvwm0rUNYFlZ+TOtCEhmhtFp+Tsx9jPCuOd5h2emGdSKD8A6jtwhNa7oQ8RtLEEqwAn44orENa1ibOkxMiiiFpmmJkwgZPOG/zMCjXIrrhDWTDUOZaPx/lEQoInJoE2i43VN/HTGCCw8dKQAwg0jsEXau5ixD0GUothqvuX3B9taoeoFAIvUPEq35YulprMM7ThdKodSHvhnwKG82dCsodRwY428kg2xM/UjiTENog4B6zzZfPhMxFlOSFX4MnrqkAS+8Jamhy1GgoHkEMrsT5+/ofjCx0HjKbT5NuA2V/lmzgJLl3jIERadLzuTYnKGWxVJcGLkWXlEPYLbiaKzbJb2sYxt+Kt5OxQqC1MCAwEAAQ==';

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
