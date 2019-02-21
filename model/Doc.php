<?php

/*
* author : joao
* data : 20/02/2019
* classe : Entrega
*/

class Doc {

  //ATRIBUTOS
  public $id;
  public $dataUpload;
  public $arquivoPath;
  public $entrega;
  public $tipo;
  public $descricao;


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

}



 ?>
