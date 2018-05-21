<?php
if(!isset($_SESSION['username'])){ header('Location:'.URL); return; };
/**
 * //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit(); debug sql
 */
class supervisor extends Controller
{


    public function index(){ 
        header('Location:'.URL.$_SESSION['role'].'/contracts');
    }

    function contracts(){   
        $operators=$this->model->SupervisorgetUsersByRole('operator');
        $contracts=$this->model->SupervisorgetContracts();
        $statuses=$this->model->SupervisorgetStatuses();
        require APP . 'view/supervisor/header.php';
        require APP . 'view/supervisor/contracts.php';
        require APP . 'view/supervisor/footer.php';
    }
    
    public function createContract(){ 
        if(isset($_POST['create_contract'])){
            $this->model->SupervisorcreateContract();
            return;
        }
        $operators   =  $this->model->SupervisorgetUsersByRole('operator');
        //$supervisors   =  $this->model->SupervisorgetUsersByRole('supervisor');
        $campaigns=$this->model->SupervisorgetCampaigns();
        require APP . 'view/supervisor/header.php';
        require APP . 'view/supervisor/createContract.php';
        require APP . 'view/supervisor/footer.php';
    }


    public function viewContract($contract_id){ 
        
        //$supervisors =  $this->model->SupervisorgetUsersByRole('supervisor');
        $contract = $this->model->SupervisorgetContractById($contract_id);
        if (!$contract) {
           header('Location: ../');
           return;
        }
        $operators  =  $this->model->SupervisorgetUsersByRole('operator');
        $statuses=$this->model->SupervisorgetStatuses();
        $campaigns=$this->model->SupervisorgetCampaigns();
        require APP . 'view/supervisor/header.php';
        require APP . 'view/supervisor/viewContract.php';
        require APP . 'view/supervisor/footer.php';
    }

    //////////-documents-//////////////
    public function uploadDocuments(){ 
        $this->model->SupervisoruploadDocuments();
    }
    public function getDocuments($contract_id){ 
        $this->model->SupervisorgetDocuments($contract_id);
    }
    public function getDocument($document_id){ 
        $this->model->SupervisorgetDocument($document_id);
    }
    /////////////////////////////////

    //////////-audio-//////////////
    public function uploadAudios(){ 
        $this->model->SupervisoruploadAudios();
    }
    public function getAudios($contract_id){ 
        $this->model->SupervisorgetAudios($contract_id);
    }
    public function getAudio($audio_id){ 
        $this->model->SupervisorgetAudio($audio_id);
    }
    /////////////////////////////////

    public function users($showHours=false,$date=null){
        if ($showHours=='workhours') {
            $users=$this->model->SupervisorgetUsers();
            require APP . 'view/supervisor/header.php';
            require APP . 'view/supervisor/workhours.php';
            require APP . 'view/supervisor/footer.php';
            return;
        }elseif(!$showHours){ 
        $users=$this->model->SupervisorgetUsers();
            require APP . 'view/supervisor/header.php';
            require APP . 'view/supervisor/users.php';
            require APP . 'view/supervisor/footer.php';
        }else header('location:'.APP);
    }

    public function viewUser($user_id){ 
        $contracts=$this->model->SupervisorgetContractsByUser($user_id);
        require APP . 'view/supervisor/header.php';
        require APP . 'view/supervisor/viewUser.php';
        require APP . 'view/supervisor/footer.php';

    }

////////////////////////////////////////////////////////

}
