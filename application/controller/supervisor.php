<?php
if(!isset($_SESSION['username'])){ header('Location:'.URL); return; };
if($_SESSION['role']!='supervisor') { header('Location:'.URL); return; };
/**
 * //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit(); debug sql
 */
class supervisor extends Controller
{


    public function index(){ 
        header('Location:'.URL.$_SESSION['role'].'/contracts');
    }

    function contracts(){   
        $operators=$this->model->getUsersByRole('operator');
        $contracts=$this->model->getContracts();
        $statuses=$this->model->getStatuses();
        require APP . 'view/supervisor/header.php';
        require APP . 'view/supervisor/contracts.php';
        require APP . 'view/supervisor/footer.php';
    }
    
    public function createContract(){ 
        if(isset($_POST['create_contract'])){
            $this->model->createContract();
            return;
        }
        $operators   =  $this->model->getUsersByRole('operator');
        //$supervisors   =  $this->model->getUsersByRole('supervisor');
        $campaigns=$this->model->getCampaigns();
        require APP . 'view/supervisor/header.php';
        require APP . 'view/supervisor/createContract.php';
        require APP . 'view/supervisor/footer.php';
    }


    public function viewContract($contract_id){ 
        
        //$supervisors =  $this->model->getUsersByRole('supervisor');
        $contract = $this->model->getContractById($contract_id);
        if (!$contract) {
           header('Location: ../');
           return;
        }
        $operators  =  $this->model->getUsersByRole('operator');
        $statuses=$this->model->getStatuses();
        $campaigns=$this->model->getCampaigns();
        require APP . 'view/supervisor/header.php';
        require APP . 'view/supervisor/viewContract.php';
        require APP . 'view/supervisor/footer.php';
    }

    //////////-documents-//////////////
    public function uploadDocuments(){ 
        $this->model->uploadDocuments();
    }
    public function getDocuments($contract_id){ 
        $this->model->getDocuments($contract_id);
    }
    public function getDocument($document_id){ 
        $this->model->getDocument($document_id);
    }
    /////////////////////////////////

    //////////-audio-//////////////
    public function uploadAudios(){ 
        $this->model->uploadAudios();
    }
    public function getAudios($contract_id){ 
        $this->model->getAudios($contract_id);
    }
    public function getAudio($audio_id){ 
        $this->model->getAudio($audio_id);
    }
    /////////////////////////////////

    public function users($showHours=false,$date=null){
        if ($showHours=='workhours') {
            $users=$this->model->getUsers();
            require APP . 'view/supervisor/header.php';
            require APP . 'view/supervisor/workhours.php';
            require APP . 'view/supervisor/footer.php';
            return;
        }elseif(!$showHours){ 
        $users=$this->model->getUsers();
            require APP . 'view/supervisor/header.php';
            require APP . 'view/supervisor/users.php';
            require APP . 'view/supervisor/footer.php';
        }else header('location:'.APP);
    }

    public function viewUser($user_id){ 
        $contracts=$this->model->getContractsByUser($user_id);
        require APP . 'view/supervisor/header.php';
        require APP . 'view/supervisor/viewUser.php';
        require APP . 'view/supervisor/footer.php';

    }

////////////////////////////////////////////////////////

}
