<?php

use PHPMailer\PHPMailer\Exception;
 /*
* author : joao
* data : 12/03/2019
* classe : Debito Controller
*/

include_once '../../helper/Connection.php'; // CONEXAO COM BD
include_once '../../model/Debito.php'; //MODEL

class DebitoController{

    
    public static function getAllDebitosByCnpj($cnpj){
        
        $generatorConn = new Connection();

        //INSTANCIA DA CONEXAO
        $conn = $generatorConn->getConection();

        //QUERY

        //FIX ME : E NESCESSARIO FAZER O BINDING PELO PDO OU QUALQUER COISA QUE FAÇA O ESCAPE
        $result = $conn->query("SELECT * FROM debito WHERE cnpj='".$cnpj."'");
        
        //FIX PARA PROTEGER A CONSULTA RESPONSAVEL PELA AUTENTICACAO
        try{
            $count = $result->rowCount();
            if( $count >0){
                return self::parseDebito($result);
            }else{
                return false;
            }   
        }catch(Exception $e){
            return false;
        }
    }


    public static function parseDebito($resultSet){

        $arrayDebitos=  array();

        foreach ($resultSet as $item) {

            $newDebito = new Debito();

            $newDebito->setId($item["id"]);
            $newDebito->setValor($item["valor"]);
            $newDebito->setFatura($item["fatura_path"]);
            $newDebito->setCte($item["cte_path"]);
            $newDebito->setBoleto($item["boleto_path"]);
            $newDebito->setData_create($item["data_create"]);
            $newDebito->setDate_vencimento($item["data_vencimento"]);
            $newDebito->setEntrega($item["id_entrega"]);
            $newDebito->setCnpj($item["cnpj"]);

            array_push($arrayDebitos,$newDebito);

        }

        return $arrayDebitos;

    }


}


?>