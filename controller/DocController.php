<?php
/*
* author : joao
* data : 01/03/2019
* classe : Cliente Controller
*/

include_once '../../helper/Connection.php'; // CONEXAO COM BD
include_once '../../model/Doc.php'; //MODEL

class DocController{

    public static function getDocByCliente($id){

        $generatorConn = new Connection();

        //INSTANCIA DA CONEXAO
        $conn = $generatorConn->getConection();

        //QUERY

        //FIX ME : E NESCESSARIO FAZER O BINDING PELO PDO OU QUALQUER COISA QUE FAÇA O ESCAPE
        $result = $conn->query("SELECT * FROM doc WHERE cli_id='".$id."'");
        
        //FIX PARA PROTEGER A CONSULTA RESPONSAVEL PELA AUTENTICACAO
        try{
            return self::parseResults($result);
            
        }catch(Exception $e){
            return false;
        }

    }


    public static function parseResults($resulSet)
    {
        
      //FIX FAZER RETORNAR UM ARRAY PARA MELHORAR O JSON
      $docs = new ArrayObject();
  
      foreach ($resulSet as $item) {
  
        $newDoc = new Doc();
  
        $newDoc->setId($item['id']);
        $newDoc->setDataUpload($item['data_upload']);
        $newDoc->setArquivoPath($item['arquivo_path']);
        $newDoc->setEntrega($item['entrega']);
        $newDoc->setTipo($item['tipo']);
        $newDoc->setDescricao($item['descricao']);
        $newDoc->setId_cliente($item['cli_id']);

  
        $docs->append($newDoc);
      }
  
      return $docs;
    }


}
?>