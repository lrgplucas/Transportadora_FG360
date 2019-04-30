<?php

use PHPMailer\PHPMailer\Exception;
 /*
* author : joao
* data : 01/03/2019
* classe : Cliente Controller
*/

include_once __DIR__.'/../helper/Connection.php'; // CONEXAO COM BD
include_once  __DIR__.'/../model/Cliente.php'; //MODEL

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

    //METODO PARA FAZER A AUTENTICAÇÃO
    public static function authClienteFisica($cpf , $senha){

        $generatorConn = new Connection();

        //INSTANCIA DA CONEXAO
        $conn = $generatorConn->getConection();

        //QUERY

        //FIX ME : E NESCESSARIO FAZER O BINDING PELO PDO OU QUALQUER COISA QUE FAÇA O ESCAPE
        $result = $conn->query("SELECT id FROM cliente WHERE cpf='".$cpf."'  AND senha='".$senha."'");
        
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
    public static function getClienteByEmail($doc, $value){
        $generatorConn = new Connection();

        //INSTANCIA DA CONEXAO
        $conn = $generatorConn->getConection();

        //QUERY

        //FIX ME : E NESCESSARIO FAZER O BINDING PELO PDO OU QUALQUER COISA QUE FAÇA O ESCAPE
        $result = $conn->query("SELECT * FROM cliente WHERE $doc='".$value."'");
        
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


    //FIX ME : NOME DO METODO
    //METODO PARA TRAZER OS DADOS DO CLIENTE 
    public static function getClienteById($id){
        $generatorConn = new Connection();

        //INSTANCIA DA CONEXAO
        $conn = $generatorConn->getConection();

        //QUERY

        //FIX ME : E NESCESSARIO FAZER O BINDING PELO PDO OU QUALQUER COISA QUE FAÇA O ESCAPE
        $result = $conn->query("SELECT * FROM cliente WHERE id=".$id."");
        
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

    

    public static function getClientes(){
        $generatorConn = new Connection();

        //INSTANCIA DA CONEXAO
        $conn = $generatorConn->getConection();

        //QUERY

        //FIX ME : E NESCESSARIO FAZER O BINDING PELO PDO OU QUALQUER COISA QUE FAÇA O ESCAPE
        $result = $conn->query("SELECT * FROM cliente ;");
        
        //FIX PARA PROTEGER A CONSULTA RESPONSAVEL PELA AUTENTICACAO
        try{
            $count = $result->rowCount();
            if( $count >0){
                return self::parseCliente($result);
            }else{
                return null;
            }   
        }catch(Exception $e){
            return null;
        }
    }


    //DELETE CLIENTE
    public static function deleteCliente($id){
        $generatorConn = new Connection();

        //INSTANCIA DA CONEXAO
        $conn = $generatorConn->getConection();

        try{
            $result = $conn->query("DELETE FROM cliente WHERE id=$id;");
            $count = $result->rowCount();
            return $count;
        }catch(Exception $e){
            return $e;
        }
    }


    //UPDATE
    public static function updateCliente($cliente,$isJuridica){
        $generatorConn = new Connection();

        $id = $cliente->getId();
        $nome = $cliente->getNome();
        $cpf =  $cliente->getCpf();
        $cnpj = $cliente->getCnpj();
        $tel = $cliente->getTel();
        $celular =  $cliente->getCelular();
        $email =  $cliente->getEmail();
        $senha =  $cliente->getSenha();

        //INSTANCIA DA CONEXAO
        $conn = $generatorConn->getConection();
        try{
            $insert = $conn->prepare("UPDATE cliente SET nome =  :nome , tel = :tel ,celular = :celular , cpf = :cpf, cnpj = :cnpj, email = :email , senha = :senha WHERE id = :id;");

            $insert->bindValue(":id",$id);
            $insert->bindValue(":nome",$nome);
            $insert->bindValue(":cpf",$cpf);
            $insert->bindValue(":cnpj",$cnpj);
            $insert->bindValue(":tel",$tel);
            $insert->bindValue(":celular",$celular);
            $insert->bindValue(":email",$email);
            $insert->bindValue(":senha",$senha);

            $insert->execute();
        

            return $insert->rowCount();
        }catch (PDOException $e) {
            return $e->getMessage();

        }

    }


    public static function insertCliente($cliente,$isJuridica){
        $generatorConn = new Connection();

        $nome = $cliente->getNome();
        $cpf =  $cliente->getCpf();
        $cnpj = $cliente->getCnpj();
        $tel = $cliente->getTel();
        $celular =  $cliente->getCelular();
        $email =  $cliente->getEmail();
        $senha =  $cliente->getSenha();

        //INSTANCIA DA CONEXAO
        $conn = $generatorConn->getConection();
        try{
            $insert = $conn->prepare("INSERT INTO cliente (nome , tel ,celular , cpf , cnpj , email , senha ) VALUES (".
                ":nome , :tel , :celular , :cpf , :cnpj , :email , :senha);");

            $insert->bindParam(":nome",$nome);
            $insert->bindParam(":cpf",$cpf);
            $insert->bindParam(":cnpj",$cnpj);
            $insert->bindParam(":tel",$tel);
            $insert->bindParam(":celular",$celular);
            $insert->bindParam(":email",$email);
            $insert->bindParam(":senha",$senha);

            $insert->execute();
        

            return $insert->rowCount();
        }catch (PDOException $e) {
            return $e->getMessage();

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
             $newCliente->setTel($item['tel']);
             $newCliente->setCelular($item['celular']);

             array_push($arrayClientes,$newCliente);
        }

        return $arrayClientes;
    }



}


?>