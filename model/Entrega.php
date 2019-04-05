<?php

/*
* author : joao
* data : 20/02/2019
* classe : Entrega
*/

class Entrega {

    //ATRIBUTOS

    public $id;
    public $dataCriacao;
    public $dataPrevisao;
    public $nf;
    public $produto;
    public $codRastreio;
    public $id_cliente;
    public $motorista;
    public $veiculo;
    public $tipo_carga;



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
     * Get the value of Data Criacao
     *
     * @return mixed
     */
    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    /**
     * Set the value of Data Criacao
     *
     * @param mixed dataCriacao
     *
     * @return self
     */
    public function setDataCriacao($dataCriacao)
    {
        $this->dataCriacao = $dataCriacao;

        return $this;
    }

    /**
     * Get the value of Data Previsao
     *
     * @return mixed
     */
    public function getDataPrevisao()
    {
        return $this->dataPrevisao;
    }

    /**
     * Set the value of Data Previsao
     *
     * @param mixed dataPrevisao
     *
     * @return self
     */
    public function setDataPrevisao($dataPrevisao)
    {
        $this->dataPrevisao = $dataPrevisao;

        return $this;
    }


    /**
     * Get the value of Nf
     *
     * @return mixed
     */
    public function getNf()
    {
        return $this->nf;
    }

    /**
     * Set the value of Nf
     *
     * @param mixed nf
     *
     * @return self
     */
    public function setNf($nf)
    {
        $this->nf = $nf;

        return $this;
    }

    /**
     * Get the value of Produto
     *
     * @return mixed
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Set the value of Produto
     *
     * @param mixed produto
     *
     * @return self
     */
    public function setProduto($produto)
    {
        $this->produto = $produto;

        return $this;
    }

    /**
     * Get the value of codRastreio
     *
     * @return mixed
     */
    public function getCodRastreio()
    {
        return $this->codRastreio;
    }

    /**
     * Set the value of codRastreio
     *
     * @param mixed codRastreio
     *
     * @return self
     */
    public function setCodRastreio($codRastreio)
    {
        $this->codRastreio = $codRastreio;

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

    /**
     * Get the value of tipo_carga
     */ 
    public function getTipo_carga()
    {
        return $this->tipo_carga;
    }

    /**
     * Set the value of tipo_carga
     *
     * @return  self
     */ 
    public function setTipo_carga($tipo_carga)
    {
        $this->tipo_carga = $tipo_carga;

        return $this;
    }
}

?>
