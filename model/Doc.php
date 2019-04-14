<?php

/*
* author : joao
* data : 20/02/2019
* classe : Doc
*/

class Doc {

  //ATRIBUTOS
  public $id;
  public $dataUpload;
  public $arquivoPath;
  public $entrega;
  public $tipo;
  public $descricao;
  public $id_cliente;
  public $valor;
  public $vencimento;
  public $status;


  //METODOS
    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Data Upload
     *
     * @return mixed
     */
    public function getDataUpload()
    {
        return $this->dataUpload;
    }

    /**
     * Set the value of Data Upload
     *
     * @param mixed dataUpload
     *
     * @return self
     */
    public function setDataUpload($dataUpload)
    {
        $this->dataUpload = $dataUpload;

        return $this;
    }

    /**
     * Get the value of Arquivo Path
     *
     * @return mixed
     */
    public function getArquivoPath()
    {
        return $this->arquivoPath;
    }

    /**
     * Set the value of Arquivo Path
     *
     * @param mixed arquivoPath
     *
     * @return self
     */
    public function setArquivoPath($arquivoPath)
    {
        $this->arquivoPath = $arquivoPath;

        return $this;
    }

    /**
     * Get the value of Entrega
     *
     * @return mixed
     */
    public function getEntrega()
    {
        return $this->entrega;
    }

    /**
     * Set the value of Entrega
     *
     * @param mixed entrega
     *
     * @return self
     */
    public function setEntrega($entrega)
    {
        $this->entrega = $entrega;

        return $this;
    }

    /**
     * Get the value of Tipo
     *
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of Tipo
     *
     * @param mixed tipo
     *
     * @return self
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of Descricao
     *
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of Descricao
     *
     * @param mixed descricao
     *
     * @return self
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }


  /**
   * Get the value of id_cliente
   */ 
  public function getId_cliente()
  {
    return $this->id_cliente;
  }

  /**
   * Set the value of id_cliente
   *
   * @return  self
   */ 
  public function setId_cliente($id_cliente)
  {
    $this->id_cliente = $id_cliente;

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
   * Get the value of vencimento
   */ 
  public function getVencimento()
  {
    return $this->vencimento;
  }

  /**
   * Set the value of vencimento
   *
   * @return  self
   */ 
  public function setVencimento($vencimento)
  {
    $this->vencimento = $vencimento;

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
}



 ?>
