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
        $sql="SELECT * FROM users WHERE user_id=:user_id";
        $query=$this->db->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
        $user=$query->fetch();
        require APP . 'view/admin/header.php';
        if($query->rowCount() <1){
            echo "No user found!";
        } else {
            require APP . 'view/admin/editUser.php'; 
        }
        require APP . 'view/admin/footer.php';
    }
}
