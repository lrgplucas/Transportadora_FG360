<?php
/*
* author : joao
* data : 21/02/2019
* classe : Entrega API GET ALL
*/


include_once '../../controller/EntregaController.php'; //CONTROLLER

$entregas = EntregaController::getAllEntregas();

//VALIDAÇÃO
if(count($entregas) > 0){

  //SET O HTTP STATUS CODE PARA 200
  http_response_code(200);

  //RETORNA O JSON
  echo json_encode($entregas);

}else{

  //SET O HTTP STATUS CODE PARA 404
  http_response_code(204);

  //RETORNA O JSON
  echo  "";
}

?>
