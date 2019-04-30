<?php
/*
* author : joao
* data : 20/03/2019
* classe : GET MOVIMENTAÇÃO
*/

session_start(); // starts session

include_once '../../controller/MovController.php'; //CONTROLLER

$codigo = $_GET['cod'];

$returnedMovs = MovController::getEntregaByCode($codigo);

http_response_code(200);

echo json_encode($returnedMovs);

?>