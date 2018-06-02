<?php
class Problem extends Controller{
    public function index(){
        // load views
        //require APP . 'view/_templates/header.php';
        print_r($_SERVER['REQUEST_URI']);
        require APP . 'view/problem/index.php';
       // require APP . 'view/_templates/footer.php';
    }
}
