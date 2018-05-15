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

    public function getUsersByRole($role){
        $sql="SELECT * FROM users where role = :role";
        $query=$this->db->prepare($sql);
        $query->execute(array(':role' =>$role));
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
        $page         = (int)(isset($_REQUEST['page'])? $_REQUEST['page']:0);
        $contract_type= (isset($_REQUEST['contract_type'])?$_REQUEST['contract_type']:'%');
        $operator     = (isset($_REQUEST['operator'])?$_REQUEST['operator']:'%');
        $date         = (isset($_REQUEST['date'])?$_REQUEST['date']:'');
        $client_name  = (isset($_REQUEST['client_name'])?$_REQUEST['client_name']:'');
        $status       = (isset($_REQUEST['status'])?$_REQUEST['status']:'%');
        $location     = (isset($_REQUEST['location'])?$_REQUEST['location']:'%');
        $limiter      = 30;
        $pager        = $limiter*$page;
       
        /////////////////////////if is set id////////////////////////////
        if (isset($_REQUEST['id'])) {
        	if ($_REQUEST['id']!='') {
        		$_REQUEST['client_name']='';
        		$_REQUEST['operator']='%';
        		$_REQUEST['status']='%';
        		$_REQUEST['date']='';
        		$_REQUEST['contract_type']='%';
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
		///////////////////////////////////////////////////////////////////

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
        ///////////////////////////////////////////////////////////////////
        
		//////////////////////////-location-////////////////////////////////
        if ($location==''){$location='%';};
        ////////////////////////////////////////////////////////////////////

        $sql="SELECT * FROM contracts 
        		WHERE  
                    contract_type LIKE :contract_type 

        			AND  operator LIKE :operator 

        			AND (
                            DATE(`date`) >= DATE(:date1) 
                        AND 
                            DATE(`date`) <= DATE(:date2)
                        ) 

        			AND  (    
                            (first_name LIKE :first_name AND last_name LIKE :last_name) 
        				OR
                            (first_name LIKE :last_name AND last_name LIKE :first_name)
                        ) 

        			AND status LIKE :status  

                    AND location LIKE :location

                ORDER BY contract_id DESC

                LIMIT :pager , :limiter";

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
        $query->bindParam(':location', $location);
        $query->execute();
        return $query->fetchAll();
    }

    public function editContract($contract_id){
        $sql="UPDATE contracts SET `date`=:date,operator=:operator,ugm_cb=:ugm_cb,analisi_cb=:analisi_cb,iniziative_cb=:iniziative_cb,
                tel_number=:tel_number,alt_number=:alt_number,cel_number=:cel_number,cel_number2=:cel_number2,cel_number3=:cel_number3,email=:email,alt_email=:alt_email,
                client_type=:client_type,gender=:gender,rag_sociale=:rag_sociale,first_name=:first_name,last_name=:last_name,vat_number=:vat_number,partita_iva=:partita_iva,
                birth_date=:birth_date,birth_nation=:birth_nation,birth_municipality=:birth_municipality,document_type=:document_type,document_number=:document_number,document_date=:document_date,
                toponimo=:toponimo,address=:address,civico=:civico,price=:price,location=:location,
                ubicazione_fornitura=:ubicazione_fornitura,domicillazione_documenti_fatture=:domicillazione_documenti_fatture,contract_type=:contract_type,listino=:listino,
                richiede_gas_naturale=:richiede_gas_naturale,
                request_type=:request_type,pdr=:pdr,fornitore_uscente=:fornitore_uscente,consume_annuo=:consume_annuo,
                tipo_riscaldamento=:tipo_riscaldamento,tipo_cottura_acqua=:tipo_cottura_acqua,
                fature_via_email=:fature_via_email,
                payment_type=:payment_type,iban_code=:iban_code,iban_accounthoder=:iban_accounthoder,iban_fiscal_code=:iban_fiscal_code,note=:note WHERE contract_id=:contract_id";
      //  print_r($sql);
        $query = $this->db->prepare($sql);
        $query->bindParam(':date', $_POST['date']);
        $query->bindParam(':operator', $_POST['operator'], PDO::PARAM_INT);

        $query->bindValue(':ugm_cb',(isset($_POST['ugm_cb'])?$_POST['ugm_cb']:'false'));
        $query->bindValue(':analisi_cb',(isset($_POST['analisi_cb'])?$_POST['analisi_cb']:'false'));
        $query->bindValue(':iniziative_cb',(isset($_POST['iniziative_cb'])?$_POST['iniziative_cb']:'false'));
       
        $query->bindParam(':tel_number', $_POST['tel_number']);
        $query->bindParam(':alt_number', $_POST['alt_number']);
        $query->bindParam(':cel_number', $_POST['cel_number']);
        $query->bindParam(':cel_number2', $_POST['cel_number2']);
        $query->bindParam(':cel_number3', $_POST['cel_number3']);
        $query->bindParam(':email', $_POST['email']);
        $query->bindParam(':alt_email', $_POST['alt_email']);

        $query->bindParam(':client_type', $_POST['client_type']);
        $query->bindParam(':gender', $_POST['gender']);
        $query->bindParam(':rag_sociale', $_POST['rag_sociale']);
        $query->bindParam(':first_name', $_POST['first_name']);
        $query->bindParam(':last_name', $_POST['last_name']);
        $query->bindParam(':vat_number', $_POST['vat_number']);
        $query->bindParam(':partita_iva', $_POST['partita_iva']);
        $query->bindParam(':birth_date', $_POST['birth_date']);
        $query->bindParam(':birth_nation', $_POST['birth_nation']);
        $query->bindParam(':birth_municipality', $_POST['birth_municipality']);
        $query->bindParam(':document_type', $_POST['document_type']);
        $query->bindParam(':document_number', $_POST['document_number']);
        $query->bindParam(':document_date', $_POST['document_date']);

        $query->bindParam(':toponimo', $_POST['toponimo']);
        $query->bindParam(':address', $_POST['address']);
        $query->bindParam(':civico', $_POST['civico']);
        $query->bindParam(':price', $_POST['price']);
        $query->bindParam(':location', $_POST['location']);
        $query->bindParam(':ubicazione_fornitura', $_POST['ubicazione_fornitura']);
        $query->bindParam(':domicillazione_documenti_fatture', $_POST['domicillazione_documenti_fatture']);
        $query->bindParam(':contract_type', $_POST['contract_type']);
        $query->bindParam(':listino', $_POST['listino']);
        $query->bindValue(':richiede_gas_naturale',(isset($_POST['richiede_gas_naturale'])?$_POST['richiede_gas_naturale']:'false'));
        $query->bindParam(':request_type', $_POST['request_type']);
        $query->bindParam(':pdr', $_POST['pdr']);
        $query->bindParam(':fornitore_uscente', $_POST['fornitore_uscente']);
        $query->bindParam(':consume_annuo', $_POST['consume_annuo']);

        $query->bindValue(':tipo_riscaldamento',(isset($_POST['tipo_riscaldamento'])?$_POST['tipo_riscaldamento']:'false'));
        $query->bindValue(':tipo_cottura_acqua',(isset($_POST['tipo_cottura_acqua'])?$_POST['tipo_cottura_acqua']:'false'));

        $query->bindValue(':fature_via_email',(isset($_POST['fature_via_email'])?$_POST['fature_via_email']:'false'));
       
        $query->bindParam(':payment_type', $_POST['payment_type']);
        $query->bindParam(':iban_code', $_POST['iban_code']);
        $query->bindParam(':iban_accounthoder', $_POST['iban_accounthoder']);
        $query->bindParam(':iban_fiscal_code', $_POST['iban_fiscal_code']);
        $query->bindParam(':note', $_POST['note']);

        $query->bindParam(':contract_id',$contract_id,PDO::PARAM_INT);
        //error handler
        if ($query->execute()) {
            header('location: ../viewContract/'.$contract_id.'#success');     
        } else {
            echo "An error occurred!";
        }
    }

    public function uploadDocuments(){
    	$contract_id=$_POST['contract_id'];
		$target_dir = APP."documents/";
        $target_file = $target_dir .$contract_id.'-'. basename($_FILES["file"]["name"]);
        $allow_ext = array('pdf','doc','docx','csv','xls','xlsx','txt','jpg','jpeg');
        $ext = pathinfo($target_file, PATHINFO_EXTENSION);
        if (!in_array($ext,$allow_ext)) { 
            echo "ext_error";
            return;
        }
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
                case "jpeg": 
                    header("Content-type: image/jpeg");  
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
					//echo "not suppoted yet";
                    header('Content-Type: application/octet-stream');
                    header("Content-Disposition: attachment; filename=\"".$document->url."\"");
                    readfile($target_file);
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
        $allow_ext = array('mp3','wav','gsm','gsw');
        $ext = pathinfo($target_file, PATHINFO_EXTENSION);
        if (!in_array($ext,$allow_ext)) { 
            echo "ext_error";
            return;
        }
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
