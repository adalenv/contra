<?php

/**
 * //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit(); debug sql
 */
class operator extends Controller
{


    public function index(){ 
        require APP . 'view/operator/header.php';
        //require APP . 'view/operator/index.php';
        require APP . 'view/operator/footer.php';
    }
    
    public function createContract(){ 
        require APP . 'view/operator/header.php';
        require APP . 'view/operator/createContract.php';
        require APP . 'view/operator/footer.php';
    }
}
