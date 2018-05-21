<?php
if(!isset($_SESSION['username'])){ header('Location:'.URL); return; };
/**
 * //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit(); debug sql
 */
class operator extends Controller
{


    public function index(){ 
        header('Location:'.URL.$_SESSION['role'].'/contracts');
    }

    function contracts(){   
        $operators=$this->model->OperatorgetUsersByRole('operator');
        $contracts=$this->model->OperatorgetContracts();
        $statuses=$this->model->OperatorgetStatuses();
        require APP . 'view/operator/header.php';
        require APP . 'view/operator/contracts.php';
        require APP . 'view/operator/footer.php';
    }
    
    public function createContract(){ 
        if(isset($_POST['create_contract'])){
            $this->model->OperatorcreateContract();
            return;
        }
        $operators   =  $this->model->OperatorgetUsersByRole('operator');
        //$supervisors   =  $this->model->OperatorgetUsersByRole('supervisor');
        $campaigns=$this->model->OperatorgetCampaigns();
        require APP . 'view/operator/header.php';
        require APP . 'view/operator/createContract.php';
        require APP . 'view/operator/footer.php';
    }


    public function viewContract($contract_id){ 
        
        //$supervisors =  $this->model->OperatorgetUsersByRole('supervisor');
        $contract = $this->model->OperatorgetContractById($contract_id);
        if (!$contract) {
           header('Location: ../');
           return;
        }
        $operators  =  $this->model->OperatorgetUsersByRole('operator');
        $statuses=$this->model->OperatorgetStatuses();
        $campaigns=$this->model->OperatorgetCampaigns();
        require APP . 'view/operator/header.php';
        require APP . 'view/operator/viewContract.php';
        require APP . 'view/operator/footer.php';
    }

    //////////-documents-//////////////
    public function uploadDocuments(){ 
        $this->model->OperatoruploadDocuments();
    }
    public function getDocuments($contract_id){ 
        $this->model->OperatorgetDocuments($contract_id);
    }
    public function getDocument($document_id){ 
        $this->model->OperatorgetDocument($document_id);
    }
    /////////////////////////////////

    //////////-audio-//////////////
    public function uploadAudios(){ 
        $this->model->OperatoruploadAudios();
    }
    public function getAudios($contract_id){ 
        $this->model->OperatorgetAudios($contract_id);
    }
    public function getAudio($audio_id){ 
        $this->model->OperatorgetAudio($audio_id);
    }
    /////////////////////////////////

    public function users($showHours=false,$date=null){
        if ($showHours=='workhours') {
            $users=$this->model->OperatorgetUsers();
            require APP . 'view/operator/header.php';
            require APP . 'view/operator/workhours.php';
            require APP . 'view/operator/footer.php';
            return;
        }elseif(!$showHours){ 
        $users=$this->model->OperatorgetUsers();
            require APP . 'view/operator/header.php';
            require APP . 'view/operator/users.php';
            require APP . 'view/operator/footer.php';
        }else header('location:'.APP);
    }

    public function viewUser($user_id){ 
        $contracts=$this->model->OperatorgetContractsByUser($user_id);
        require APP . 'view/operator/header.php';
        require APP . 'view/operator/viewUser.php';
        require APP . 'view/operator/footer.php';

    }

////////////////////////////////////////////////////////

}
