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




  public static function parseResults($resulSet)
  {

    $movs = array();

    foreach ($resulSet as $item) {

      $newMovs = new Movimentacoes();

      $newMovs->setId($item['id']);
      $newMovs->setDataCriacao($item['data_criacao']);
      $newMovs->setData($item['data']);
      $newMovs->setStatus($item['status']);
      $newMovs->setEntrega($item['entrega_id']);
     

      array_push($movs,$newMovs);
    }

    return $movs;
  }







}

?>