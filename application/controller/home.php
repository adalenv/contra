<?php
header("Access-Control-Allow-Origin: *");
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
                        if ($row['ip']!='') {
                          if ($row['ip']!=$_SERVER['REMOTE_ADDR']) {
                            echo 'This IP is not allowed!';
                            return;
                          }
                        }

                        $_SESSION['username']=$row['username'];
                        $_SESSION['full_name']=$row['first_name'].' '.$row['last_name'];
                        $_SESSION['user_id']=$row['user_id'];
                        $_SESSION['role']=$row['role'];
                        $_SESSION['supervisor']=$row['supervisor'];

                        if (isset($_POST['external_url'])) {
                            echo 'success'; //echo success on external login
                        }else {
                            header('location:'.URL.$_SESSION['role']);
                        }
                        
                    }else{//if error
                        if (isset($_POST['external_url'])) {//go back if its external login
                           echo '<script>javascript:history.back();</script>'; 
                        }else{
                           header('location:'.URL.'?status=fail'); 
                        }
                        
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
