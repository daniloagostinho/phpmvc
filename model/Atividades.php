<?php

class Atividades {    
    private $idatividade; 
    private $nome;
    private $descricao;
    private $data_inicio;
    private $data_fim;
    private $status;
    private $situacao;

    /*public function __construct(){        
    }*/
    
    /**
     * Get e setters
     * @param unknown $prop
     * @return unknown
     */
    public function __get($prop)
    {
        switch (strtolower($prop)){
            case 'nome':
                return $this->nome;
            case 'descricao':
                return $this->descricao;
            case 'data_inicio':
                return $this->data_inicio;
            case 'data_fim':
                return $this->data_fim;
            case 'status':
                return $this->status;
            case 'situacao':
                return $this->situacao;

        }
    }

    public function __set($prop, $value)
    {
        switch (strtolower($prop)){
            case 'nome':
                return $this->nome = $value;
            case 'descricao':
                return $this->descricao = $value;
            case 'data_inicio':
                return $this->data_inicio = $value;
            case 'data_fim':
                return $this->data_fim = $value;
            case 'status':
                return $this->status = $value;
            case 'situacao':
                return $this->situacao = $value;

        }
    }
     

}
