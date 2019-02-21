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
    public $emailCli;
    public $nomeCli;
    public $docCli;
    public $nf;
    public $produto;

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
     * Get the value of Email Cli
     *
     * @return mixed
     */
    public function getEmailCli()
    {
        return $this->emailCli;
    }

    /**
     * Set the value of Email Cli
     *
     * @param mixed emailCli
     *
     * @return self
     */
    public function setEmailCli($emailCli)
    {
        $this->emailCli = $emailCli;

        return $this;
    }

    /**
     * Get the value of Nome Cli
     *
     * @return mixed
     */
    public function getNomeCli()
    {
        return $this->nomeCli;
    }

    /**
     * Set the value of Nome Cli
     *
     * @param mixed nomeCli
     *
     * @return self
     */
    public function setNomeCli($nomeCli)
    {
        $this->nomeCli = $nomeCli;

        return $this;
    }

    /**
     * Get the value of Doc Cli
     *
     * @return mixed
     */
    public function getDocCli()
    {
        return $this->docCli;
    }

    /**
     * Set the value of Doc Cli
     *
     * @param mixed docCli
     *
     * @return self
     */
    public function setDocCli($docCli)
    {
        $this->docCli = $docCli;

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

}

?>
