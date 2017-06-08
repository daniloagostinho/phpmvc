<?php
require_once '../config/properties.php';
require_once '../model/atividadesModel.php';

class AtividadeController{
    
    public function __construct() {   
    }
    
    /**
     * 
     * @param $atividade_id para retornar um valor
     * @return array atividades
     */    
    public function getlistAtividades($atividade_id = null){
        try { 
            $atividade = new AtividadeModel();
            $response = $atividade->getAtividades($atividade_id);
            return $response;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            return 0;
        }
            
    }
    
    /**
     *
     * @return array de status
     */
    public function getlistStatus(){
        try {
            $status = new AtividadeModel();
            $response = $status->getStatus();
            return $response;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            return 0;
        }
        
    }
    
    /**
     * Insere Atividade
     */
    public function insereAtividade($data){
        try {
            $atividade = new AtividadeModel();
            $response = $atividade->insAtividade($data);
            return $response;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            return 0;
        }
    }
    
    
    /**
     * Exclui uma atividade
     * @param $atividade_id mandatório
     */
    public function deleteAtividade($atividade_id){
        try {
            $atividade = new AtividadeModel();
            $response = $atividade->delAtividade($atividade_id);
            return $response;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            return 0;
        }
    }
    
    /**
     * Atualiza uma atividade
     * @param $data array (dados do form passados via ajax)
     * @param $atividade_id id da atividade a ser atualizada
     */
    public function updateAtividade($data,$atividade_id){
        try {
            $atividade = new AtividadeModel();
            $response = $atividade->updateAtividade($data,$atividade_id);
            return $response;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            return 0;
        }
    }
    
    /**
     * Lista de atividades para view
     * @return array
     */
    public function listToView(){
        $data = $this->getlistAtividades();
        return $data;
    }
  
    
      
    
}

