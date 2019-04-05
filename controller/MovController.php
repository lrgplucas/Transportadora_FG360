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
        $result = $conn->query("SELECT * FROM movimentacoes WHERE entrega_id =$id;");
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

        $insert = $conn->prepare("INSERT INTO `movimentacoes` (`entrega_id`, `data`, `data_criacao`, `status` , `motorista` ,`veiculo`)  VALUES".
        "  (:entrega_id , :data , :data_criacao , :status ,:motorista , :veiculo );");

        $insert->bindParam(":entrega_id", $entrega );
        $insert->bindParam(":data",  $data );
        $insert->bindParam(":data_criacao", $data_criacao);
        $insert->bindParam(":status", $status);
        $insert->bindParam(":motorista", $motorista);
        $insert->bindParam(":veiculo", $veiculo);

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
     

      array_push($movs,$newMovs);
    }

    return $movs;
  }







}

?>