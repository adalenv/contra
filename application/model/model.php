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

    public function getContractById($contract_id ){
        $sql='SELECT * FROM contracts WHERE contract_id=:contract_id ';
        $query = $this->db->prepare($sql);
        $query->execute(array(':contract_id'=>$contract_id));
        return $query->fetch();
    }

    public function getContracts(){
    	//$type,$proposal_number,$date,$name,$address,$location,$operator,$status,$cancellation_reason
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
        $query->bindParam(':operator', $operator);
        $query->bindParam(':limiter', $limiter, PDO::PARAM_INT);
        $query->bindParam(':date1', $date1);
        $query->bindParam(':date2', $date2);
      	$query->bindParam(':first_name', $first_name);
        $query->bindParam(':last_name', $last_name);
        $query->bindParam(':status', $status);
        $query->execute();
        return $query->fetchAll();
    }

    public function uploadDocuments(){
    	$contract_id=$_POST['contract_id'];
		$target_dir = APP."documents/";
		$target_file = $target_dir .$contract_id.'-'. basename($_FILES["file"]["name"]);
		if (move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)) {
			$sql="INSERT INTO documents(contract_id,url) VALUES(:contract_id,:url)";
			$query=$this->db->prepare($sql);
			$query->execute(array(':contract_id' =>(int)$contract_id,':url'=>$contract_id.'-'.$_FILES["file"]["name"]));
		 	echo "success";
		}else{
			echo "fail";
		}
    }

    public function getDocuments($contract_id){
    	$sql="SELECT * FROM documents WHERE `contract_id`=:contract_id ORDER BY document_id DESC";
    	$query=$this->db->prepare($sql);
    	$query->execute(array(':contract_id' =>$contract_id));
    	$documents=$query->fetchAll(PDO::FETCH_ASSOC);
        header('Content-type: application/json');
        echo json_encode($documents);
        //print_r($documents);
    }

    public function getDocument($document_id){
    	$sql="SELECT *  FROM documents WHERE `document_id`=:document_id";
    	$query=$this->db->prepare($sql);
    	$query->execute(array(':document_id' =>$document_id));
    	$document=$query->fetch();
    	if (!$document) {
    		echo  "File do not exist in database!";
    		return;
    	}
		$target_dir = APP."documents/";
      //  print_r($document);
		$target_file = $target_dir . basename($document->url);
        //print_r($target_file);
		$ext = pathinfo($target_file, PATHINFO_EXTENSION);   
 		if (file_exists ($target_file)) {
			switch(strtolower($ext)){  
				case "txt": 
					header("Content-type: text/plain");  
					readfile($target_file);
				break;  
				case "jpg": 
					header("Content-type: image/jpg");  
					readfile($target_file);
				break;  
				case "png": 				 
					header("content-type: image/png");
					readfile($target_file);
				break;  
				case "pdf": 				 
					header("content-type: application/pdf");
					readfile($target_file);
				break; 
				case 'docx':
					echo "not suppoted yet";
				break;
                case 'csv':
                    header("Content-type: text/csv");
                    header('Content-disposition: attachment; filename="'.$document->url.'"');
                    readfile($target_file);
                break;
			};
		} else{
			echo "File do not exist in server!";
		}
	}

    public function uploadAudios(){
        $contract_id=$_POST['contract_id'];
        $target_dir = APP."audios/";
        $target_file = $target_dir .$contract_id.'-'. basename($_FILES["file"]["name"]);
        echo $target_file;
        if (move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)) {
            $sql="INSERT INTO audios(contract_id,url) VALUES(:contract_id,:url)";
            $query=$this->db->prepare($sql);
            $query->execute(array(':contract_id' =>(int)$contract_id,':url'=>$contract_id.'-'.$_FILES["file"]["name"]));
            echo "success";
        }else{
            echo "fail";
        }
    }

    public function getAudios($contract_id){
    	$sql="SELECT * FROM audios WHERE `contract_id`=:contract_id ORDER BY audio_id DESC";
    	$query=$this->db->prepare($sql);
    	$query->execute(array(':contract_id' =>$contract_id));
    	$audios=$query->fetchAll(PDO::FETCH_ASSOC);
        header('Content-type: application/json');
        echo json_encode($audios);
    }

    public function getAudio($audio_id){
    	$sql="SELECT *  FROM audios WHERE `audio_id`=:audio_id";
    	$query=$this->db->prepare($sql);
    	$query->execute(array(':audio_id' =>$audio_id));
    	$audio=$query->fetch();
    	if (!$audio) {
    		echo  "File do not exist in database!";
    		return;
    	}
		$target_dir = APP."audios/";
		$target_file = $target_dir . basename($audio->url);
		$ext = pathinfo($target_file, PATHINFO_EXTENSION);   
 		if (file_exists ($target_file)) {
			switch(strtolower($ext)){  
				case "mp3": 
					header("Content-type: audio/mp3");  
					readfile($target_file);
				break;  

			};
		} else{
			echo "File do not exist in server!";
		}
	}

}
