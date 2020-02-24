<?php
if(!isset($_SESSION['username'])){ header('Location:'.URL); return; };
if($_SESSION['role']!='admin') { header('Location:'.URL); return; };
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
                $this->model->getContracts('export');
                return;
            }
        }
        $ibs=$this->model->getIBs();
        $operatorsAll=$this->model->getUsersByRoleAll('operator');
        $operators=$this->model->getUsersByRole('operator');
        $supervisors=$this->model->getUsersByRole('supervisor');
    	  $output=$this->model->getContracts();
        $contracts=$output[1];
        $pages=ceil($output[0]/100);
        $cnt_nr=$output[2];
        $campaigns=$this->model->getCampaigns();
        $statuses=$this->model->getStatuses();
   		  require APP . 'view/admin/header.php';
        require APP . 'view/admin/contracts.php';
        require APP . 'view/admin/footer.php';
    }

    public function createContract(){
        if(isset($_POST['create_contract'])){
            $this->model->createContract();
            return;
        }
        $operators   =  $this->model->getUsersByRole('operator');
        $supervisors =  $this->model->getUsersByRole('supervisor');
        $campaigns=$this->model->getCampaigns();
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/createContract.php';
        require APP . 'view/admin/footer.php';
    }

    public function editContract($contract_id){
        if(isset($_POST['edit_contract'])){
            $this->model->editContract($contract_id);
            return;
        }
        $operatorsAll=$this->model->getUsersByRoleAll('operator');
        $operators   =  $this->model->getUsersByRole('operator');
        $supervisors =  $this->model->getUsersByRole('supervisor');
        $contract    =  $this->model->getContractById($contract_id);
        $statuses=$this->model->getStatuses();
        $campaigns=$this->model->getCampaigns();
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/editContract.php';
        require APP . 'view/admin/footer.php';
    }

    public function viewContract($contract_id){
        $operatorsAll=  $this->model->getUsersByRoleAll('operator');
        $operators   =  $this->model->getUsersByRole('operator');
        $supervisors =  $this->model->getUsersByRole('supervisor');
        $contract    =  $this->model->getContractById($contract_id);
        $changelog   =  $this->model->getChangelog($contract_id);
        if ($contract->status_temp!='') {
            $status_temp=   $this->model->getStatusById($contract->status_temp);
            $status_name_temp=  $status_temp[0]->status_name;
        }else{
            $status_name_temp="No Temp";
        }

        $statuses=$this->model->getStatuses();
        $campaigns=$this->model->getCampaigns();
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/viewContract.php';
        require APP . 'view/admin/footer.php';
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

    public function stats(){
        $users=$this->model->getUsersByRole('backoffice');
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/stats.php';
        require APP . 'view/admin/footer.php';
    }

    public function users($showHours=false,$date=null){
        if ($showHours=='workhours') {
            $users=$this->model->getUsers();
            //$statuses=$this->model->getStatuses();
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/workhours.php';
            require APP . 'view/admin/footer.php';
            return;
        }elseif($showHours=='workhours_'){//full stats
          $users=$this->model->getUsers();
          $statuses=$this->model->getStatuses();
          require APP . 'view/admin/header.php';
          require APP . 'view/admin/workhours_.php';
          require APP . 'view/admin/footer.php';
          return;
        }elseif(!$showHours){
            $users=$this->model->getUsers();
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/users.php';
            require APP . 'view/admin/footer.php';
        }else header('location:'.APP);
    }

    public function inactiveUsers($showHours=false,$date=null){
        if ($showHours=='workhours') {
            $users=$this->model->getInactiveUsers();
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/workhours.php';
            require APP . 'view/admin/footer.php';
            return;
        }elseif(!$showHours){
            $users=$this->model->getInactiveUsers();
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/users.php';
            require APP . 'view/admin/footer.php';
        }else header('location:'.APP);
    }
    public function viewUser($user_id){
        $contracts=$this->model->getContractsByUser($user_id);
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/viewUser.php';
        require APP . 'view/admin/footer.php';

    }

    public function createUser(){
        if(isset($_POST['create_user'])){
            $this->model->createUser();
            return;
        }
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/createUser.php';
        require APP . 'view/admin/footer.php';
    }

    public function editUser($user_id){
        if(isset($_POST['edit_user'])){
            $this->model->editUser($user_id);
            return;
        }
        if (isset($_GET['deleteUser'])) {
             $this->model->deleteUser($user_id);
            return;
        }
        $user=$this->model->getUser($user_id);
        $supervisors   =  $this->model->getUsersByRole('supervisor');
        require APP . 'view/admin/header.php';
        if(!isset($user->user_id)){
            echo "No user found!";
        } else {
            require APP . 'view/admin/editUser.php';
        }
        require APP . 'view/admin/footer.php';
    }


    public function ibUpload($ib_id){
        $ib=$this->model->getIB($ib_id);
        $campaigns=$this->model->getCampaigns();

        if(isset($_POST['import'])){
            //print_r($_REQUEST);
            $this->model->uploadList($ib_id);
            return;
        }
        //$operators=$this->model->getUsersByRole('operator');
        //$statuses=$this->model->getStatuses();
        //$list->count=$this->model->countList($list_id);

        require APP . 'view/admin/header.php';
        require APP . 'view/admin/ibUpload.php';
        require APP . 'view/admin/footer.php';
    }

////////////////////////////////////////////////////////

    public function statuses(){
            $statuses=$this->model->getStatuses();
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/statuses.php';
            require APP . 'view/admin/footer.php';
    }

    public function ib($dup=""){
            $ibs=$this->model->getIBs();
            if ($dup=="dup") {
              $statuses=$this->model->getStatuses();
              $contracts=$this->model->getContractByPodPdr($_GET['ids']);
              require APP . 'view/admin/header.php';
              require APP . 'view/admin/dup.php';
              require APP . 'view/admin/footer.php';
              return;
            }

            $ibs=$this->model->getIBs();
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/ib.php';
            require APP . 'view/admin/footer.php';
    }
    public function createIB(){
        if(isset($_POST['create_ib'])){
            $this->model->createIB();
            return;
        }
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/createIB.php';
        require APP . 'view/admin/footer.php';
    }

    public function createStatus(){
        if(isset($_POST['create_status'])){
            $this->model->createStatus();
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
            $this->model->editStatus($status_id);
            return;
        }
        if (isset($_GET['deleteStatus'])) {
             $this->model->deleteStatus($status_id);
            return;
        }
        $status=$this->model->getStatus($status_id);
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
            $campaigns=$this->model->getCampaigns();
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/campaigns.php';
            require APP . 'view/admin/footer.php';
    }

    public function createCampaign(){
        if(isset($_POST['create_campaign'])){
            $this->model->createCampaign();
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
            $this->model->editCampaign($campaign_id);
            return;
        }
        if (isset($_GET['deleteCampaign'])) {
             $this->model->deleteCampaign($campaign_id);
            return;
        }
        $campaign=$this->model->getCampaign($campaign_id);
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
