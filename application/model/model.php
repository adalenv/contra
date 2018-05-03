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
        if($query->execute(array(':user_id' => $user_id))){
            $_SESSION['delete_user']='success';
        } else {
            $_SESSION['delete_user']='fail';
        }
        header("location:".URL.$_SESSION['role'].'/users');
    }

    public function getContractsByUser($user_id ){
        $page=(int)(isset($_GET['page'])? $_GET['page']:0);
        $limiter=30;
        $pager=$limiter*$page;
        $sql='SELECT * FROM contracts WHERE operator=:user_id LIMIT :pager, :limiter ';
        $query = $this->db->prepare($sql);
        $query->bindParam(':pager', $pager, PDO::PARAM_INT);
        $query->bindParam(':limiter', $limiter, PDO::PARAM_INT);
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll();
    }

    public function getContracts(){
    	//$type,$proposal_number,$date,$name,$address,$location,$operator,$status,$cancellation_reason

        $where='';
        $page=(int)(isset($_GET['page'])? $_GET['page']:0);
        $limiter=30;
        $pager=$limiter*$page;
        $contract_type=(isset($_GET['contract_type'])?$_GET['contract_type']:'%');
        $operator=(isset($_GET['operator'])?$_GET['operator']:'%');
        $date=(isset($_GET['date'])?$_GET['date']:'');
        $client_name=(isset($_GET['client_name'])?$_GET['client_name']:'');
        $status=(isset($_GET['status'])?$_GET['status']:'%');

        /////////////////////////if is set id////////////////////////////
        if (isset($_GET['id'])) {
        	if ($_GET['id']!='') {
        		$_GET['client_name']='';
        		$_GET['operator']='%';
        		$_GET['status']='%';
        		$_GET['date']='';
        		$_GET['contract_type']='%';
		        $sql="SELECT * FROM contracts WHERE contract_id =:id";
		        $query = $this->db->prepare($sql);
		        $query->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
		        $query->execute();
		        return $query->fetchAll();
        	}
        }
        /////////////////////////////////////////////////////////////////

        /////////////////////////////-date-////////////////////////////
		if ($date!='') {
	        $date =explode('-',(isset($_GET['date'])?$_GET['date']:''));
			$date1 = date("Y-m-d", strtotime($date[0]));
			$date2 = date("Y-m-d", strtotime($date[1]));
		} else {
			$date1 ="1999-01-01";
			$date2 ="2099-01-01";
		}
		////////////////////////////////////////////////////////////////////

		///////////////-name-//////////////////////////////////////////////
		if ($client_name!=''){
			if (count(explode(' ',$client_name))>1) { ///if both
				$first_name=explode(' ',$client_name)[0].'%';
				$last_name=explode(' ',$client_name)[1].'%';
			}else{                          // if one part
				$first_name=$client_name.'%';
				$last_name='%';
			}	
		} else {						//if none
				$first_name='%';
				$last_name='%';
		}
		////////////////////////////////////////////////////////////////////



        $sql="SELECT * FROM contracts 
        		WHERE  contract_type LIKE :contract_type 
        			AND operator LIKE :operator  
        			AND  (DATE(`date`) >= DATE(:date1) AND DATE(`date`) <= DATE(:date2)) 
        			AND ( (first_name LIKE :first_name AND last_name LIKE :last_name) 
        				OR (first_name LIKE :last_name AND last_name LIKE :first_name)) 
        			AND status LIKE :status  LIMIT :pager , :limiter";

        $query = $this->db->prepare($sql);
        $query->bindParam(':pager', $pager, PDO::PARAM_INT);
        $query->bindParam(':limiter', $limiter, PDO::PARAM_INT);
        $query->bindParam(':contract_type', $contract_type);
        $query->bindParam(':operator', $operator, PDO::PARAM_INT);
        $query->bindParam(':limiter', $limiter, PDO::PARAM_INT);
        $query->bindParam(':date1', $date1);
        $query->bindParam(':date2', $date2);
      	$query->bindParam(':first_name', $first_name);
        $query->bindParam(':last_name', $last_name);
        $query->bindParam(':status', $status);

        $query->execute();
        return $query->fetchAll();
    }


}
