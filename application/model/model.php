<?php

class Model
{

    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getUser($user_id){
        $sql="SELECT * FROM users WHERE user_id=:user_id";
        $query=$this->db->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
        return $query->fetch();
    }

    public function getUsers(){
        $sql="SELECT * FROM users";
        $query=$this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function createUser(){
        $sql="INSERT INTO users(username,password,first_name,last_name,role) VALUES (:username,:password,:first_name,:last_name,:role)";
        $query = $this->db->prepare($sql);
        $parameters=array(':username' => $_POST['username'],
                      ':password' => $_POST['password'],
                      ':first_name' => $_POST['first_name'],
                      ':last_name' => $_POST['last_name'],
                      ':role' => $_POST['role']
                        );
        if($query->execute($parameters)){
            $_SESSION['create_user']='success';
        } else {
            $_SESSION['create_user']='fail';
        }
        header("location:".URL.$_SESSION['role'].'/users');
    }
    public function editUser($user_id){
        $sql="UPDATE users SET username=:username,password=:password,first_name=:first_name,last_name=:last_name,role=:role WHERE user_id=:user_id";
        $query = $this->db->prepare($sql);
        $parameters=array(':username' => $_POST['username'],
                      ':password' => $_POST['password'],
                      ':first_name' => $_POST['first_name'],
                      ':last_name' => $_POST['last_name'],
                      ':role' => $_POST['role'],
                      ':user_id' => $user_id
                        );
        if($query->execute($parameters)){
            $_SESSION['edit_user']='success';
        } else {
            $_SESSION['edit_user']='fail';
        }
        header("location:".URL.$_SESSION['role'].'/users');
    }

    public function deleteUser($user_id){
        $sql="DELETE FROM users WHERE user_id=:user_id";
        $query = $this->db->prepare($sql);
       //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters); 
        if($query->execute(array(':user_id' => $user_id))){
            $_SESSION['delete_user']='success';
        } else {
            $_SESSION['delete_user']='fail';
        }
        header("location:".URL.$_SESSION['role'].'/users');
    }


}
