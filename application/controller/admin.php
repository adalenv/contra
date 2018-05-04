<?php

/**
 * //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit(); debug sql
 */
class admin extends Controller
{


    public function index(){ 
        require APP . 'view/admin/header.php';
        //require APP . 'view/admin/index.php';
        echo ' admin main page';
        require APP . 'view/admin/footer.php';
    }

    function contracts()
    {	$users=$this->model->getUsers();
    	$contracts=$this->model->getContracts();
   		require APP . 'view/admin/header.php';
        require APP . 'view/admin/contracts.php';
        require APP . 'view/admin/footer.php';
    }
    
    public function createContract(){ 
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/createContract.php';
        require APP . 'view/admin/footer.php';
    }
    public function editContract($contract_id){ 
    	$contract=$this->model->getContractById($contract_id);
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/editContract.php';
        require APP . 'view/admin/footer.php';
    }
    public function viewContract($contract_id){ 
    	$contract=$this->model->getContractById($contract_id);
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

    public function users(){ 
        $users=$this->model->getUsers();
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/users.php';
        require APP . 'view/admin/footer.php';

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
        require APP . 'view/admin/header.php';
        if(!isset($user->user_id)){
            echo "No user found!";
        } else {
            require APP . 'view/admin/editUser.php'; 
        }
        require APP . 'view/admin/footer.php';
    }
}
