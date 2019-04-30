<?php




$id = $_GET['id'];


include_once '../../controller/DocController.php'; //CONTROLLER

$results = DocController::deleteDocById($id);


if($results == 1){
    //SET O HTTP STATUS CODE PARA 200
    http_response_code(200);
    echo $results;
}else{
     //SET O HTTP STATUS CODE PARA 200
     http_response_code(500);
     echo $results;
}



?>