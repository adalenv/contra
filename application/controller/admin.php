<?php

/**
 * //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit(); debug sql
 */
class operator extends Controller
{


    public function index(){ 
        require APP . 'view/operator/header.php';
        //require APP . 'view/operator/index.php';
        echo 'main page';
        require APP . 'view/operator/footer.php';
    }
    
    public function createContract(){ 
        require APP . 'view/operator/header.php';
        require APP . 'view/operator/createContract.php';
        require APP . 'view/operator/footer.php';
    }
    public function editContract($contract_id){ 
        require APP . 'view/operator/header.php';
        require APP . 'view/operator/editContract.php';
        require APP . 'view/operator/footer.php';
    }

    public function createUser(){ 
        require APP . 'view/operator/header.php';
        require APP . 'view/operator/createUser.php';
        require APP . 'view/operator/footer.php';
    }

    public function editUser($user_id){ 
        require APP . 'view/operator/header.php';
        require APP . 'view/operator/ceditUser.php';
        require APP . 'view/operator/footer.php';
    }
}
