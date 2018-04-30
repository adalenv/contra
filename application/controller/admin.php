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
    
    public function createContract(){ 
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/createContract.php';
        require APP . 'view/admin/footer.php';
    }
    public function editContract($contract_id){ 
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/editContract.php';
        require APP . 'view/admin/footer.php';
    }

    public function users(){ 
        $users=$this->model->getUsers();
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/users.php';
        require APP . 'view/admin/footer.php';

    }
    public function createUser(){ 
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/createUser.php';
        require APP . 'view/admin/footer.php';
    }

    public function editUser($user_id){ 
        if(isset($_POST['edit_user'])){
            $this->model->editUser($user_id);
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
