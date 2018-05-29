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
////////////////////////////////////////////////////////////////////
//                  administrator
//////////////////////////////////////////////////////////////////

    public function getUser($user_id){
        $sql="SELECT * FROM users WHERE user_id=:user_id";
        $query=$this->db->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
        return $query->fetch();
    }

    public function getUsers(){
        $sql="SELECT * FROM users ORDER BY role DESC";
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
    public function getUsersBySupervisor($supervisor){
        $sql="SELECT * FROM users where role='operator' AND supervisor = :supervisor";
        $query=$this->db->prepare($sql);
        $query->execute(array(':supervisor' =>$supervisor));
        return $query->fetchAll();
    }
    public function getSupervisorByOperator($user_id){
        $sql="SELECT * FROM users where user_id= :user_id LIMIT 1";
        $query=$this->db->prepare($sql);
        $query->execute(array(':user_id' =>$user_id));
        $supervisor=$query->fetch();
        if ($supervisor) {
            return $supervisor->first_name.' '.$supervisor->last_name;
        }else{
            return '';
        }
    }

    public function createUser(){
        $sql="INSERT INTO users(username,password,first_name,last_name,role) VALUES (:username,:password,:first_name,:last_name,:role)";
        $query = $this->db->prepare($sql);
        $parameters=array(':username' => $_POST['username'],
                      ':password' => $_POST['password'],
                      ':first_name' => $_POST['first_name'],
                      ':last_name' => $_POST['last_name'],
                      ':role' => $_POST['role'],
                        );
        if($query->execute($parameters)){
            $_SESSION['create_user']='success';
        } else {
            $_SESSION['create_user']='fail';
        }
        header("location:".URL.$_SESSION['role'].'/users');
    }

    public function editUser($user_id){
        $sql="UPDATE users SET username=:username,password=:password,first_name=:first_name,last_name=:last_name,role=:role,supervisor=:supervisor_id WHERE user_id=:user_id";
        $query = $this->db->prepare($sql);
        $parameters=array(':username' => $_POST['username'],
                      ':password' => $_POST['password'],
                      ':first_name' => $_POST['first_name'],
                      ':last_name' => $_POST['last_name'],
                      ':role' => $_POST['role'],
                      ':supervisor_id' => $_POST['supervisor'],
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
    public function getContractsBySupervisor($supervisor_id){
        $page=(int)(isset($_GET['page'])? $_GET['page']:0);
        $limiter=30;
        $pager=$limiter*$page;
        $sql='SELECT * FROM contracts WHERE supervisor=:supervisor LIMIT :pager, :limiter ';
        $query = $this->db->prepare($sql);
        $query->bindParam(':pager', $pager, PDO::PARAM_INT);
        $query->bindParam(':limiter', $limiter, PDO::PARAM_INT);
        $query->bindParam(':supervisor', $supervisor, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();
    }

    public function getContractById($contract_id ){
        $sql='SELECT * FROM contracts INNER JOIN status ON contracts.status = status.status_id WHERE contract_id=:contract_id ';
        $query = $this->db->prepare($sql);
        $query->execute(array(':contract_id'=>$contract_id));
        return $query->fetch();
    }
///////////////////////////////////////////////////////////////////
    public function getStatuses(){
        $sql='SELECT * FROM status';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function createStatus(){
        if ($_POST['status_name']=='') {
            $_SESSION['create_status']='fail';
            header("location:".URL.$_SESSION['role'].'/statuses');
            return;
        }
        $sql="INSERT INTO status(status_name,status_description) VALUES (:status_name,:status_description)";
        $query = $this->db->prepare($sql);
        $parameters=array(
                      ':status_name' => $_POST['status_name'],
                      ':status_description' => $_POST['status_description'],
                        );
        if($query->execute($parameters)){
            $_SESSION['create_status']='success';
        } else {
            $_SESSION['create_status']='fail';
        }
        header("location:".URL.$_SESSION['role'].'/statuses');
    }

    public function editStatus($status_id){
        $sql="UPDATE status SET status_name=:status_name,status_description=:status_description WHERE status_id=:status_id";
        $query = $this->db->prepare($sql);
        $parameters=array(
                      ':status_name' => $_POST['status_name'],
                      ':status_description' => $_POST['status_description'],
                      ':status_id' => $status_id
                        );
        if($query->execute($parameters)){
            $_SESSION['edit_status']='success';
        } else {
            $_SESSION['edit_status']='fail';
        }
        header("Location:".URL.$_SESSION['role'].'/statuses');
    }

    public function getStatus($status_id){
        $sql="SELECT * FROM status WHERE status_id=:status_id";
        $query=$this->db->prepare($sql);
        $query->execute(array(':status_id' => $status_id));
        return $query->fetch();
    } 

    public function deleteStatus($status_id){
        if ($status_id==1) {
            $_SESSION['delete_status']='fail';
            header("location:".URL.$_SESSION['role'].'/statuses');
            return;
        }
        $sql="DELETE FROM status WHERE status_id=:status_id";
        $query = $this->db->prepare($sql); 
        if($query->execute(array(':status_id' => $status_id))){
            $_SESSION['delete_status']='success';
        } else {
            $_SESSION['delete_status']='fail';
        }
        header("location:".URL.$_SESSION['role'].'/statuses');
    }


//////////////////////////////////////////////////////////////////////
    public function createCampaign(){
        if ($_POST['campaign_name']=='') {
            $_SESSION['campaign_status']='fail';
            header("location:".URL.$_SESSION['role'].'/campaigns');
            return;
        }
        $sql="INSERT INTO campaigns(campaign_name,campaign_description) VALUES (:campaign_name,:campaign_description)";
        $query = $this->db->prepare($sql);
        $parameters=array(
                      ':campaign_name' => $_POST['campaign_name'],
                      ':campaign_description' => $_POST['campaign_description'],
                        );
        if($query->execute($parameters)){
            $_SESSION['create_campaign']='success';
        } else {
            $_SESSION['create_campaign']='fail';
        }
        header("location:".URL.$_SESSION['role'].'/campaigns');
    }

    public function editCampaign($campaign_id){
        $sql="UPDATE campaigns SET campaign_name=:campaign_name,campaign_description=:campaign_description WHERE campaign_id=:campaign_id";
        $query = $this->db->prepare($sql);
        $parameters=array(
                      ':campaign_name' => $_POST['campaign_name'],
                      ':campaign_description' => $_POST['campaign_description'],
                      ':campaign_id' => $campaign_id
                        );
        if($query->execute($parameters)){
            $_SESSION['edit_campaign']='success';
        } else {
            $_SESSION['edit_campaign']='fail';
        }
        header("Location:".URL.$_SESSION['role'].'/campaigns');
    }

    public function getCampaign($campaign_id){
        $sql="SELECT * FROM campaigns WHERE campaign_id=:campaign_id";
        $query=$this->db->prepare($sql);
        $query->execute(array(':campaign_id' => $campaign_id));
        return $query->fetch();
    } 

    public function deleteCampaign($campaign_id){
        if ($campaign_id==1) {
            $_SESSION['delete_campaign']='fail';
            header("location:".URL.$_SESSION['role'].'/campaigns');
            return;
        }
        $sql="DELETE FROM campaigns WHERE campaign_id=:campaign_id";
        $query = $this->db->prepare($sql); 
        if($query->execute(array(':campaign_id' => $campaign_id))){
            $_SESSION['delete_campaign']='success';
        } else {
            $_SESSION['delete_campaign']='fail';
        }
        header("location:".URL.$_SESSION['role'].'/campaigns');
    }

    public function getCampaigns(){
        $sql='SELECT * FROM campaigns';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

////////////////////////////////////////////////////
    public function getWorkhours($user_id,$date=null){
        if (!$date) {
           $date=date('Y-m');
        }
        $date.='-01';
        $sql = "SELECT SUM(hours) as totalhours FROM workhours where `workhours`.user_id='$user_id' and MONTH(`workhours`.`date`) =MONTH('$date') and YEAR(`workhours`.`date`) =YEAR('$date')";
        $query = $this->db->prepare($sql);
        $query->execute();
        $workhours=$query->fetch();
        $workhours=$workhours->totalhours;
        if (!$workhours) {
            $workhours=0;
        }
        return $workhours;
    }

    public function getContracts($export=null){
        $page         = (int)(isset($_REQUEST['page'])? $_REQUEST['page']:0);
        $contract_type= (isset($_REQUEST['contract_type'])?$_REQUEST['contract_type']:'%');
        $operator     = (isset($_REQUEST['operator'])?$_REQUEST['operator']:'%');
        $date         = (isset($_REQUEST['date'])?$_REQUEST['date']:'');
        $client_name  = (isset($_REQUEST['client_name'])?$_REQUEST['client_name']:'');
        $status       = (isset($_REQUEST['status'])?$_REQUEST['status']:'%');
        $campaign     = (isset($_REQUEST['campaign'])?$_REQUEST['campaign']:'%');
        $supervisor     = (isset($_REQUEST['supervisor'])?$_REQUEST['supervisor']:'%');
        $phone        = (isset($_REQUEST['phone'])?$_REQUEST['phone']:'%');
        $codice_fiscale= (isset($_REQUEST['codice_fiscale'])?$_REQUEST['codice_fiscale']:'%');
        $limiter      = 30;
        $pager        = $limiter*$page;
       
        /////////////////////////if is set id////////////////////////////
        if (isset($_REQUEST['id'])) {
        	if ($_REQUEST['id']!='') {
        		$_REQUEST['client_name']='';
        		$_REQUEST['operator']='%';
                $_REQUEST['phone']='%';
        		$_REQUEST['status']='%';
                $_REQUEST['campaign']='%';
                $_REQUEST['supervisor']='%';
        		$_REQUEST['date']='';
        		$_REQUEST['contract_type']='%';
                $_REQUEST['codice_fiscale']='%';
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
        
		//////////////////////////--////////////////////////////////
        if ($codice_fiscale==''){$codice_fiscale='%';}else {$codice_fiscale.='%';};
        if ($phone==''){$phone='%';};
        ////////////////////////////////////////////////////////////////////

        $sql="SELECT * FROM contracts 
        		WHERE contract_type LIKE :contract_type 
        			AND  operator LIKE :operator 
        			AND (   DATE(`date`) >= DATE(:date1) 
                        AND 
                            DATE(`date`) <= DATE(:date2)
                        ) 
        			AND ( 
                            (first_name LIKE :first_name AND last_name LIKE :last_name) 
        				OR
                            (first_name LIKE :last_name AND last_name LIKE :first_name)
                        ) 
        			AND status LIKE :status  
                    AND (   (tel_number LIKE :phone)
                        OR  (alt_number LIKE :phone)
                        OR  (cel_number LIKE :phone)
                        OR  (cel_number2 LIKE :phone)
                        OR  (cel_number3 LIKE :phone)
                        )
                    AND vat_number LIKE :codice_fiscale
                    AND campaign LIKE :campaign
                    AND supervisor LIKE :supervisor
                ORDER BY contract_id DESC ";

        if (!$export) {
            $sql.=" LIMIT :pager , :limiter";
            $query = $this->db->prepare($sql);
            $query->bindParam(':pager', $pager, PDO::PARAM_INT);
            $query->bindParam(':limiter', $limiter, PDO::PARAM_INT);
        }else{
            $query = $this->db->prepare($sql);
        }

        $query->bindParam(':contract_type', $contract_type);
        $query->bindParam(':operator', $operator);
        $query->bindParam(':date1', $date1);
        $query->bindParam(':date2', $date2);
      	$query->bindParam(':first_name', $first_name);
        $query->bindParam(':last_name', $last_name);
        $query->bindParam(':status', $status);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':codice_fiscale', $codice_fiscale);
        $query->bindParam(':campaign', $campaign);
        $query->bindParam(':supervisor', $supervisor);
        $query->execute();

        if (!$export) {
            return $query->fetchAll();
        }else{
            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename=contracts_export_'.date('Y-m-d').'_'.substr(str_shuffle(str_repeat($x='0987654321poiuytrewqlkjhgfdsamnbvcxz',ceil(8/strlen($x)) )),1,8).'.csv');
            $contracts=$query->fetchAll();
            $statuses=$this->getStatuses();
            $operators=$this->getUsersByRole('operator');
            $supervisors=$this->getUsersByRole('supervisor');
            $campaigns=$this->getCampaigns();
            //set header
            $header=array();
            foreach ((array)$contracts[0] as $key => $value) {
                array_push($header,$key);
            }

            //loop on contracts
            $output=fopen("php://output","w");
            fputcsv($output,$header);
            //print_r($header);
            if (isset($_REQUEST['id'])) {
                if ($_REQUEST['id']!='') {
                    $sql="SELECT * FROM contracts WHERE contract_id =:id";
                    $query = $this->db->prepare($sql);
                    $query->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                    $query->execute();
                    $contracts=$query->fetchAll();
                }
            }
            foreach ($contracts as $contract) {
                $row=array();
                foreach ($contract as $key => $value) {
                    switch ($key) {
                        case 'status':
                           foreach ($statuses as $status) {
                                if ($value==$status->status_id) {
                                    $value=$status->status_name;
                                }
                            }
                            break;
                        case 'operator':
                            foreach ($operators as $operator) {
                                if ($value==$operator->user_id) {
                                    $value=$operator->first_name.' '.$operator->last_name;
                                }
                            }
                            break;
                        case 'supervisor':
                            foreach ($supervisors as $supervisor) {
                                if ($value==$supervisor->user_id) {
                                    $value=$supervisor->first_name.' '.$supervisor->last_name;
                                }
                            }
                            break;
                        case 'campaign':
                            foreach ($campaigns as $campaign) {
                                if ($value==$campaign->campaign_id) {
                                    $value=$campaign->campaign_name;
                                }
                            }
                            break;
                        
                        default:
                            $value=($value=='true')?'Si':$value;
                            $value=($value=='false')?'No':$value;
                            break;
                    } 

                    if ($value!=null) {
                        array_push($row,$value);
                    }
                }
                fputcsv($output,$row);
            }
          // print_r($output);
        }//export else end 
    }

        public function createContract(){
            switch ($_POST['contract_type']) {
                case 'dual':
                    $sql="SELECT contract_id FROM contracts WHERE gas_pdr=:gas_pdr OR luce_pod=:luce_pod";
                    $query = $this->db->prepare($sql);
                    $query->execute(array(':gas_pdr' =>$_POST['gas_pdr'],':luce_pod'=>$_POST['luce_pod']));
                    break;
                case 'luce':
                    $sql="SELECT contract_id  FROM contracts WHERE luce_pod=:luce_pod ";
                    $query = $this->db->prepare($sql);
                    $query->execute(array(':luce_pod'=>$_POST['luce_pod']));
                    break;
                case 'gas':
                    $sql="SELECT contract_id  FROM contracts WHERE gas_pdr=:gas_pdr OR luce_pod=:gas_pdr";
                    $query = $this->db->prepare($sql);
                    $query->execute(array(':gas_pdr' => $_POST['gas_pdr']));
                    break;
                default:
                    break;
            }
            if ($query->rowCount()>0) {
                $_SESSION['contract_exist']='true';
                header("location:".URL.$_SESSION['role'].'/contracts');
                return;
            }
        
            $sql="INSERT INTO contracts
                                (`date`,
                                    operator,
                                supervisor,
                                campaign,
                                ugm_cb,
                                analisi_cb,
                                iniziative_cb,

                    tel_number,
                    alt_number,
                    cel_number,
                    cel_number2,
                    cel_number3,
                    email,
                    alt_email,

                    client_type,
                    gender,
                    rag_sociale,
                    first_name,
                    last_name,
                    vat_number,
                    partita_iva,
                    birth_date,

                    birth_nation,
                    birth_municipality,
                    document_type,
                    document_number,
                    document_date,

                    toponimo,
                    address,
                    civico,
                    price,
                    location,

                    uf_toponimo,
                    uf_address,
                    uf_civico,
                    uf_price,
                    uf_location,

                    ddf_toponimo,
                    ddf_address,
                    ddf_civico,
                    ddf_price,
                    ddf_location,

                    ubicazione_fornitura,
                    domicillazione_documenti_fatture,
                     contract_type,
                     listino,

                    gas_request_type,
                    gas_pdr,
                    gas_fornitore_uscente,
                    gas_consume_annuo,
                    gas_tipo_riscaldamento,
                    gas_tipo_cottura_acqua,
                    gas_remi,
                    gas_matricola,

                    luce_request_type,
                    luce_pod,
                    luce_tensione,
                    luce_potenza,
                    luce_fornitore_uscente,
                    luce_opzione_oraria,
                    luce_consume_annuo,

                    fature_via_email,

                    payment_type,
                    iban_code,
                    iban_accounthoder,
                    iban_fiscal_code,
                    note,
                    status,

                    delega_first_name,
                    delega_last_name,
                    delega_vat_number
                                ) 
                                VALUES
                                (:date,
                                    :operator,
                                :supervisor,
                                :campaign,
                                :ugm_cb,
                                :analisi_cb,
                                :iniziative_cb,

                    :tel_number,
                    :alt_number,
                    :cel_number,
                    :cel_number2,
                    :cel_number3,
                    :email,
                    :alt_email,

                    :client_type,
                    :gender,
                    :rag_sociale,
                    :first_name,
                    :last_name,
                    :vat_number,
                    :partita_iva,

                    :birth_date,
                    :birth_nation,
                    :birth_municipality,
                    :document_type,
                    :document_number,
                    :document_date,

                    :toponimo,
                    :address,
                    :civico,
                    :price,
                    :location,

                    :uf_toponimo,
                    :uf_address,
                    :uf_civico,
                    :uf_price,
                    :uf_location,

                    :ddf_toponimo,
                    :ddf_address,
                    :ddf_civico,
                    :ddf_price,
                    :ddf_location,

                    :ubicazione_fornitura,
                    :domicillazione_documenti_fatture,
                     :contract_type,
                     :listino,

                    :gas_request_type,
                    :gas_pdr,
                    :gas_fornitore_uscente,
                    :gas_consume_annuo,
                    :gas_tipo_riscaldamento,
                    :gas_tipo_cottura_acqua,
                    :gas_remi,
                    :gas_matricola,

                    :luce_request_type,
                    :luce_pod,
                    :luce_tensione,
                    :luce_potenza,
                    :luce_fornitore_uscente,
                    :luce_opzione_oraria,
                    :luce_consume_annuo,

                    :fature_via_email,

                    :payment_type,
                    :iban_code,
                    :iban_accounthoder,
                    :iban_fiscal_code,
                    :note,
                    :status,

                    :delega_first_name,
                    :delega_last_name,
                    :delega_vat_number
                )";

                $query = $this->db->prepare($sql);
                $query->bindParam(':date', $_POST['date']);
                $query->bindParam(':operator', $_POST['operator'], PDO::PARAM_INT);
                $query->bindParam(':supervisor', $_POST['supervisor'],PDO::PARAM_INT);
                $query->bindParam(':campaign', $_POST['campaign'],PDO::PARAM_INT);
                $query->bindValue(':status','1',PDO::PARAM_INT);

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

                if ($_POST['ubicazione_fornitura']=='non_resident') {
                    $query->bindParam(':uf_toponimo', $_POST['uf_toponimo']);
                    $query->bindParam(':uf_address', $_POST['uf_address']);
                    $query->bindParam(':uf_civico', $_POST['uf_civico']);
                    $query->bindParam(':uf_price', $_POST['uf_price']);
                    $query->bindParam(':uf_location', $_POST['uf_location']);
                }else{
                    $query->bindValue(':uf_toponimo','');
                    $query->bindValue(':uf_address', '');
                    $query->bindValue(':uf_civico', '');
                    $query->bindValue(':uf_price', '');
                    $query->bindValue(':uf_location', ''); 
                }

                if ($_POST['domicillazione_documenti_fatture']=='altro') {
                    $query->bindParam(':ddf_toponimo', $_POST['ddf_toponimo']);
                    $query->bindParam(':ddf_address', $_POST['ddf_address']);
                    $query->bindParam(':ddf_civico', $_POST['ddf_civico']);
                    $query->bindParam(':ddf_price', $_POST['ddf_price']);
                    $query->bindParam(':ddf_location', $_POST['ddf_location']);
                }else{
                    $query->bindValue(':ddf_toponimo','');
                    $query->bindValue(':ddf_address', '');
                    $query->bindValue(':ddf_civico', '');
                    $query->bindValue(':ddf_price', '');
                    $query->bindValue(':ddf_location', ''); 
                }

                $query->bindParam(':ubicazione_fornitura', $_POST['ubicazione_fornitura']);
                $query->bindParam(':domicillazione_documenti_fatture', $_POST['domicillazione_documenti_fatture']);
                $query->bindParam(':contract_type', $_POST['contract_type']);
                $query->bindParam(':listino', $_POST['listino']);

                if ($_POST['contract_type']=='dual') {

                    $query->bindParam(':luce_request_type',$_POST['luce_request_type']);
                    $query->bindParam(':luce_pod',$_POST['luce_pod']);
                    $query->bindParam(':luce_fornitore_uscente',$_POST['luce_fornitore_uscente']);
                    $query->bindParam(':luce_opzione_oraria',$_POST['luce_opzione_oraria']);
                    $query->bindParam(':luce_potenza',$_POST['luce_potenza']);
                    $query->bindParam(':luce_tensione',$_POST['luce_tensione']); 
                    $query->bindValue(':luce_consume_annuo',$_POST['luce_consume_annuo']); 

                    $query->bindParam(':gas_request_type', $_POST['gas_request_type']);
                    $query->bindParam(':gas_pdr', $_POST['gas_pdr']);
                    $query->bindParam(':gas_fornitore_uscente', $_POST['gas_fornitore_uscente']);
                    $query->bindParam(':gas_consume_annuo', $_POST['gas_consume_annuo']);
                    $query->bindValue(':gas_tipo_riscaldamento',(isset($_POST['gas_tipo_riscaldamento'])?$_POST['gas_tipo_riscaldamento']:'false'));
                    $query->bindValue(':gas_tipo_cottura_acqua',(isset($_POST['gas_tipo_cottura_acqua'])?$_POST['gas_tipo_cottura_acqua']:'false')); 
                    $query->bindParam(':gas_remi', $_POST['gas_remi']);
                    $query->bindParam(':gas_matricola', $_POST['gas_matricola']);


                }elseif ($_POST['contract_type']=='gas') {

                    $query->bindParam(':gas_request_type', $_POST['gas_request_type']);
                    $query->bindParam(':gas_pdr', $_POST['gas_pdr']);
                    $query->bindParam(':gas_fornitore_uscente', $_POST['gas_fornitore_uscente']);
                    $query->bindParam(':gas_consume_annuo', $_POST['gas_consume_annuo']);
                    $query->bindValue(':gas_tipo_riscaldamento',(isset($_POST['gas_tipo_riscaldamento'])?$_POST['gas_tipo_riscaldamento']:'false'));
                    $query->bindValue(':gas_tipo_cottura_acqua',(isset($_POST['gas_tipo_cottura_acqua'])?$_POST['gas_tipo_cottura_acqua']:'false')); 
                    $query->bindParam(':gas_remi', $_POST['gas_remi']);
                    $query->bindParam(':gas_matricola', $_POST['gas_matricola']);

                    $query->bindValue(':luce_request_type','');
                    $query->bindValue(':luce_pod','');
                    $query->bindValue(':luce_fornitore_uscente','');
                    $query->bindValue(':luce_opzione_oraria', '');
                    $query->bindValue(':luce_potenza','');
                    $query->bindValue(':luce_tensione',''); 
                    $query->bindValue(':luce_consume_annuo',''); 

                }elseif ($_POST['contract_type']=='luce') {

                    $query->bindParam(':luce_request_type',$_POST['luce_request_type']);
                    $query->bindParam(':luce_pod',$_POST['luce_pod']);
                    $query->bindParam(':luce_fornitore_uscente',$_POST['luce_fornitore_uscente']);
                    $query->bindParam(':luce_opzione_oraria',$_POST['luce_opzione_oraria']);
                    $query->bindParam(':luce_potenza',$_POST['luce_potenza']);
                    $query->bindParam(':luce_tensione',$_POST['luce_tensione']); 
                    $query->bindValue(':luce_consume_annuo',$_POST['luce_consume_annuo']); 

                    $query->bindValue(':gas_request_type','');
                    $query->bindValue(':gas_pdr','');
                    $query->bindValue(':gas_fornitore_uscente','');
                    $query->bindValue(':gas_consume_annuo', '');
                    $query->bindValue(':gas_tipo_riscaldamento','');
                    $query->bindValue(':gas_tipo_cottura_acqua',''); 
                    $query->bindValue(':gas_remi', '');
                    $query->bindValue(':gas_matricola','');
                }

                if ($_POST['client_type']=='delega') {
                    $query->bindParam(':delega_first_name', $_POST['delega_first_name']);
                    $query->bindParam(':delega_last_name', $_POST['delega_last_name']);
                    $query->bindParam(':delega_vat_number', $_POST['delega_vat_number']);
                } else{
                    $query->bindValue(':delega_first_name','');
                    $query->bindValue(':delega_last_name','');
                    $query->bindValue(':delega_vat_number','');
                }


                $query->bindValue(':fature_via_email',(isset($_POST['fature_via_email'])?$_POST['fature_via_email']:'false'));
               
                $query->bindParam(':payment_type', $_POST['payment_type']);
                $query->bindParam(':iban_code', $_POST['iban_code']);
                $query->bindParam(':iban_accounthoder', $_POST['iban_accounthoder']);
                $query->bindParam(':iban_fiscal_code', $_POST['iban_fiscal_code']);
                $query->bindParam(':note', $_POST['note']);

                //error handler
                if ($query->execute()) {
                    header('location: viewContract/'.$this->db->lastInsertId());  
                    $_SESSION['create_contract']='success';   
                } else {
                    $_SESSION['create_contract']='fail';
                    header("location:".URL.$_SESSION['role'].'/contracts');
                }
        }


    public function editContract($contract_id){
        $sql="UPDATE contracts SET `date`=:date,
operator=:operator,
supervisor=:supervisor,
campaign=:campaign,
ugm_cb=:ugm_cb,
analisi_cb=:analisi_cb,
iniziative_cb=:iniziative_cb, 
tel_number=:tel_number,
alt_number=:alt_number,
cel_number=:cel_number,
cel_number2=:cel_number2,
cel_number3=:cel_number3,
email=:email,
alt_email=:alt_email,
client_type=:client_type,
gender=:gender,
rag_sociale=:rag_sociale,
first_name=:first_name,
last_name=:last_name,
vat_number=:vat_number,
partita_iva=:partita_iva,
birth_date=:birth_date,
birth_nation=:birth_nation,
birth_municipality=:birth_municipality,
document_type=:document_type,
document_number=:document_number,
document_date=:document_date,
toponimo=:toponimo,
address=:address,
civico=:civico,
price=:price,
location=:location,
uf_toponimo=:uf_toponimo,
uf_address=:uf_address,
uf_civico=:uf_civico,
uf_price=:uf_price,
uf_location=:uf_location,
ddf_toponimo=:ddf_toponimo,
ddf_address=:ddf_address,
ddf_civico=:ddf_civico,
ddf_price=:ddf_price,
ddf_location=:ddf_location,
ubicazione_fornitura=:ubicazione_fornitura,
domicillazione_documenti_fatture=:domicillazione_documenti_fatture,
contract_type=:contract_type,
listino=:listino,
gas_request_type=:gas_request_type,
gas_pdr=:gas_pdr,
gas_fornitore_uscente=:gas_fornitore_uscente,
gas_consume_annuo=:gas_consume_annuo,
gas_tipo_riscaldamento=:gas_consume_annuo,
gas_tipo_cottura_acqua=:gas_tipo_cottura_acqua,
gas_remi=:gas_remi,
gas_matricola=:gas_matricola,
luce_request_type=:luce_request_type,
luce_pod=:luce_pod,
luce_tensione=:luce_tensione,
luce_potenza=:luce_potenza,
luce_fornitore_uscente=:luce_fornitore_uscente,
luce_opzione_oraria=:luce_opzione_oraria,
luce_consume_annuo=:luce_consume_annuo,
fature_via_email=:fature_via_email,
payment_type=:payment_type,
iban_code=:iban_code,
iban_accounthoder=:iban_accounthoder,
iban_fiscal_code=:iban_fiscal_code,
note=:note,
status=:status,
delega_first_name=:delega_first_name,
delega_last_name=:delega_last_name,
delega_vat_number=:delega_vat_number WHERE contract_id=:contract_id";
            
                $query = $this->db->prepare($sql);
                $query->bindParam(':date', $_POST['date']);
                $query->bindParam(':operator', $_POST['operator'], PDO::PARAM_INT);
                $query->bindParam(':supervisor', $_POST['supervisor'],PDO::PARAM_INT);
                $query->bindParam(':campaign', $_POST['campaign'],PDO::PARAM_INT);
                $query->bindParam(':status',$_POST['status'],PDO::PARAM_INT);

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

                if ($_POST['ubicazione_fornitura']=='non_resident') {
                    $query->bindParam(':uf_toponimo', $_POST['uf_toponimo']);
                    $query->bindParam(':uf_address', $_POST['uf_address']);
                    $query->bindParam(':uf_civico', $_POST['uf_civico']);
                    $query->bindParam(':uf_price', $_POST['uf_price']);
                    $query->bindParam(':uf_location', $_POST['uf_location']);
                }else{
                    $query->bindValue(':uf_toponimo','');
                    $query->bindValue(':uf_address', '');
                    $query->bindValue(':uf_civico', '');
                    $query->bindValue(':uf_price', '');
                    $query->bindValue(':uf_location', ''); 
                }

                if ($_POST['domicillazione_documenti_fatture']=='altro') {
                    $query->bindParam(':ddf_toponimo', $_POST['ddf_toponimo']);
                    $query->bindParam(':ddf_address', $_POST['ddf_address']);
                    $query->bindParam(':ddf_civico', $_POST['ddf_civico']);
                    $query->bindParam(':ddf_price', $_POST['ddf_price']);
                    $query->bindParam(':ddf_location', $_POST['ddf_location']);
                }else{
                    $query->bindValue(':ddf_toponimo','');
                    $query->bindValue(':ddf_address', '');
                    $query->bindValue(':ddf_civico', '');
                    $query->bindValue(':ddf_price', '');
                    $query->bindValue(':ddf_location', ''); 
                }

                $query->bindParam(':ubicazione_fornitura', $_POST['ubicazione_fornitura']);
                $query->bindParam(':domicillazione_documenti_fatture', $_POST['domicillazione_documenti_fatture']);
                $query->bindParam(':contract_type', $_POST['contract_type']);
                $query->bindParam(':listino', $_POST['listino']);

                if ($_POST['contract_type']=='dual') {

                    $query->bindParam(':luce_request_type',$_POST['luce_request_type']);
                    $query->bindParam(':luce_pod',$_POST['luce_pod']);
                    $query->bindParam(':luce_fornitore_uscente',$_POST['luce_fornitore_uscente']);
                    $query->bindParam(':luce_opzione_oraria',$_POST['luce_opzione_oraria']);
                    $query->bindParam(':luce_potenza',$_POST['luce_potenza']);
                    $query->bindParam(':luce_tensione',$_POST['luce_tensione']); 
                    $query->bindValue(':luce_consume_annuo',$_POST['luce_consume_annuo']); 

                    $query->bindParam(':gas_request_type', $_POST['gas_request_type']);
                    $query->bindParam(':gas_pdr', $_POST['gas_pdr']);
                    $query->bindParam(':gas_fornitore_uscente', $_POST['gas_fornitore_uscente']);
                    $query->bindParam(':gas_consume_annuo', $_POST['gas_consume_annuo']);
                    $query->bindValue(':gas_tipo_riscaldamento',(isset($_POST['gas_tipo_riscaldamento'])?$_POST['gas_tipo_riscaldamento']:'false'));
                    $query->bindValue(':gas_tipo_cottura_acqua',(isset($_POST['gas_tipo_cottura_acqua'])?$_POST['gas_tipo_cottura_acqua']:'false')); 
                    $query->bindParam(':gas_remi', $_POST['gas_remi']);
                    $query->bindParam(':gas_matricola', $_POST['gas_matricola']);


                }elseif ($_POST['contract_type']=='gas') {

                    $query->bindParam(':gas_request_type', $_POST['gas_request_type']);
                    $query->bindParam(':gas_pdr', $_POST['gas_pdr']);
                    $query->bindParam(':gas_fornitore_uscente', $_POST['gas_fornitore_uscente']);
                    $query->bindParam(':gas_consume_annuo', $_POST['gas_consume_annuo']);
                    $query->bindValue(':gas_tipo_riscaldamento',(isset($_POST['gas_tipo_riscaldamento'])?$_POST['gas_tipo_riscaldamento']:'false'));
                    $query->bindValue(':gas_tipo_cottura_acqua',(isset($_POST['gas_tipo_cottura_acqua'])?$_POST['gas_tipo_cottura_acqua']:'false')); 
                    $query->bindParam(':gas_remi', $_POST['gas_remi']);
                    $query->bindParam(':gas_matricola', $_POST['gas_matricola']);

                    $query->bindValue(':luce_request_type','');
                    $query->bindValue(':luce_pod','');
                    $query->bindValue(':luce_fornitore_uscente','');
                    $query->bindValue(':luce_opzione_oraria', '');
                    $query->bindValue(':luce_potenza','');
                    $query->bindValue(':luce_tensione',''); 
                    $query->bindValue(':luce_consume_annuo',''); 

                }elseif ($_POST['contract_type']=='luce') {

                    $query->bindParam(':luce_request_type',$_POST['luce_request_type']);
                    $query->bindParam(':luce_pod',$_POST['luce_pod']);
                    $query->bindParam(':luce_fornitore_uscente',$_POST['luce_fornitore_uscente']);
                    $query->bindParam(':luce_opzione_oraria',$_POST['luce_opzione_oraria']);
                    $query->bindParam(':luce_potenza',$_POST['luce_potenza']);
                    $query->bindParam(':luce_tensione',$_POST['luce_tensione']); 
                    $query->bindValue(':luce_consume_annuo',$_POST['luce_consume_annuo']); 

                    $query->bindValue(':gas_request_type','');
                    $query->bindValue(':gas_pdr','');
                    $query->bindValue(':gas_fornitore_uscente','');
                    $query->bindValue(':gas_consume_annuo', '');
                    $query->bindValue(':gas_tipo_riscaldamento','');
                    $query->bindValue(':gas_tipo_cottura_acqua',''); 
                    $query->bindValue(':gas_remi', '');
                    $query->bindValue(':gas_matricola','');
                }

                if ($_POST['client_type']=='delega') {
                    $query->bindParam(':delega_first_name', $_POST['delega_first_name']);
                    $query->bindParam(':delega_last_name', $_POST['delega_last_name']);
                    $query->bindParam(':delega_vat_number', $_POST['delega_vat_number']);
                } else{
                    $query->bindValue(':delega_first_name','');
                    $query->bindValue(':delega_last_name','');
                    $query->bindValue(':delega_vat_number','');
                }


                $query->bindValue(':fature_via_email',(isset($_POST['fature_via_email'])?$_POST['fature_via_email']:'false'));
               
                $query->bindParam(':payment_type', $_POST['payment_type']);
                $query->bindParam(':iban_code', $_POST['iban_code']);
                $query->bindParam(':iban_accounthoder', $_POST['iban_accounthoder']);
                $query->bindParam(':iban_fiscal_code', $_POST['iban_fiscal_code']);
                $query->bindParam(':note', $_POST['note']);


        $query->bindParam(':contract_id',$contract_id,PDO::PARAM_INT);

        //error handler
        if ($query->execute()) {
            header('location: ../viewContract/'.$contract_id); 
            $_SESSION['edit_contract']='success';     
        } else {
            //$_SESSION['edit_contract']='success'; 
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

