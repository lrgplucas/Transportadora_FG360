<?php


include_once '../../controller/EntregaController.php'; //CONTROLLER

//COD DA URL
$id = $_GET['cli_id'];

$entregas = EntregaController::getAllByCliente($id); 

//VALIDAÇÃO
if(count($entregas) > 0){

    //SET O HTTP STATUS CODE PARA 200
    http_response_code(200);
  
    //RETORNA O JSON
    echo json_encode($entregas);
  
  }else{
  
    //SET O HTTP STATUS CODE PARA 204
    http_response_code(500);
  
    //RETORNA O JSON
    echo  "";
  }

?>