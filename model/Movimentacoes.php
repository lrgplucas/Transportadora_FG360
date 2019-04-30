<?php

/*
* author : joao
* data : 16/03/2019
* classe : Entrega
*/



class Movimentacoes {


    //ATRIBUTOS

    public $id;
    public $entrega;
    public $data;
    public $data_create;
    public $status;
    public $motorista;
    public $veiculo;


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
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

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
     * Get the value of motorista
     */ 
    public function getMotorista()
    {
        return $this->motorista;
    }

    /**
     * Set the value of motorista
     *
     * @return  self
     */ 
    public function setMotorista($motorista)
    {
        $this->motorista = $motorista;

        return $this;
    }

    /**
     * Get the value of veiculo
     */ 
    public function getVeiculo()
    {
        return $this->veiculo;
    }

    /**
     * Set the value of veiculo
     *
     * @return  self
     */ 
    public function setVeiculo($veiculo)
    {
        $this->veiculo = $veiculo;

        return $this;
    }
}




?>