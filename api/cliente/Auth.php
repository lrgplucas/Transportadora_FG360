<?php
/*
* author : joao
* data : 01/03/2019
* classe : Auth API 
*/

session_start(); // starts session

include_once '../../controller/ClienteController.php'; //CONTROLLER

//POST DATA
$data = json_decode(file_get_contents("php://input"));


if(!isset($data->email) || !isset($data->senha) ){
    http_response_code(403);
}
//DADOS
$email = $data->email;
$senha = $data->senha;

$login = ClienteController::authCliente($email,$senha);


//HTTP 

if($login == true){

    //SET O HTTP STATUS CODE PARA 401
    http_response_code(401);

    //SETA O EMAIL SEESÃO
    $_SESSION['email'] = $email;

}else {
    //SET O HTTP STATUS CODE PARA 403
    http_response_code(403);

}


?>