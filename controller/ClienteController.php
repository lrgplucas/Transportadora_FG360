<?php

use PHPMailer\PHPMailer\Exception;
 /*
* author : joao
* data : 01/03/2019
* classe : Cliente Controller
*/

include_once '../../helper/Connection.php'; // CONEXAO COM BD
include_once '../../model/Cliente.php'; //MODEL

class ClienteController{


    //METODO PARA FAZER A AUTENTICAÇÃO
    public static function authCliente($cnpj , $senha){

        $generatorConn = new Connection();

        //INSTANCIA DA CONEXAO
        $conn = $generatorConn->getConection();

        //QUERY

        //FIX ME : E NESCESSARIO FAZER O BINDING PELO PDO OU QUALQUER COISA QUE FAÇA O ESCAPE
        $result = $conn->query("SELECT id FROM cliente WHERE cnpj='".$cnpj."'  AND senha='".$senha."'");
        
        //FIX PARA PROTEGER A CONSULTA RESPONSAVEL PELA AUTENTICACAO
        try{
            $count = $result->rowCount();
            if( $count >0){
                return true;
            }else{
                return false;
            }   
        }catch(Exception $e){
            return false;
        }
    }

    //FIX ME : NOME DO METODO
    //METODO PARA TRAZER OS DADOS DO CLIENTE 
    public static function getClienteByEmail($cnpj){
        $generatorConn = new Connection();

        //INSTANCIA DA CONEXAO
        $conn = $generatorConn->getConection();

        //QUERY

        //FIX ME : E NESCESSARIO FAZER O BINDING PELO PDO OU QUALQUER COISA QUE FAÇA O ESCAPE
        $result = $conn->query("SELECT * FROM cliente WHERE cnpj='".$cnpj."'");
        
        //FIX PARA PROTEGER A CONSULTA RESPONSAVEL PELA AUTENTICACAO
        try{
            $count = $result->rowCount();
            if( $count >0){
                return self::parseCliente($result)[0];
            }else{
                return null;
            }   
        }catch(Exception $e){
            return null;
        }
    }





    //PARSE CLIENTE
    public static function parseCliente($resultSet){

        $arrayClientes =  array();

        foreach ($resultSet as $item) {

             //NOVO CLIENTE
             $newCliente = new Cliente ();

             $newCliente->setId($item['id']);
             $newCliente->setNome($item['nome']);
             $newCliente->setEmail($item['email']);
             $newCliente->setCnpj($item['cnpj']);
             $newCliente->setCpf($item['cpf']);

             array_push($arrayClientes,$newCliente);
        }

        return $arrayClientes;
    }



}


?>