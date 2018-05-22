<?php
if(!isset($_SESSION['username']) ){ header('Location:'.URL); return; };
if($_SESSION['role']!='backoffice') { header('Location:'.URL); return; };
/**
 * //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit(); debug sql
 */
class backoffice extends Controller
{


    public function index(){ 
        header('Location:'.URL.$_SESSION['role'].'/contracts');
    }

    function contracts(){   
        if (isset($_GET['export'])){
            if ($_GET['export']==true) {
                $this->model->BackofficegetContracts('export');
                return;
            }
        }
        $operators=$this->model->BackofficegetUsersByRole('operator');
        $contracts=$this->model->BackofficegetContracts();
        $statuses=$this->model->BackofficegetStatuses();
        require APP . 'view/backoffice/header.php';
        require APP . 'view/backoffice/contracts.php';
        require APP . 'view/backoffice/footer.php';
    }
    
    public function createContract(){ 
        if(isset($_POST['create_contract'])){
            $this->model->BackofficecreateContract();
            return;
        }
        $operators   =  $this->model->BackofficegetUsersByRole('operator');
        $supervisors   =  $this->model->BackofficegetUsersByRole('supervisor');
        $campaigns=$this->model->BackofficegetCampaigns();
        require APP . 'view/backoffice/header.php';
        require APP . 'view/backoffice/createContract.php';
        require APP . 'view/backoffice/footer.php';
    }

    public function editContract($contract_id){ 
        if(isset($_POST['edit_contract'])){
            $this->model->BackofficeeditContract($contract_id);
            return;
        }
        $operators   =  $this->model->BackofficegetUsersByRole('operator');
        $supervisors =  $this->model->BackofficegetUsersByRole('supervisor');
        $contract    =  $this->model->BackofficegetContractById($contract_id);
        $statuses=$this->model->BackofficegetStatuses();
        $campaigns=$this->model->BackofficegetCampaigns();
        require APP . 'view/backoffice/header.php';
        require APP . 'view/backoffice/editContract.php';
        require APP . 'view/backoffice/footer.php';
    }

    public function viewContract($contract_id){ 
        $operators   =  $this->model->BackofficegetUsersByRole('operator');
        $supervisors =  $this->model->BackofficegetUsersByRole('supervisor');
        $contract    =  $this->model->BackofficegetContractById($contract_id);
        $statuses=$this->model->BackofficegetStatuses();
        $campaigns=$this->model->BackofficegetCampaigns();
        require APP . 'view/backoffice/header.php';
        require APP . 'view/backoffice/viewContract.php';
        require APP . 'view/backoffice/footer.php';
    }

    //////////-documents-//////////////
    public function uploadDocuments(){ 
        $this->model->BackofficeuploadDocuments();
    }
    public function getDocuments($contract_id){ 
        $this->model->BackofficegetDocuments($contract_id);
    }
    public function getDocument($document_id){ 
        $this->model->BackofficegetDocument($document_id);
    }
    /////////////////////////////////

    //////////-audio-//////////////
    public function uploadAudios(){ 
        $this->model->BackofficeuploadAudios();
    }
    public function getAudios($contract_id){ 
        $this->model->BackofficegetAudios($contract_id);
    }
    public function getAudio($audio_id){ 
        $this->model->BackofficegetAudio($audio_id);
    }
    /////////////////////////////////

    public function users($showHours=false,$date=null){
        if ($showHours=='workhours') {
            $users=$this->model->BackofficegetUsers();
            require APP . 'view/backoffice/header.php';
            require APP . 'view/backoffice/workhours.php';
            require APP . 'view/backoffice/footer.php';
            return;
        }elseif(!$showHours){ 
            $users=$this->model->BackofficegetUsers();
            require APP . 'view/backoffice/header.php';
            require APP . 'view/backoffice/users.php';
            require APP . 'view/backoffice/footer.php';
        }else header('location:'.APP);
    }

    public function viewUser($user_id){ 
        $contracts=$this->model->BackofficegetContractsByUser($user_id);
        require APP . 'view/backoffice/header.php';
        require APP . 'view/backoffice/viewUser.php';
        require APP . 'view/backoffice/footer.php';

    }
    
    public function createUser(){ 
        if(isset($_POST['create_user'])){
            $this->model->BackofficecreateUser();
            return;
        }
        require APP . 'view/backoffice/header.php';
        require APP . 'view/backoffice/createUser.php';
        require APP . 'view/backoffice/footer.php';
    }

    public function editUser($user_id){ 
        if(isset($_POST['edit_user'])){
            $this->model->BackofficeeditUser($user_id);
            return;
        }
        $user=$this->model->BackofficegetUser($user_id);
        $supervisors   =  $this->model->BackofficegetUsersByRole('supervisor');
        require APP . 'view/backoffice/header.php';
        if(!isset($user->user_id)){
            echo "No user found!";
        } else {
            require APP . 'view/backoffice/editUser.php'; 
        }
        require APP . 'view/backoffice/footer.php';
    }
////////////////////////////////////////////////////////

    public function statuses(){
            $statuses=$this->model->BackofficegetStatuses();
            require APP . 'view/backoffice/header.php';
            require APP . 'view/backoffice/statuses.php';
            require APP . 'view/backoffice/footer.php';
    }

    public function createStatus(){ 
        if(isset($_POST['create_status'])){
            $this->model->BackofficecreateStatus();
            return;
        }
        require APP . 'view/backoffice/header.php';
        require APP . 'view/backoffice/createStatus.php';
        require APP . 'view/backoffice/footer.php';
    }

    public function editStatus($status_id){ 
        if ($status_id==1) {
            header('Location: '.URL.$_SESSION['role'].'/statuses');
            return;
        }
        if(isset($_POST['edit_status'])){
            $this->model->BackofficeeditStatus($status_id);
            return;
        }
        $status=$this->model->BackofficegetStatus($status_id);
        require APP . 'view/backoffice/header.php';
        if(!isset($status->status_id)){
            echo "No status found!";
        } else {
            require APP . 'view/backoffice/editStatus.php'; 
        }
        require APP . 'view/backoffice/footer.php';
    }
//////////////////////////////////////////////////////////////

    public function campaigns(){
            $campaigns=$this->model->BackofficegetCampaigns();
            require APP . 'view/backoffice/header.php';
            require APP . 'view/backoffice/campaigns.php';
            require APP . 'view/backoffice/footer.php';
    }

    public function createCampaign(){ 
        if(isset($_POST['create_campaign'])){
            $this->model->BackofficecreateCampaign();
            return;
        }
        require APP . 'view/backoffice/header.php';
        require APP . 'view/backoffice/createCampaign.php';
        require APP . 'view/backoffice/footer.php';
    }

    public function editCampaign($campaign_id){ 
        if ($campaign_id==1) {
            header('Location: '.URL.$_SESSION['role'].'/campaigns');
            return;
        }
        if(isset($_POST['edit_campaign'])){
            $this->model->BackofficeeditCampaign($campaign_id);
            return;
        }
        $campaign=$this->model->BackofficegetCampaign($campaign_id);
        require APP . 'view/backoffice/header.php';
        if(!isset($campaign->campaign_id)){
            echo "No campaign found!";
        } else {
            require APP . 'view/backoffice/editCampaign.php'; 
        }
        require APP . 'view/backoffice/footer.php';
    }
//////////////////////////////////////////////////////////////
}
