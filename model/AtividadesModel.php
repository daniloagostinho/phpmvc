<?php

require_once '../config/DBConnection.php';
require_once 'Atividades.php';

class AtividadeModel extends Atividades {
    
    private $table;
    
    public function __construct() {
        $this->table = "atividade"; 
    }
    /**
     * Retorna os status cadastrados no DB
     * @return array
     */
    public function getStatus(){
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try{
            $db->beginTransaction();
            $sql  = "SELECT * from status ORDER BY id asc";
            $record = $db->prepare($sql);            
            $record->execute();
            $regExists = $record->rowCount();
            if ($regExists) {
                $dataList = $record->fetchAll(PDO::FETCH_ASSOC);
                $db->commit();
                $db = null;
                return $dataList;
            } else {
                $db->commit();
                $db = null;
                return $regExists;
            }
        }catch (PDOException $exc){
            $db->rollback();
            $db = null;
            echo $exc->getMessage();
            return null;
        }   
    }
    /**
     * Retorna uma ou todas as Atividades
     * @param $atividadeId caso queira somente uma atividade
     * @return array
     */    
    public function getAtividades($atividadeId = null){
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try{
            $db->beginTransaction();

            $sql  = "SELECT ".
                $this->table . ".ID, ".
                $this->table . ".nome, ".
                $this->table . ".descricao, ".
                $this->table . ".data_inicio, ".
                $this->table . ".data_fim, ".
                $this->table . ".situacao, ".
                $this->table . ".status, ".
                "status.id, ".
                "status.status".
                " FROM  " . $this->table ;
            $sql .= " LEFT JOIN status ON  " . $this->table . ".status = status.id";

            if($atividadeId){
                $sql .= " WHERE " . $this->table . ".ID = " . $atividadeId;
            }
            
            $sql .= " ORDER BY " . $this->table . ".ID DESC";
            //var_dump($sql);
            $record = $db->prepare($sql);        
            
            $record->execute();
            $regExists = $record->rowCount();
            if ($regExists) {
                $dataList = $record->fetchAll(PDO::FETCH_ASSOC);
                $db->commit();
                $db = null; 
                return $dataList; 
            } else {
                $db->commit();
                $db = null;
                return $regExists;
            }            
        }catch (PDOException $exc){
            $db->rollback();
            $db = null;
            echo $exc->getMessage();
            return null;
        }   
    }  
    /**
     * Deleta uma atividade
     * @param unknown $atividade_id
     * @return string|NULL
     */
    public function delAtividade($atividade_id){
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try {
            $sql = "DELETE FROM " . $this->table . " WHERE ID = " . $atividade_id;
            $query = $db->prepare($sql);           
            $query->execute();
            $countDel = $query->rowCount();
            if ($countDel == 0) {
                return "No rows deleted";
            }
        }
        catch (PDOException $exc){
            $db->rollback();
            $db = null;
            echo $exc->getMessage();
            return null;
        }   
    }
    
    
    /**
     * Inclui uma atividade
     * @param unknown $data
     * @return NULL
     */
    public function insAtividade($data){
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try {            
            
            array_pop($data);
            $fieldNames = array_keys($data);
            $fieldValues = array_values($data);
            $fieldlist = implode (',',$fieldNames);
            $qs=str_repeat("?,",count($fieldNames)-1);
             
            $sth = $db->prepare("INSERT INTO ".$this->table." ($fieldlist) VALUES (${qs}?)"); 
         
            $sth->execute($fieldValues);
        }
        catch (PDOException $exc){
            $db->rollback();
            $db = null;
            echo $exc->getMessage();
            return null;
        }
    }
    /**
     * Atualiza uma atividade
     * @param  $data array com os dados do formulário
     * @param  $idAtividade id da atividade a ser atualizada
     * @return NULL
     */
    public function updateAtividade($data,$idAtividade){
        $pdo = new DBConnection();
        $db = $pdo->DBConnect();
        try {
            var_dump($data);
            //retira o action
            array_pop($data);
            //retira o action
            array_pop($data);
            //retira o id
            //array_shift($data);
            
            $query = "UPDATE ".$this->table." SET";
            $values = array();
            
            foreach ($data as $name => $value){
                $query .= ' '.$name.' = :'. $name.',';
                $values[':'.$name] = $value;
            }
            var_dump($data);
            $query = substr($query, 0 , -1).' ';
            
            
            $query .= 'WHERE '.$this->table.".ID = ".$idAtividade.";";
            var_dump($query);
            $sth = $db->prepare($query);       
            $sth->execute($values);
        }
        catch (PDOException $exc){
            $db->rollback();
            $db = null;
            echo $exc->getMessage();
            return null;
        }
        
    }
    
    
}