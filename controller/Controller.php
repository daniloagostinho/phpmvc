<?php
//header('Access-Control-Allow-Origin: *');
ini_set('display_errors', 1	); // 0 No show errors, 1

class Controller {
    function __construct(){
        //load view        
        $view = new View();
    }
}
// Atividade Controller
require_once './AtividadeController.php';

$action = filter_input(INPUT_POST, "action");
if (filter_input(INPUT_POST, "action") == NULL) {
    $action = filter_input(INPUT_GET, "action");
}
/**
 * Ações 
 */
switch ($action){
    case 'actionName': 
        echo "Aqui Actions";
        break;
    case 'list';
            try {
                $listaAtividade = new AtividadeController();
                $res = $listaAtividade->getlistAtividades();
                $this->view;
                echo $res;
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            break;
    case 'detail';
            try {
                $param = $_POST['id'];
                $listaAtividade = new AtividadeController();
                $res = $listaAtividade->getlistAtividades($param);
                echo $res;
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            break;
    case 'delete';
            try {
                $param = $_POST['id'];
                $delAtividade = new AtividadeController();
                $delAtividade->deleteAtividade($param);
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            break;            
    case 'insert';
            try {
                $data = $_POST;
                $insereAtividade = new AtividadeController();
                $insereAtividade->insereAtividade($data);                
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            break;
    case 'update';
            try {
                $data = $_POST; 
                $param = $_POST['id'];                 
                $updateAtividade = new AtividadeController();                
                $updateAtividade->updateAtividade($data,$param);
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            break;
    default:
        break;
}