<?php 

include_once '../../controller/MovController.php'; //CONTROLLER
include_once '../../model/Movimentacoes.php'; //MODEL

$mov = new Movimentacoes();

$mov->setData($_POST['previsao']);
$mov->setEntrega($_POST["codRastreio"]);
$mov->setStatus($_POST["status"]);
$mov->setData_create(date("Y-m-d"));
$mov->setMotorista($_POST['motorista']);
$mov->setVeiculo($_POST['veiculo']);

$result = MovController::InsertMov($mov);

if($result == 1){
    //SET O HTTP STATUS CODE PARA 201
    http_response_code(201);

    echo $result;

}else{

    //SET O HTTP STATUS CODE PARA 400
    http_response_code(500);
}


?>