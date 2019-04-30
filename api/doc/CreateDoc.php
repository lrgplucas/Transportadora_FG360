<?php


include_once '../../controller/DocController.php'; //CONTROLLER
include_once '../../model/Doc.php'; //CONTROLLER


$doc = new Doc();


$doc->setArquivoPath($_POST["path"]);
$doc->setId_cliente($_POST["cliente"]);
$doc->setTipo($_POST["tipo"]);
$doc->setValor($_POST["valor"]);
$doc->setVencimento($_POST["vencimento"]);
$doc->setDescricao($_POST["status"]);


$result = DocController::insertDoc($doc);

if($result == 1){
    //SET O HTTP STATUS CODE PARA 201
    http_response_code(201);

    echo $result;

}else{

    //SET O HTTP STATUS CODE PARA 400
    http_response_code(500);
}



?>