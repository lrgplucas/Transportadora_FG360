<?php
/*
* author : joao
* data : 21/02/2019
* classe : Entrega API POST
*/

// HEADERS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../../controller/EntregaController.php'; //CONTROLLER

include_once '../../model/Entrega.php'; //CONTROLLER

//POST DATA
$data = json_decode(file_get_contents("php://input"));

$entrega = new Entrega();

$entrega->setDataCriacao(date("Y-m-d"));
$entrega->setDataPrevisao($_POST["previsao"]);
$entrega->setCodRastreio($_POST["id_rastreio"]);
$entrega->setProduto($_POST["produto"]);
$entrega->setId_cliente($_POST["cliente"]);
$entrega->setMotorista($_POST["motorista"]);
$entrega->setVeiculo($_POST["veiculo"]);
$entrega->setNf($_POST["status"]);
$entrega->setTipo_carga($_POST["tipo"]);
$entrega->setOrigem($_POST["origem"]);
$entrega->setDestino($_POST["destino"]);


$result = EntregaController::postEntrega($entrega);

if($result == 1){
    //SET O HTTP STATUS CODE PARA 201
    http_response_code(201);

    echo $result;

}else{

    //SET O HTTP STATUS CODE PARA 400
    http_response_code(500);
}




?>