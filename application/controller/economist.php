<?php
if(!isset($_SESSION['username'])){ header('Location:'.URL); return; };
if($_SESSION['role']!='economist') { header('Location:'.URL); return; };
/**
 * //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit(); debug sql
 */
class economist extends Controller
{


    public function index(){ 
        header('Location:'.URL.$_SESSION['role'].'/contracts');
    }

    function contracts(){   
        if (isset($_GET['export'])){
            if ($_GET['export']==true) {
                $this->model->getContracts('export');
                return;
            }
        }
        $operators=$this->model->getUsersByRole('operator');
        $supervisors=$this->model->getUsersByRole('supervisor');
        $output=$this->model->getContracts();
        $contracts=$output[1];
        $pages=ceil($output[0]/100);
        $cnt_nr=$output[2];
        $campaigns=$this->model->getCampaigns();
        $statuses=$this->model->getStatuses();
        require APP . 'view/economist/header.php';
        require APP . 'view/economist/contracts.php';
        require APP . 'view/economist/footer.php';
    }
    
    // public function createContract(){ 
    //     if(isset($_POST['create_contract'])){
    //         $this->model->createContract();
    //         return;
    //     }
    //     $operators   =  $this->model->getUsersByRole('operator');
    //     $supervisors   =  $this->model->getUsersByRole('supervisor');
    //     $campaigns=$this->model->getCampaigns();
    //     require APP . 'view/economist/header.php';
    //     require APP . 'view/economist/createContract.php';
    //     require APP . 'view/economist/footer.php';
    // }

    // public function editContract($contract_id){ 
    //     if(isset($_POST['edit_contract'])){
    //         $this->model->editContract($contract_id);
    //         return;
    //     }
    //     $operators   =  $this->model->getUsersByRole('operator');
    //     $supervisors =  $this->model->getUsersByRole('supervisor');
    //     $contract    =  $this->model->getContractById($contract_id);
    //     $statuses=$this->model->getStatuses();
    //     $campaigns=$this->model->getCampaigns();
    //     require APP . 'view/economist/header.php';
    //     require APP . 'view/economist/editContract.php';
    //     require APP . 'view/economist/footer.php';
    // }

    public function viewContract($contract_id){ 
        $operators   =  $this->model->getUsersByRole('operator');
        $supervisors =  $this->model->getUsersByRole('supervisor');
        $contract    =  $this->model->getContractById($contract_id);
        $statuses=$this->model->getStatuses();
        $campaigns=$this->model->getCampaigns();
        require APP . 'view/economist/header.php';
        require APP . 'view/economist/viewContract.php';
        require APP . 'view/economist/footer.php';
    }

    // //////////-documents-//////////////
    // public function uploadDocuments(){ 
    //     $this->model->uploadDocuments();
    // }
    // public function getDocuments($contract_id){ 
    //     $this->model->getDocuments($contract_id);
    // }
    // public function getDocument($document_id){ 
    //     $this->model->getDocument($document_id);
    // }
    // /////////////////////////////////

    // //////////-audio-//////////////
    // public function uploadAudios(){ 
    //     $this->model->uploadAudios();
    // }
    // public function getAudios($contract_id){ 
    //     $this->model->getAudios($contract_id);
    // }
    // public function getAudio($audio_id){ 
    //     $this->model->getAudio($audio_id);
    // }
    // /////////////////////////////////

    public function users($showHours=false,$date=null){
        if ($showHours=='workhours') {
            $users=$this->model->getUsers();
            require APP . 'view/economist/header.php';
            require APP . 'view/economist/workhours.php';
            require APP . 'view/economist/footer.php';
            return;
        }elseif(!$showHours){ 
            $users=$this->model->getUsers();
            require APP . 'view/economist/header.php';
            require APP . 'view/economist/users.php';
            require APP . 'view/economist/footer.php';
        }else header('location:'.APP);
    }

    public function viewUser($user_id){ 
        $contracts=$this->model->getContractsByUser($user_id);
        require APP . 'view/economist/header.php';
        require APP . 'view/economist/viewUser.php';
        require APP . 'view/economist/footer.php';

    }
    
    // public function createUser(){ 
    //     if(isset($_POST['create_user'])){
    //         $this->model->createUser();
    //         return;
    //     }
    //     require APP . 'view/economist/header.php';
    //     require APP . 'view/economist/createUser.php';
    //     require APP . 'view/economist/footer.php';
    // }

    // public function editUser($user_id){ 
    //     if(isset($_POST['edit_user'])){
    //         $this->model->editUser($user_id);
    //         return;
    //     }
    //     if (isset($_GET['deleteUser'])) {
    //          $this->model->deleteUser($user_id);
    //         return;
    //     }
    //     $user=$this->model->getUser($user_id);
    //     $supervisors   =  $this->model->getUsersByRole('supervisor');
    //     require APP . 'view/economist/header.php';
    //     if(!isset($user->user_id)){
    //         echo "No user found!";
    //     } else {
    //         require APP . 'view/economist/editUser.php'; 
    //     }
    //     require APP . 'view/economist/footer.php';
    // }
////////////////////////////////////////////////////////

    public function statuses(){
            $statuses=$this->model->getStatuses();
            require APP . 'view/economist/header.php';
            require APP . 'view/economist/statuses.php';
            require APP . 'view/economist/footer.php';
    }

    // public function createStatus(){ 
    //     if(isset($_POST['create_status'])){
    //         $this->model->createStatus();
    //         return;
    //     }
    //     require APP . 'view/economist/header.php';
    //     require APP . 'view/economist/createStatus.php';
    //     require APP . 'view/economist/footer.php';
    // }

    // public function editStatus($status_id){ 
    //     if ($status_id==1) {
    //         header('Location: '.URL.$_SESSION['role'].'/statuses');
    //         return;
    //     }
    //     if(isset($_POST['edit_status'])){
    //         $this->model->editStatus($status_id);
    //         return;
    //     }
    //     if (isset($_GET['deleteStatus'])) {
    //          $this->model->deleteStatus($status_id);
    //         return;
    //     }
    //     $status=$this->model->getStatus($status_id);
    //     require APP . 'view/economist/header.php';
    //     if(!isset($status->status_id)){
    //         echo "No status found!";
    //     } else {
    //         require APP . 'view/economist/editStatus.php'; 
    //     }
    //     require APP . 'view/economist/footer.php';
    // }
//////////////////////////////////////////////////////////////

    public function campaigns(){
            $campaigns=$this->model->getCampaigns();
            require APP . 'view/economist/header.php';
            require APP . 'view/economist/campaigns.php';
            require APP . 'view/economist/footer.php';
    }

    // public function createCampaign(){ 
    //     if(isset($_POST['create_campaign'])){
    //         $this->model->createCampaign();
    //         return;
    //     }
    //     require APP . 'view/economist/header.php';
    //     require APP . 'view/economist/createCampaign.php';
    //     require APP . 'view/economist/footer.php';
    // }

    // public function editCampaign($campaign_id){ 
    //     if ($campaign_id==1) {
    //         header('Location: '.URL.$_SESSION['role'].'/campaigns');
    //         return;
    //     }
    //     if(isset($_POST['edit_campaign'])){
    //         $this->model->editCampaign($campaign_id);
    //         return;
    //     }
    //     if (isset($_GET['deleteCampaign'])) {
    //          $this->model->deleteCampaign($campaign_id);
    //         return;
    //     }
    //     $campaign=$this->model->getCampaign($campaign_id);
    //     require APP . 'view/economist/header.php';
    //     if(!isset($campaign->campaign_id)){
    //         echo "No campaign found!";
    //     } else {
    //         require APP . 'view/economist/editCampaign.php'; 
    //     }
    //     require APP . 'view/economist/footer.php';
    // }
//////////////////////////////////////////////////////////////
}
