<?php
if(!isset($_SESSION['username'])){ header('Location:'.URL); return; };
/**
 * //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit(); debug sql
 */
class api extends Controller
{


    public function index()
    { 

        echo "api v1";

    }
    
    public function ApigetUsersBySupervisor($supervisor){
        $sql="SELECT CONCAT_WS(' ',first_name,last_name) AS full_name,user_id FROM users where role='operator' AND supervisor = :supervisor";
        $query=$this->db->prepare($sql);
        $query->execute(array(':supervisor' =>$supervisor));
        echo json_encode($query->fetchAll());
    }



}
