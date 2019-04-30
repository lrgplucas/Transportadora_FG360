<?php
/*
* author : joao
* data : 11/03/2019
* classe : check
*/

try{
    session_start(); // CARREGA NA SEÇÃO OS VALORES

    if(isset($_SESSION['value'])){
        http_response_code(200);
    }else{
        http_response_code(401);
    }

}catch(Exception $e){
    http_response_code(401);
}


?>