<?php
 /*
* author : joao
* data : 21/02/2019
* classe : Entrega Controller
*/

include_once '../../helper/Connection.php'; // CONEXAO COM BD
include_once '../../model/Entrega.php'; //MODEL

class EntregaController
{

  //METODOS
  public static function getAllEntregas()
  {

    $generatorConn = new Connection();

    //INSTANCIA DA CONEXAO
    $conn = $generatorConn->getConection();

    //QUERY
    $result = $conn->query("SELECT * FROM entrega;");
    $formatedResult = self::parseResults($result);

    $conn = null;

    return $formatedResult;
  }

  public static function getEntregaById($id)
  {
    $generatorConn = new Connection();

    //INSTANCIA DA CONEXAO
    $conn = $generatorConn->getConection();

    //QUERY
    $result = $conn->query("SELECT * FROM entrega WHERE id=$id;");
    $formatedResult = self::parseResults($result);

    $conn = null;

    return $formatedResult;
  }

  public static function getAllEntregaByCpf($cpf)
  {
    $generatorConn = new Connection();

    //INSTANCIA DA CONEXAO
    $conn = $generatorConn->getConection();

    //QUERY
    $result = $conn->query("SELECT * FROM entrega WHERE doc_cli=$cpf;");
    $formatedResult = self::parseResults($result);

    $conn = null;

    return $formatedResult;
  }

  public static function getAllEntregaByCodRastreio($cod)
  {
    $generatorConn = new Connection();

    //INSTANCIA DA CONEXAO
    $conn = $generatorConn->getConection();

    //QUERY
    $result = $conn->query("SELECT * FROM entrega WHERE doc_rastreio=$cod;");
    $formatedResult = self::parseResults($result);

    $conn = null;

    return $formatedResult;
  }

  public static function postEntrega($entrega)
  { 
    $novaEntrega = self::parseResultFromRequest($entrega);

    $generatorConn = new Connection();

    //INSTANCIA DA CONEXAO
    $conn = $generatorConn->getConection();

    $dataPrevisao = $novaEntrega->getDataCriacao() ;
    $dataCriacao = $novaEntrega->getDataPrevisao();
    $emailCli = $novaEntrega->getEmailCli();
    $nomeCli = $novaEntrega->getNomeCli();
    $docCli = $novaEntrega->getDocCli();
    $nf = $novaEntrega->getNf();
    $codRastreio = $novaEntrega->getProduto();
    $produto = $novaEntrega->getCodRastreio() ;

    $insert = $conn->prepare("INSERT INTO entrega (data_criacao , data_previsao , email_cli , nome_cli , doc_cli , nf , produto , cod_rastreio) VALUES".
                                  "  (:data_criacao, :data_previsao , :email_cli , :nome_cli , :doc_cli , :nf , :produto , :cod_rastreio)");

    $insert->bindParam(":data_criacao", $dataCriacao);
    $insert->bindParam(":data_previsao", $dataPrevisao);
    $insert->bindParam(":email_cli", $emailCli);
    $insert->bindParam(":nome_cli", $nomeCli);
    $insert->bindParam(":doc_cli", $docCli);
    $insert->bindParam(":nf", $nf );
    $insert->bindParam(":produto",  $produto );
    $insert->bindParam(":doc_rastreio", $codRastreio);

    $insert->execute();

    $count = $insert->rowCount();

    if($count > 0){
      return true;
    }else{
      return false;
    }

  }

  public static function updateEntrega($entrega)
  { }

  public static function deleteEntrega($id)
  { }

  //AUXILIARY METHODS
  public static function parseResultFromRequest($item)
  {
    $newEntrega = new Entrega();

    $newEntrega->setDataCriacao($item->data_criacao);
    $newEntrega->setDataPrevisao($item->data_previsao);
    $newEntrega->setNomeCli($item->nome_cli);
    $newEntrega->setEmailCli($item->email_cli);
    $newEntrega->setDocCli($item->doc_cli);
    $newEntrega->setNf($item->nf);
    $newEntrega->setCodRastreio($item->cod_rastreio);

    return $newEntrega;
  }
  public static function parseResults($resulSet)
  {

    $entregas = array();

    foreach ($resulSet as $item) {

      $newEntrega = new Entrega();

      $newEntrega->setId($item['id']);
      $newEntrega->setDataCriacao($item['data_criacao']);
      $newEntrega->setDataPrevisao($item['data_previsao']);
      $newEntrega->setNomeCli($item['nome_cli']);
      $newEntrega->setEmailCli($item['email_cli']);
      $newEntrega->setDocCli($item['doc_cli']);
      $newEntrega->setNf($item['nf']);
      $newEntrega->setCodRastreio($item['cod_rastreio']);

      array_push($entregas,$newEntrega);
    }

    return $entregas;
  }
}

 