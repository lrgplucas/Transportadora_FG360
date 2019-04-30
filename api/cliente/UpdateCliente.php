<?php
/*
* author : joao
* data : 28/04/2019
* classe : UPDATE CLIENTE
*/

session_start(); // starts session

include_once '../../controller/ClienteController.php'; //CONTROLLER
include_once '../../model/Cliente.php'; //MODEL

//ATRIBUI VARIAVEIS
$id = $_POST['id'];
$cpf = $_POST['cpf'];
$cnpj = $_POST['cnpj'];
$nome = $_POST['nome'];
$tel = $_POST['telefone'];
$telComercial = $_POST['telefone'];
$razao = $_POST['razaoSocial'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$password = $_POST['senha'];



$isJuridica = $cpf == "" ? true : false;

//CRIA O NOVO USUARIO
$newCliente = new Cliente ();

if($isJuridica){
    $newCliente->setCnpj($cnpj);
    $newCliente->setNome($razao);
}else{
    $newCliente->setCpf($cpf);
    $newCliente->setNome($nome);
}

$newCliente->setId($id);
$newCliente->setTel($tel);
$newCliente->setEmail($email);
$newCliente->setSenha($password);
$newCliente->setCelular($celular);

$clienteController = new ClienteController();

$rowsAffected = $clienteController::updateCliente($newCliente,$isJuridica);


if($rowsAffected == 1){
    http_response_code(200);
}else{
    http_response_code(403);
}






















?>