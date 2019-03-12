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


if(!isset($_POST['cnpj']) || !isset($_POST['senha']) ){
    http_response_code(403);
}
//DADOS
$cnpj = $_POST['cnpj'];
$senha = $_POST['senha'];

$login = ClienteController::authCliente($cnpj,$senha);


//HTTP 

if($login == true){

    //SET O HTTP STATUS CODE PARA 202
    http_response_code(200);

    //SETA O EMAIL SEESÃO
    $_SESSION['cnpj'] = $cnpj;

}else {
    //SET O HTTP STATUS CODE PARA 403
    http_response_code(403);

}


?>