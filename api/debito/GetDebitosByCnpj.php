<?php
/*
* author : joao
* data : 12/03/2019
* classe : GET DEBITOS CNPJ
*/

session_start(); // starts session

include_once '../../controller/DebitoController.php'; //CONTROLLER

//ESSA API NÃO PRECISA DE NENHUM INPUT DE DADOS ELA SÓ RETORNA OS DADOS DO CLIENTE NA SEÇÃO
//O RETORNO SEMPRE SERA 200
//FIX ME DESEMPENHO 

$cnpj = $_SESSION['cnpj'];

$returnedDebitos = DebitoController::getAllDebitosByCnpj($cnpj);

if(count($returnedDebitos)>0){
    http_response_code(200);

    echo json_encode($returnedDebitos);
}else{
    http_response_code(204);
}


?>