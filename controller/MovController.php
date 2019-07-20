<?php
 /*
* author : joao
* data : 20/03/2019
* classe : Mov Controller
*/

include_once '../../helper/Connection.php'; // CONEXAO COM BD
include_once '../../model/Movimentacoes.php'; //MODEL

class MovController
{

    public static function getEntregaByCode($id)
    {
        $generatorConn = new Connection();

        //INSTANCIA DA CONEXAO
        $conn = $generatorConn->getConection();

        //QUERY
        $result = $conn->query("SELECT * FROM movimentacoes WHERE =$id;");
        $formatedResult = self::parseResults($result);

        $conn = null;

        return $formatedResult;
    }

    

    public static function getMovsByEntrega($id)
    {
        $generatorConn = new Connection();

        //INSTANCIA DA CONEXAO
        $conn = $generatorConn->getConection();

        //QUERY
        $result = $conn->query("SELECT * FROM movimentacoes WHERE entrega_id =$id order by id asc;");
        $formatedResult = self::parseResults($result);

        $conn = null;

        return $formatedResult;
    }

    public static function InsertMov($mov)
    {
        $generatorConn = new Connection();

        //INSTANCIA DA CONEXAO
        $conn = $generatorConn->getConection();

        $entrega = $mov->getEntrega();
        $data = $mov->getData();
        $data_criacao = $mov->getData_create();
        $status = $mov->getStatus();
        $motorista = $mov->getMotorista();
        $veiculo = $mov->getVeiculo();
        $nomeEntrega = $mov->getNomeEntrega();
        $rg = $mov->getRg();
        $docEntrega = $mov->getDoc_entrega();

        $insert = $conn->prepare("INSERT INTO `movimentacoes` (`entrega_id`, `data`, `data_criacao`, `status` , `motorista` ,`veiculo` , `nome_entrega` , `rg` , `doc_entrega`)  VALUES".
        "  (:entrega_id , :data , :data_criacao , :status ,:motorista , :veiculo , :nome_entrega , :rg , :doc_entrega);");

        $insert->bindParam(":entrega_id", $entrega );
        $insert->bindParam(":data",  $data );
        $insert->bindParam(":data_criacao", $data_criacao);
        $insert->bindParam(":status", $status);
        $insert->bindParam(":motorista", $motorista);
        $insert->bindParam(":veiculo", $veiculo);
        $insert->bindParam(":nome_entrega", $nomeEntrega);
        $insert->bindParam(":rg", $rg);
        $insert->bindParam(":doc_entrega", $docEntrega);

        $insert->execute();


        return $insert->rowCount();
    }





  public static function parseResults($resulSet)
  {

    $movs = array();

    foreach ($resulSet as $item) {

      $newMovs = new Movimentacoes();

      $newMovs->setId($item['id']);
      $newMovs->setData_create($item['data_criacao']);
      $newMovs->setData($item['data']);
      $newMovs->setStatus($item['status']);
      $newMovs->setEntrega($item['entrega_id']);
      $newMovs->setMotorista($item['motorista']);
      $newMovs->setVeiculo($item['veiculo']);
      $newMovs->setRg($item['rg']);
      $newMovs->setNomeEntrega($item['nome_entrega']);
      $newMovs->setDoc_entrega($item['doc_entrega']);

      array_push($movs,$newMovs);
    }

    return $movs;
  }







}

?>