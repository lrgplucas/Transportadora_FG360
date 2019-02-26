<?php

/*
* author : joao
* data : 20/02/2019
* classe : Connection
*/

class Connection {

    function __construct() {
        
    }


  //FIX:ME NEED A WAY TO DIFF DEVELOP ENVIROMENT AND PRODUCTION ENVIROMENT
  private $user = "root";
  private $pass = "";
  private $host = "localhost";
  private $bd = "transportadora";

  public function getConection(){
       try {
           $dbh = new PDO('mysql:host='.$this->host.';dbname='.$this->bd, $this->user, $this->pass);
           return $dbh;

       } catch (PDOException $e) {
           print "Error!: " . $e->getMessage() . "<br/>";
           die();
           return null;
       }



   }

}



 ?>
