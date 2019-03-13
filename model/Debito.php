<?php /*
* author : joao
* data : 12/03/2019
* classe : Debito
*/

class Debito {


    public $id ;
    public $valor ;
    public $fatura ;
    public $cte ;
    public $boleto ;
    public $data_create ;
    public $date_vencimento ;
    public $entrega ;
    public $status ;
    public $cnpj;



    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of valor
     */ 
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of valor
     *
     * @return  self
     */ 
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get the value of fatura
     */ 
    public function getFatura()
    {
        return $this->fatura;
    }

    /**
     * Set the value of fatura
     *
     * @return  self
     */ 
    public function setFatura($fatura)
    {
        $this->fatura = $fatura;

        return $this;
    }

    /**
     * Get the value of cte
     */ 
    public function getCte()
    {
        return $this->cte;
    }

    /**
     * Set the value of cte
     *
     * @return  self
     */ 
    public function setCte($cte)
    {
        $this->cte = $cte;

        return $this;
    }

    /**
     * Get the value of boleto
     */ 
    public function getBoleto()
    {
        return $this->boleto;
    }

    /**
     * Set the value of boleto
     *
     * @return  self
     */ 
    public function setBoleto($boleto)
    {
        $this->boleto = $boleto;

        return $this;
    }

    /**
     * Get the value of data_create
     */ 
    public function getData_create()
    {
        return $this->data_create;
    }

    /**
     * Set the value of data_create
     *
     * @return  self
     */ 
    public function setData_create($data_create)
    {
        $this->data_create = $data_create;

        return $this;
    }

    /**
     * Get the value of date_vencimento
     */ 
    public function getDate_vencimento()
    {
        return $this->date_vencimento;
    }

    /**
     * Set the value of date_vencimento
     *
     * @return  self
     */ 
    public function setDate_vencimento($date_vencimento)
    {
        $this->date_vencimento = $date_vencimento;

        return $this;
    }

    /**
     * Get the value of entrega
     */ 
    public function getEntrega()
    {
        return $this->entrega;
    }

    /**
     * Set the value of entrega
     *
     * @return  self
     */ 
    public function setEntrega($entrega)
    {
        $this->entrega = $entrega;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of cnpj
     */ 
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set the value of cnpj
     *
     * @return  self
     */ 
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }
}

?>