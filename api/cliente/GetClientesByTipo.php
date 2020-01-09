<?php
/*
* author : joao
* data : 23/03/2019
* classe : GET CLIENTE BY ID API 
*/



include_once '../../controller/ClienteController.php'; //CONTROLLER

$tipo = $_GET["tipo"];

if($tipo == "fisica"){
    $returnedCliente = ClienteController::getClientesPessoaFisica();
}else{ 
    $returnedCliente = ClienteController::getClientesPessoaJuridica();
}

if(count($returnedCliente) == 0){
    http_response_code(500);

}else{
    http_response_code(200);

    echo json_encode($returnedCliente);
}


?>
