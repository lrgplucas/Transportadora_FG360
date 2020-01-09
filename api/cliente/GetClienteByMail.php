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

$doc = $_SESSION['doc'];
$value = $_SESSION['value'];


try{

    $returnedCliente = ClienteController::getClienteByEmail($doc,$value);

    //SET O ID NA SESSÃO
    $id = $returnedCliente->getId();
    $_SESSION['id_cli'] = $id;

    http_response_code(200);
    echo json_encode($returnedCliente);

}catch(Exception $e){

    http_response_code(500);
}

?>