# API M-PESA
Pacote de implentacao da API do M-Pesa simplificado em PHP usando curl

## Conhecimentos necessarios
Em primeiro lugar: Voce deve saber o basico PHP
Em segundo lugar: Voce deve entender que codigo PHP foi feito para rodar no servidor

## SERVIDOR LOCAL
Quando eu digo servidor, nao estou a dizer apenas aquele servidor da internet
Voce pode usar no teu computador com os programas XAMPP ou WAMPP desde que voce tenha o APACHE ligado
e coloque o teu projecto na pasta certa do aplicativo correspondente. Ex: htdocs

## AVISO
Se voce nao estiver a entender este codigo, tenho disponivel um curso de programacao para iniciantes

FALE COMIGO USANDO OS CONTACTOS ABAIXO:
Nome:  Derck Junior 
Whatsapp: +258 878275458
E-mail: aderitocamurima@gamil.com

## Utilizacao
Para usar este pacote basta seguir o exemplo abaixo:
``` php

Envie parametros atraves de um formulario para o arquivo c2b.php
O arquivo c2b esta a espera de dois(2) parametros do tipo POST
Ex:
	index.html -------> c2b.php

// RECEBENDO OS PARAMETROS
$numero = '258' . $_POST['numero'];
$valor = $_POST['valor'];




// DADOS DA API
$url = 'https://api.sandbox.vm.co.mz:18352/ipg/v1x/c2bPayment/singleStage/';

$API_KEY = 's598lksiqpibh5dfs6vlj5xvddq';
$PUBLIC_KEY = 'MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAmptSWqV7cGUUJJhUBxsMLonux24u+FoTlrb+4Kgc6092JIszmI1QUoMohaDDXSVueXx6IXwYGsjjWY32HGXj1iQhkALXfObJ4DqXn5h6E8y5/xQYNAyd5bpN5Z8r8100LGbnvNz20Sgqmw/cH+Bua4GJsWYLEqf/h/yiMgiBbxFxsnwZl0im5vXDlwKPw+QnO2fscDhxZFAwV06bgG0oEoWm9FnjMsfvwm0rUNYFlZ+TOtCEhmhtFp+Tsx9jPCuOd5h2emGdSKD8A6jtwhNa7oQ8RtLEEqwAn44orENa1ibOkxMiiiFpmmJkwgZPOG/zMCjXIrrhDWTDUOZaPx/lEQoInJoE2i43VN/HTGCCw8dKQAwg0jsEXau5ixD0GUothqvuX3B9taoeoFAIvUPEq35YulprMM7ThdKodSHvhnwKG82dCsodRwY428kg2xM/UjiTENog4B6zzZfPhMxFlOSFX4MnrqkAS+8Jamhy1GgoHkEMrsT5+/ofjCx0HjKbT5NuA2V/lmzgJLl3jIERadLzuTYnKGWxVJcGLkWXlEPYLbiaKzbJb2sYxt+Kt5OxQqC1MCAwEAAQ==';

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
if( $resposta_do_servidor['output_ResponseDesc'] == 'Request processed successfully'){




//	SE A RESPOSTA FOR NEGATIVA
}else{








}


	
// RESPOSTAS DO SERVIDOR
// 

// 			CASO A TRANSACAO SEJA BEM SUCEDIDA
// Array ( 
//     		[output_ResponseCode] => INS-0 
//     		[output_ResponseDesc] => Request processed successfully 
//     		[output_TransactionID] => rfclukcyxdgl 
//     		[output_ConversationID] => b393732f4ae349baaacdc184d2aa9b71 
//     		[output_ThirdPartyReference] => 1234567 
// )



// 			CASO SEJA DIGITADO UM PIN ERRADO
// Array ( 
// 			[output_ResponseCode] => INS-6 
// 			[output_ResponseDesc] => Transaction Failed 
// 			[output_TransactionID] => N/A 
// 			[output_ConversationID] => 9c20e9fa943c4bf8b9f76a74f1b625e5 
// 			[output_ThirdPartyReference] => 1234567 
// )



//			CASO O TEMPO ACABE OU A PESSOA NAO COLOQUE O PIN
// Array ( 
// 			[output_ResponseCode] => INS-9 
// 			[output_ResponseDesc] => Request timeout 
// 			[output_TransactionID] => N/A 
// 			[output_ConversationID] => 05fbcfdf125b44d187fb7b360f1d50b3 
// 			[output_ThirdPartyReference] => 1234567
// )


// 			CASO A TRANSACAO SEJA DUPLICADA
// Array ( 
//     		[output_ResponseCode] => INS-10 
//     		[output_ResponseDesc] => Duplicate Transaction 
//     		[output_TransactionID] => N/A 
//     		[output_ConversationID] => 6cac1ee6bc644aaab5ca54610a16138e 
//     		[output_ThirdPartyReference] => 1234567 
// )

```


## Requisitos
Necessario PHP 7.0 ou superior
