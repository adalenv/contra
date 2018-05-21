<?php
if(!isset($_SESSION['username'])){ header('Location:'.URL); return; };
/**
 * //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit(); debug sql
 */
class admin extends Controller
{


    public function index(){ 
        header('Location:'.URL.$_SESSION['role'].'/contracts');
    }

    function contracts(){	
        if (isset($_GET['export'])){
            if ($_GET['export']==true) {
                $this->model->AdmingetContracts('export');
                return;
            }
        }
        $operators=$this->model->AdmingetUsersByRole('operator');
    	$contracts=$this->model->AdmingetContracts();
        $statuses=$this->model->AdmingetStatuses();
   		require APP . 'view/admin/header.php';
        require APP . 'view/admin/contracts.php';
        require APP . 'view/admin/footer.php';
    }
    
    public function createContract(){ 
        if(isset($_POST['create_contract'])){
            $this->model->AdmincreateContract();
            return;
        }
        $operators   =  $this->model->AdmingetUsersByRole('operator');
        $supervisors   =  $this->model->AdmingetUsersByRole('supervisor');
        $campaigns=$this->model->AdmingetCampaigns();
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/createContract.php';
        require APP . 'view/admin/footer.php';
    }

    public function editContract($contract_id){ 
        if(isset($_POST['edit_contract'])){
            $this->model->AdmineditContract($contract_id);
            return;
        }
        $operators   =  $this->model->AdmingetUsersByRole('operator');
        $supervisors =  $this->model->AdmingetUsersByRole('supervisor');
        $contract    =  $this->model->AdmingetContractById($contract_id);
        $statuses=$this->model->AdmingetStatuses();
        $campaigns=$this->model->AdmingetCampaigns();
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/editContract.php';
        require APP . 'view/admin/footer.php';
    }

    public function viewContract($contract_id){ 
        $operators   =  $this->model->AdmingetUsersByRole('operator');
        $supervisors =  $this->model->AdmingetUsersByRole('supervisor');
        $contract    =  $this->model->AdmingetContractById($contract_id);
        $statuses=$this->model->AdmingetStatuses();
        $campaigns=$this->model->AdmingetCampaigns();
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/viewContract.php';
        require APP . 'view/admin/footer.php';
    }

    //////////-documents-//////////////
    public function uploadDocuments(){ 
    	$this->model->AdminuploadDocuments();
    }
    public function getDocuments($contract_id){ 
    	$this->model->AdmingetDocuments($contract_id);
    }
    public function getDocument($document_id){ 
    	$this->model->AdmingetDocument($document_id);
    }
	/////////////////////////////////

    //////////-audio-//////////////
    public function uploadAudios(){ 
    	$this->model->AdminuploadAudios();
    }
    public function getAudios($contract_id){ 
    	$this->model->AdmingetAudios($contract_id);
    }
    public function getAudio($audio_id){ 
    	$this->model->AdmingetAudio($audio_id);
    }
	/////////////////////////////////

    public function users($showHours=false,$date=null){
        if ($showHours=='workhours') {
            $users=$this->model->AdmingetUsers();
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/workhours.php';
            require APP . 'view/admin/footer.php';
            return;
        }elseif(!$showHours){ 
            $users=$this->model->AdmingetUsers();
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/users.php';
            require APP . 'view/admin/footer.php';
        }else header('location:'.APP);
    }

    public function viewUser($user_id){ 
        $contracts=$this->model->AdmingetContractsByUser($user_id);
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/viewUser.php';
        require APP . 'view/admin/footer.php';

    }
    
    public function createUser(){ 
        if(isset($_POST['create_user'])){
            $this->model->AdmincreateUser();
            return;
        }
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/createUser.php';
        require APP . 'view/admin/footer.php';
    }

    public function editUser($user_id){ 
        if(isset($_POST['edit_user'])){
            $this->model->AdmineditUser($user_id);
            return;
        }
        if (isset($_GET['deleteUser'])) {
             $this->model->AdmindeleteUser($user_id);
            return;
        }
        $user=$this->model->AdmingetUser($user_id);
        $supervisors   =  $this->model->AdmingetUsersByRole('supervisor');
        require APP . 'view/admin/header.php';
        if(!isset($user->user_id)){
            echo "No user found!";
        } else {
            require APP . 'view/admin/editUser.php'; 
        }
        require APP . 'view/admin/footer.php';
    }
////////////////////////////////////////////////////////

    public function statuses(){
            $statuses=$this->model->AdmingetStatuses();
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/statuses.php';
            require APP . 'view/admin/footer.php';
    }

    public function createStatus(){ 
        if(isset($_POST['create_status'])){
            $this->model->AdmincreateStatus();
            return;
        }
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/createStatus.php';
        require APP . 'view/admin/footer.php';
    }

    public function editStatus($status_id){ 
        if ($status_id==1) {
            header('Location: '.URL.$_SESSION['role'].'/statuses');
            return;
        }
        if(isset($_POST['edit_status'])){
            $this->model->AdmineditStatus($status_id);
            return;
        }
        if (isset($_GET['deleteStatus'])) {
             $this->model->AdmindeleteStatus($status_id);
            return;
        }
        $status=$this->model->AdmingetStatus($status_id);
        require APP . 'view/admin/header.php';
        if(!isset($status->status_id)){
            echo "No status found!";
        } else {
            require APP . 'view/admin/editStatus.php'; 
        }
        require APP . 'view/admin/footer.php';
    }
//////////////////////////////////////////////////////////////

    public function campaigns(){
            $campaigns=$this->model->AdmingetCampaigns();
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/campaigns.php';
            require APP . 'view/admin/footer.php';
    }

    public function createCampaign(){ 
        if(isset($_POST['create_campaign'])){
            $this->model->AdmincreateCampaign();
            return;
        }
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/createCampaign.php';
        require APP . 'view/admin/footer.php';
    }

    public function editCampaign($campaign_id){ 
        if ($campaign_id==1) {
            header('Location: '.URL.$_SESSION['role'].'/campaigns');
            return;
        }
        if(isset($_POST['edit_campaign'])){
            $this->model->AdmineditCampaign($campaign_id);
            return;
        }
        if (isset($_GET['deleteCampaign'])) {
             $this->model->AdmindeleteCampaign($campaign_id);
            return;
        }
        $campaign=$this->model->AdmingetCampaign($campaign_id);
        require APP . 'view/admin/header.php';
        if(!isset($campaign->campaign_id)){
            echo "No campaign found!";
        } else {
            require APP . 'view/admin/editCampaign.php'; 
        }
        require APP . 'view/admin/footer.php';
    }
//////////////////////////////////////////////////////////////
}
