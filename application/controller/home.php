<?php
session_start();
class Home extends Controller{

    public function index(){
        $_SESSION['user']='1';
        $_SESSION['role']='operator';

        
        if (isset($_SESSION['user'])) {//if logged in
            header('location:'.URL.$_SESSION['role']);
        } else{//if not logged in
            require APP.'view/login/index.php';
        }
    }







    // public function login() {
    //     // require APP . 'view/_templates/header.php';
    //     // require APP . 'view/home/example_one.php';
    //     // require APP . 'view/_templates/footer.php';
    //     echo 'login page';
    // }
}
