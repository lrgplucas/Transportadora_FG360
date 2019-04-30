<?php
/*
* author : joao
* data : 21/02/2019
* classe : Entrega API GET BY COD RASTREIO
*/

include_once '../../controller/EntregaController.php'; //CONTROLLER

//COD DA URL
$cod = $_GET['cod'];

$entregas = EntregaController::getAllEntregaByCodRastreio($cod);

//VALIDAÇÃO
if(count($entregas) > 0){

    //SET O HTTP STATUS CODE PARA 200
    http_response_code(200);
  
    //RETORNA O JSON
    echo json_encode($entregas);
  
  }else{
  
    //SET O HTTP STATUS CODE PARA 204
    http_response_code(204);
  
    //RETORNA O JSON
    echo  "";
  }

?>