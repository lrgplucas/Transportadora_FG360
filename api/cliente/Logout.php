<?php
/*
* author : joao
* data : 11/03/2019
* classe : LOGOUT
*/

try{
    session_start(); // CARREGA NA SEÇÃO OS VALORES

    session_destroy(); 

    http_response_code(200);
}catch(Exception $e){
    http_response_code(500);
}


?>