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

  public static function getAllByCliente($id)
  {
    $generatorConn = new Connection();

    //INSTANCIA DA CONEXAO
    $conn = $generatorConn->getConection();

    //QUERY
    $result = $conn->query("SELECT * FROM entrega WHERE cli_id=$id;");
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
    $result = $conn->query("SELECT * FROM entrega WHERE cod_rastreio='$cod';");
    $formatedResult = self::parseResults($result);

    $conn = null;

    return $formatedResult;
  }

  public static function postEntrega($entrega)
  { 
    $novaEntrega = $entrega;

    $generatorConn = new Connection();

    //INSTANCIA DA CONEXAO
    $conn = $generatorConn->getConection();

    $dataPrevisao = $novaEntrega->getDataPrevisao() ;
    $dataCriacao = $novaEntrega->getDataCriacao();
    $nf = $novaEntrega->getNf();
    $codRastreio = $novaEntrega->getProduto();
    $produto = $novaEntrega->getCodRastreio() ;
    $id_cliente = $novaEntrega->getId_cliente();
    $tipo = $novaEntrega->getTipo_carga();
    $motorista =  $novaEntrega->getMotorista();
    $veiculo =$novaEntrega->getVeiculo();

    $insert = $conn->prepare("INSERT INTO entrega ( nf , produto , cod_rastreio,cli_id,tipo_carga ,data_criacao,data_previsao ,motorista ,veiculo) VALUES".
                                  "  ( :nf , :produto , :cod_rastreio , :cli_id,:tipo_carga , :data_criacao,:data_previsao ,:motorista ,:veiculo);");

    $insert->bindParam(":data_criacao", $dataCriacao);
    $insert->bindParam(":data_previsao", $dataPrevisao);
    $insert->bindParam(":nf", $nf );
    $insert->bindParam(":produto",  $produto );
    $insert->bindParam(":cod_rastreio", $codRastreio);
    $insert->bindParam(":cli_id", $id_cliente);
    $insert->bindParam(":tipo_carga", $tipo);
    $insert->bindParam(":motorista", $motorista);
    $insert->bindParam(":veiculo", $veiculo);

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

    $newEntrega->setDataCriacao($item->data);
    $newEntrega->setDataPrevisao($item->previsao);
 
    $newEntrega->setCodRastreio($item->id_rastreio);

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
      $newEntrega->setProduto($item['produto']);
      $newEntrega->setNf($item['nf']);
      $newEntrega->setId_cliente($item['cli_id']);
      $newEntrega->setCodRastreio($item['cod_rastreio']);
      $newEntrega->setMotorista($item['motorista']);
      $newEntrega->setVeiculo($item['veiculo']);
      $newEntrega->setTipo_carga($item['tipo_carga']);

      array_push($entregas,$newEntrega);
    }

    return $entregas;
  }
}

 