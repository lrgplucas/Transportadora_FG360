<?php
/*
* author : joao
* data : 28/04/2019
* classe : DELETE CLIENTE
*/



include_once '../../controller/ClienteController.php'; //CONTROLLER

$id = $_GET['id'];


$results = ClienteController::deleteCliente($id);


if($results == 1){
    //SET O HTTP STATUS CODE PARA 200
    http_response_code(200);
    echo $results;
}else{
     //SET O HTTP STATUS CODE PARA 200
     http_response_code(500);
     echo $results;
}

?>
