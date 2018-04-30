<?php
class Home extends Controller{

    public function index(){
        
        if (isset($_SESSION['user'])) {//if logged in
            header('location:'.URL.$_SESSION['role']);
        } else{//if not logged in
           // require APP.'view/login/index.php';
            echo 'no logged in';
        }
    }







    // public function login() {
    //     // require APP . 'view/_templates/header.php';
    //     // require APP . 'view/home/example_one.php';
    //     // require APP . 'view/_templates/footer.php';
    //     echo 'login page';
    // }
}
