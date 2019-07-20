<?php
/*
* author : joao
* data : 23/03/2019
* classe : GET CLIENTE BY ID API 
*/

session_start(); // starts session

include_once '../../controller/ClienteController.php'; //CONTROLLER

$id = $_GET['id'];

$returnedCliente = ClienteController::getClienteByFisicaId($id);

http_response_code(200);

echo json_encode($returnedCliente);

?>