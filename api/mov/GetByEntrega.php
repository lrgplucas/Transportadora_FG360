<?php
/*
* author : joao
* data : 24/03/2019
* classe : GET MOVIMENTAÇÃO BY ENTREGA
*/

session_start(); // starts session

include_once '../../controller/MovController.php'; //CONTROLLER

$id = $_GET['id'];

$returnedMovs = MovController::getMovsByEntrega($id);

http_response_code(200);

echo json_encode($returnedMovs);

?>