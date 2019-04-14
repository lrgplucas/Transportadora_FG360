<?php


$id = $_GET['id'];


include_once '../../controller/DocController.php'; //CONTROLLER

$results = DocController::getDocById($id);

//VALIDAÇÃO
if(count($results) > 0){

    //SET O HTTP STATUS CODE PARA 200
    http_response_code(200);

    //RETORNA O JSON
    echo json_encode($results);
  
}else{

    //SET O HTTP STATUS CODE PARA 404
    http_response_code(500);

    //RETORNA O JSON
    echo  "";
}

?>