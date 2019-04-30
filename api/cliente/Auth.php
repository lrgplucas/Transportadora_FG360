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

$fisica = false;

//DADOS
$doc = $_POST['cnpj'];


//FIX PARA LOGIN DE PESSOA FÍSICA
if(!isset($doc)){
    $doc = $_POST['cpf'];
}

echo $doc;


$senha = $_POST['senha'];


$login = ClienteController::authCliente($doc,$senha);
//HTTP 

if($login == true){

    //SET O HTTP STATUS CODE PARA 202
    http_response_code(200);

   //FIX PARA LOGIN
   $_SESSION['doc'] = "cnpj";
   $_SESSION['value'] = $doc;

}else {

    $login = ClienteController::authClienteFisica($doc,$senha);

    

    if($login == false){
         //SET O HTTP STATUS CODE PARA 403
        http_response_code(403);
    }else{
    
        //SET O HTTP STATUS CODE PARA 202
        http_response_code(200);

        //FIX PARA LOGIN DE PESSOA FÍSICA
        $_SESSION['doc'] = "cpf";
        $_SESSION['value'] = $doc;
    }

}


?>