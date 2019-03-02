<?php
/*
* author : joao
* data : 01/03/2019
* classe : Auth API 
*/

session_start(); // starts session

include_once '../../controller/DocController.php'; //CONTROLLER

//ESSA API NÃO PRECISA DE NENHUM INPUT DE DADOS ELA SÓ RETORNA OS DADOS DO CLIENTE NA SEÇÃO

$id = $_SESSION['id_cli'];

$results = DocController::getDocByCliente($id);

//VALIDAÇÃO
if($results->count() > 0){

    //SET O HTTP STATUS CODE PARA 200
    http_response_code(200);
  
    //RETORNA O JSON
    echo json_encode($results);
  
  }else{
  
    //SET O HTTP STATUS CODE PARA 404
    http_response_code(204);
  
    //RETORNA O JSON
    echo  "";
  }



?>