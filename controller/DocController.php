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
        $result = $conn->query("SELECT * FROM doc WHERE cli_id=".$id.";");
        
        //FIX PARA PROTEGER A CONSULTA RESPONSAVEL PELA AUTENTICACAO
        try{
            return self::parseResults($result);
            
        }catch(Exception $e){
            return false;
        }

    }

    public static function getDocById($id){

      $generatorConn = new Connection();

      //INSTANCIA DA CONEXAO
      $conn = $generatorConn->getConection();

      //QUERY

      //FIX ME : E NESCESSARIO FAZER O BINDING PELO PDO OU QUALQUER COISA QUE FAÇA O ESCAPE
      $result = $conn->query("SELECT * FROM doc WHERE id=".$id.";");
      
      //FIX PARA PROTEGER A CONSULTA RESPONSAVEL PELA AUTENTICACAO
      try{
          return self::parseResults($result);
          
      }catch(Exception $e){
          return false;
      }

  }

  public static function getDocByClienteAndId($id,$tipo){

    $generatorConn = new Connection();

    //INSTANCIA DA CONEXAO
    $conn = $generatorConn->getConection();

    //QUERY

    $result = $conn->query("SELECT * FROM doc WHERE cli_id=".$id." AND tipo='$tipo' ;");

    $result->execute();
    
    //FIX PARA PROTEGER A CONSULTA RESPONSAVEL PELA AUTENTICACAO
    try{
        return self::parseResults($result);
        
    }catch(Exception $e){
        return false;
    }

}

  public static function deleteDocById($id){

    $generatorConn = new Connection();

    //INSTANCIA DA CONEXAO
    $conn = $generatorConn->getConection();

    //QUERY

    //FIX ME : E NESCESSARIO FAZER O BINDING PELO PDO OU QUALQUER COISA QUE FAÇA O ESCAPE
    $result = $conn->query("DELETE FROM doc WHERE id=".$id.";");
    
    return $result->rowCount();

}



    public static function insertDoc ($doc)
    { 

  
      $generatorConn = new Connection();
  
      //INSTANCIA DA CONEXAO
      $conn = $generatorConn->getConection();

      $data_upload = date('Y-m-d');
      $arquivo_path  = $doc->getArquivoPath() ;
      $tipo = $doc->getTipo();
      $cli_id = $doc->getId_cliente();
      $status = $doc->getDescricao();
      $valor = $doc->getValor();
      $vencimento = $doc->getVencimento();

      $insert = $conn->prepare("INSERT INTO `doc` ( `data_upload`, `arquivo_path`, `tipo`, `descricao`, `cli_id`, `vencimento`, `status`, `valor`)  VALUES ".
                                    "  (:data_upload , :arquivo_path , :descricao , :tipo , :cli_id , :vencimento , :status , :valor);");

      $insert->bindParam(":data_upload", $data_upload);
      $insert->bindParam(":arquivo_path", $arquivo_path );
      $insert->bindParam(":tipo",  $tipo );
      $insert->bindParam(":cli_id", $cli_id);
      $insert->bindParam(":vencimento", $vencimento);
      $insert->bindParam(":status", $status);
      $insert->bindParam(":valor", $valor);
      $insert->bindParam(":descricao", $tipo);


  
      $insert->execute();
  
      return $insert->rowCount();
  
    }

    public static function parseResults($resulSet)
    {
        
      //FIX FAZER RETORNAR UM ARRAY PARA MELHORAR O JSON
      $docs = array();
  
      foreach ($resulSet as $item) {
  
        $newDoc = new Doc();
  
        $newDoc->setId($item['id']);
        $newDoc->setDataUpload($item['data_upload']);
        $newDoc->setArquivoPath($item['arquivo_path']);
        $newDoc->setTipo($item['tipo']);
        $newDoc->setDescricao($item['descricao']);
        $newDoc->setId_cliente($item['cli_id']);
        $newDoc->setVencimento($item['vencimento']);
        $newDoc->setValor($item['valor']);
        $newDoc->setStatus($item['status']);
        
        array_push($docs,$newDoc);
      }
  
      return $docs;
    }


}
?>