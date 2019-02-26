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



//POST DATA
$data = json_decode(file_get_contents("php://input"));


if(!empty($data->nome_cli)){
    $result = EntregaController::postEntrega($data);

    if($result == true){
        //SET O HTTP STATUS CODE PARA 201
        http_response_code(201);

    }else{

        //SET O HTTP STATUS CODE PARA 400
        http_response_code(500);

        //RETORNA O JSON
        echo  "";
    }


}else{
  
  //SET O HTTP STATUS CODE PARA 400
  http_response_code(400);

  //RETORNA O JSON
  echo  "";
}


?>