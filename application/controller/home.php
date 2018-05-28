<?php
class Home extends Controller{

    public function index(){
        if (isset($_SESSION['username'])) {//if logged in
            header('location:'.URL.$_SESSION['role']);
        } else{//if not logged in
            require APP.'view/login/index.php';
        }
    }


  public function login(){
                unset($_SESSION['username']);
                unset($_SESSION['role']);
                if (isset($_POST['username']) && isset($_POST['password']) ) { //check if all parameters are set
                      $sql= "SELECT  * FROM users WHERE username = :username and password = :password LIMIT 1";
                      $query = $this->db->prepare($sql);
                      $query->execute(array(':username'=>$_POST['username'],':password'=>$_POST['password']));
                      $row=$query->fetch(PDO::FETCH_ASSOC);
                      $num=$query->rowCount();
                    if($num > 0){ ///if login success
                        $_SESSION['username']=$row['username'];
                        $_SESSION['full_name']=$row['first_name'].' '.$row['last_name'];
                        $_SESSION['user_id']=$row['user_id'];
                        $_SESSION['role']=$row['role'];
                        $_SESSION['supervisor']=$row['supervisor'];
                        header('location:'.URL.$_SESSION['role']);
                    }else{//if error
                        header('location:'.URL.'?status=fail');
                    }
            } else echo "Please set all parameters!";//if parameters are not set
    }


      public function logout(){
            unset($_SESSION['username']);
            unset($_SESSION['role']);
            unset($_SESSION['user_id']);
            unset($_SESSION);
            session_destroy();
            header('location:'.URL.'?status=logout');
    }
}
