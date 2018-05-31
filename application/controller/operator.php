<?php
if(!isset($_SESSION['username'])){ header('Location:'.URL); return; };
if($_SESSION['role']!='operator') { header('Location:'.URL); return; };
/**
 * //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit(); debug sql
 */
class operator extends Controller
{


    public function index(){ 
        header('Location:'.URL.$_SESSION['role'].'/createContract');
    }

    function contracts(){   
        $contracts=$this->model->getContracts();
        $statuses=$this->model->getStatuses();
        require APP . 'view/operator/header.php';
        require APP . 'view/operator/contracts.php';
        require APP . 'view/operator/footer.php';
    }
    
    public function createContract(){ 
        if(isset($_POST['create_contract'])){
            $this->model->createContract();
            return;
        }
        //$operators   =  $this->model->getUsersByRole('operator');
        //$supervisors   =  $this->model->getUsersByRole('supervisor');
        $campaigns=$this->model->getCampaigns();
        require APP . 'view/operator/header.php';
        require APP . 'view/operator/createContract.php';
        require APP . 'view/operator/footer.php';
    }


    public function viewContract($contract_id){ 
        if (!isset($_SESSION['can_view'])) {
            header('Location:'.URL.$_SESSION['role'].'/createContract');
            echo 'You dont have permissions!';
            return;
        }
        $contract = $this->model->getContractById($contract_id);
        if (!$contract) {
           header('Location: ../');
           return;
        }

        $operators   =  $this->model->getUsersByRole('operator');
        $supervisors =  $this->model->getUsersByRole('supervisor');
        $statuses=$this->model->getStatuses();
        $campaigns=$this->model->getCampaigns();
        require APP . 'view/operator/header.php';
        require APP . 'view/operator/viewContract.php';
        require APP . 'view/operator/footer.php';
        unset($_SESSION['can_view']);
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



////////////////////////////////////////////////////////

}
