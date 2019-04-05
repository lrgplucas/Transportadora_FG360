<?php
/*
* author : joao
* data : 23/03/2019
* classe : GET CLIENTE BY ID API 
*/



include_once '../../controller/ClienteController.php'; //CONTROLLER



$returnedCliente = ClienteController::getClientes();

http_response_code(200);

echo json_encode($returnedCliente);

?>
