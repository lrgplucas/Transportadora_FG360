<?php
/*
* author : joao
* data : 01/03/2019
* classe : GET CLIENTE BY MAIL API 
*/

session_start(); // starts session

include_once '../../controller/ClienteController.php'; //CONTROLLER

//ESSA API NÃO PRECISA DE NENHUM INPUT DE DADOS ELA SÓ RETORNA OS DADOS DO CLIENTE NA SEÇÃO
//O RETORNO SEMPRE SERA 200
//FIX ME DESEMPENHO 

$emailInSession = $_SESSION['cnpj'];

$returnedCliente = ClienteController::getClienteByEmail($emailInSession);

http_response_code(200);

//SET O ID NA SESSÃO
$id = $returnedCliente->getId();
$_SESSION['id_cli'] = $id;

echo json_encode($returnedCliente);

?>