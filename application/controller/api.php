<?php
if(!isset($_SESSION['username'])){ header('Location:'.URL); return; };

/**
 * //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit(); debug sql
 */
class api extends Controller
{


    public function index()
    {
        echo "api v1";
    }

    public function ApigetUsersBySupervisor($supervisor){
        $sql="SELECT CONCAT_WS(' ',first_name,last_name) AS full_name,user_id FROM users where role='operator' AND supervisor = :supervisor";
        $query=$this->db->prepare($sql);
        $query->execute(array(':supervisor' =>$supervisor));
        echo json_encode($query->fetchAll());
    }

    public function getSupervisors(){
        $sql="SELECT CONCAT_WS(' ',first_name,last_name) AS full_name,user_id FROM users where role='supervisor' ";
        $query=$this->db->prepare($sql);
        $query->execute();
        echo json_encode($query->fetchAll());
    }
    public function showStats($user_id,$date){
      $statuses=$this->model->getStatuses();
      $user_stat=array();
      foreach ($statuses as $status) {
        array_push($user_stat,array($status->status_name=>$this->model->getContractsNumberByStatus($user_id,$date,$status->status_id)));
      }
      echo json_encode($user_stat); //echo data json
    }

    public function getWorkhours(){
      $user_id=$_POST['user_id'];
      $date=$_POST['date'];
      $output=array();
      $sql = "SELECT * FROM workhours WHERE user_id='$user_id' and MONTH(`date`) = MONTH('$date') and YEAR(`date`) = YEAR('$date')  order by `workhours_id` desc";
      $query = $this->db->prepare($sql);
      $query->execute();
        while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
            array_push($output, $row);
        }
        header('Content-type: application/json');
        echo json_encode($output); //echo data json
    }

    public function addHours(){
        //print_r($_POST);
        $sql = "INSERT INTO workhours(user_id,hours,`date`) VALUES(:user_id,:hours,:date)";
        $query = $this->db->prepare($sql);
        $query->bindParam(':user_id', $_POST['user_id'],PDO::PARAM_INT);
        $query->bindParam(':date', $_POST['date']);
        $query->bindParam(':hours', $_POST['hours'],PDO::PARAM_INT);
        if ($query->execute()) {
           echo "success";
        }else{
            echo "error";
        }
    }
    public function deleteHours(){
        //if($_SESSION['role']!='backoffice' || $_SESSION['role']!='admin') { header('Location:'.URL); return; };
        $sql = "DELETE FROM workhours WHERE workhours_id=:workhours_id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':workhours_id', $_POST['workhours_id'],PDO::PARAM_INT);
        if ($query->execute()) {
           echo "success";
        }else{
            echo "error";
        }
    }
    public function deleteAudio(){
        //if($_SESSION['role']!='backoffice' || $_SESSION['role']!='admin') { header('Location:'.URL); return; };
        $file = APP."audios/".$_POST['url'];
        $sql = "DELETE FROM audios WHERE audio_id=:audio_id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':audio_id', $_POST['audio_id'],PDO::PARAM_INT);
        if ($query->execute()) {
           echo "success";
           unlink($file);
        }else{
            echo "error";
        }
    }
    public function deleteDocument(){
        //if($_SESSION['role']!='backoffice' || $_SESSION['role']!='admin') { header('Location:'.URL); return; };
        $file = APP."documents/".$_POST['url'];
        $sql = "DELETE FROM documents WHERE document_id=:document_id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':document_id', $_POST['document_id'],PDO::PARAM_INT);
        if ($query->execute()) {
           echo "success";
           unlink($file);
        }else{
            echo "error";
        }
    }

    public function bulkUpdateStatuses(){
       //print_r($_SESSION);
        $sql = "UPDATE contracts SET status=status_temp WHERE status_temp!='' ";
        $query = $this->db->prepare($sql);
        if ($query->execute()) {
                $sql2 = "UPDATE contracts SET status_temp='' WHERE status_temp!='' ";
                $query2 = $this->db->prepare($sql2);
                $query2->execute();

            $sqlnote = "UPDATE contracts SET note=note_temp WHERE note_temp!='' ";
            $querynote = $this->db->prepare($sqlnote);
            if ($querynote->execute()) {
                $sqlnote2 = "UPDATE contracts SET note_temp='' WHERE note_temp!='' ";
                $querynote2 = $this->db->prepare($sqlnote2);
                $querynote2->execute();
            }


            $last_status_update = date("d-m-Y H:i:s"); ;
            $var_str = var_export($last_status_update, true);
            $var = "<?php\n\n\$last_status_update = $var_str;\n\n?>";
            file_put_contents('last_status_update.php', $var);
            //echo "success";
            $_SESSION['update_statuses']='success';
            header("location:".URL.$_SESSION['role'].'/statuses/');

        }else {
            $_SESSION['update_statuses']='false';
            header("location:".URL.$_SESSION['role'].'/statuses/');
        }
         //print_r($_SESSION);

    }

    public function editContractStatus(){
    	//get old status
		$sql='SELECT s.status_name FROM contracts  inner join status s ON s.status_id=contracts.status  WHERE contract_id=:contract_id LIMIT 1';
        $query = $this->db->prepare($sql);
        $query->bindParam(':contract_id',$_POST['contract_id'],PDO::PARAM_INT);
        $query->execute();
        $oldstatus=$query->fetch();
        //if($_SESSION['role']!='backoffice' || $_SESSION['role']!='admin') { header('Location:'.URL); return; };
        $sql = "UPDATE contracts SET status=:status_id WHERE contract_id=:contract_id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':status_id', $_POST['status_id'],PDO::PARAM_INT);
        $query->bindParam(':contract_id', $_POST['contract_id'],PDO::PARAM_INT);
        if ($query->execute()) {
            echo "success";
            	//new status name
                $sql='SELECT status_name FROM status where status_id=:status_id';
		        $query = $this->db->prepare($sql);
		        $query->bindParam(':status_id', $_POST['status_id'],PDO::PARAM_INT);
		        $query->execute();
		        $newstatus=$query->fetch();

                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }

		        //log cheanges
                $sql="INSERT INTO log(user_id,contract_id,diff,ip) VALUES(:user_id,:contract_id,:diff,:ip)";
                $query=$this->db->prepare($sql);
                $query->bindParam(':user_id',$_SESSION['user_id'],PDO::PARAM_INT);
                $query->bindParam(':contract_id', $_POST['contract_id'],PDO::PARAM_INT);
                $query->bindValue(':diff',"status[".$oldstatus->status_name."=>".$newstatus->status_name."]");
                $query->bindParam(':ip', $ip);
                $query->execute();

        }else{
            echo "error";
        }
    }
    public function editContractStatusTemp(){
        //get old status
        $sql='SELECT s.status_name FROM contracts  inner join status s ON s.status_id=contracts.status  WHERE contract_id=:contract_id LIMIT 1';
        $query = $this->db->prepare($sql);
        $query->bindParam(':contract_id',$_POST['contract_id'],PDO::PARAM_INT);
        $query->execute();
        $oldstatus=$query->fetch();
        //if($_SESSION['role']!='backoffice' || $_SESSION['role']!='admin') { header('Location:'.URL); return; };
        $sql = "UPDATE contracts SET status_temp=:status_id WHERE contract_id=:contract_id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':status_id', $_POST['status_id'],PDO::PARAM_INT);
        $query->bindParam(':contract_id', $_POST['contract_id'],PDO::PARAM_INT);
        if ($query->execute()) {
            echo "success";
                //new status name
                $sql='SELECT status_name FROM status where status_id=:status_id';
                $query = $this->db->prepare($sql);
                $query->bindParam(':status_id', $_POST['status_id'],PDO::PARAM_INT);
                $query->execute();
                $newstatus=$query->fetch();

                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }

                //log cheanges
                $sql="INSERT INTO log(user_id,contract_id,diff,ip) VALUES(:user_id,:contract_id,:diff,:ip)";
                $query=$this->db->prepare($sql);
                $query->bindParam(':user_id',$_SESSION['user_id'],PDO::PARAM_INT);
                $query->bindParam(':contract_id', $_POST['contract_id'],PDO::PARAM_INT);
                $query->bindValue(':diff',"status[".$oldstatus->status_name."=>".$newstatus->status_name."]");
                $query->bindParam(':ip', $ip);
                $query->execute();

        }else{
            echo "error";
        }
    }

    public function editContractCampaign(){
        //if($_SESSION['role']!='backoffice' || $_SESSION['role']!='admin') { header('Location:'.URL); return; };
        $sql = "UPDATE contracts SET campaign=:campaign_id WHERE contract_id=:contract_id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':campaign_id', $_POST['campaign_id'],PDO::PARAM_INT);
        $query->bindParam(':contract_id', $_POST['contract_id'],PDO::PARAM_INT);
        if ($query->execute()) {
           echo "success";
        }else{
            echo "error";
        }
    }

    public function deleteContract(){
        if($_SESSION['role']!='admin') { header('Location:'.URL); return; };
        $sql = "DELETE FROM contracts WHERE contract_id=:contract_id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':contract_id', $_POST['contract_id'],PDO::PARAM_INT);
        if ($query->execute()) {
           echo "success";
        }else{
            echo "error";
        }
    }

    public function convertCnt($toType,$toStatus){

        $_POST=$_REQUEST['contract'];
        // 6 switch
        // 7 storni
        $old_type=  $_POST['contract_type'];
        $old_status=$_POST['status'];

        switch ($toStatus) {
            case 'switch':
                $_POST['status']='6';
                break;
            case 'storni':
                $_POST['status']='7';
                break;
            default:
               $_POST['status']='1';
                break;
        }

        $_POST['contract_type']=$toType;

        $sql="INSERT INTO contracts
                    (`date`,
                        operator,
                    supervisor,
                    campaign,
                    ugm_cb,
                    analisi_cb,
                    iniziative_cb,
        tel_number,alt_number,cel_number,cel_number2,cel_number3,email,alt_email,
client_type,gender,rag_sociale,first_name,last_name,vat_number,partita_iva,birth_date,
birth_nation,birth_municipality,document_type,document_number,document_date,
toponimo,address,civico,price,location,cap,
uf_toponimo,uf_address,uf_civico,uf_price,uf_location,uf_cap,
ddf_toponimo,ddf_address,ddf_civico,ddf_price,ddf_location,ddf_cap,
ubicazione_fornitura,domicillazione_documenti_fatture, contract_type, listino,
gas_request_type,gas_pdr,gas_fornitore_uscente,gas_consume_annuo,gas_tipo_riscaldamento,gas_tipo_cottura_acqua,gas_remi,gas_matricola,
luce_request_type,luce_pod,luce_tensione,luce_potenza,luce_fornitore_uscente,luce_opzione_oraria,luce_consume_annuo,
fature_via_email,
payment_type,iban_code,iban_accounthoder,iban_fiscal_code,note,status,
delega_first_name,delega_last_name,delega_vat_number,document_expiry,document_issue_place            )             VALUES            (:date,                :operator,            :supervisor,            :campaign,            :ugm_cb,            :analisi_cb,            :iniziative_cb,
:tel_number,:alt_number,:cel_number,:cel_number2,:cel_number3,:email,:alt_email,
:client_type,:gender,:rag_sociale,:first_name,:last_name,:vat_number,:partita_iva,
:birth_date,:birth_nation,:birth_municipality,:document_type,:document_number,:document_date,
:toponimo,:address,:civico,:price,:location,:cap,
:uf_toponimo,:uf_address,:uf_civico,:uf_price,:uf_location,:uf_cap,
:ddf_toponimo,:ddf_address,:ddf_civico,:ddf_price,:ddf_location,:ddf_cap,
:ubicazione_fornitura,:domicillazione_documenti_fatture, :contract_type, :listino,
:gas_request_type,:gas_pdr,:gas_fornitore_uscente,:gas_consume_annuo,:gas_tipo_riscaldamento,:gas_tipo_cottura_acqua,:gas_remi,:gas_matricola,
:luce_request_type,:luce_pod,:luce_tensione,:luce_potenza,:luce_fornitore_uscente,:luce_opzione_oraria,:luce_consume_annuo,
:fature_via_email,
:payment_type,:iban_code,:iban_accounthoder,:iban_fiscal_code,:note,:status,
:delega_first_name,:delega_last_name,:delega_vat_number,:document_expiry,:document_issue_place
    )";

        $query = $this->db->prepare($sql);
        $query->bindValue(':date',date('Y-m-d',strtotime($_POST['date'])));
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
        $query->bindValue(':first_name', trim($_POST['first_name']));
        $query->bindValue(':last_name', trim($_POST['last_name']));
        $query->bindParam(':vat_number', $_POST['vat_number']);
        $query->bindParam(':partita_iva', $_POST['partita_iva']);
        $query->bindValue(':birth_date', date('Y-m-d',strtotime($_POST['birth_date'])));
        $query->bindParam(':birth_nation', $_POST['birth_nation']);
        $query->bindParam(':birth_municipality', $_POST['birth_municipality']);
        $query->bindParam(':document_type', $_POST['document_type']);
        $query->bindParam(':document_number', $_POST['document_number']);
        $query->bindValue(':document_date',date('Y-m-d',strtotime($_POST['document_date'])));
        $query->bindValue(':document_expiry',date('Y-m-d',strtotime($_POST['document_expiry'])));
        $query->bindValue(':document_issue_place', $_POST['document_issue_place']);

        $query->bindParam(':toponimo', $_POST['toponimo']);
        $query->bindParam(':address', $_POST['address']);
        $query->bindParam(':civico', $_POST['civico']);
        $query->bindParam(':price', $_POST['price']);
        $query->bindParam(':location', $_POST['location']);
        $query->bindParam(':cap', $_POST['cap']);

        if ($_POST['ubicazione_fornitura']=='non_resident') {
            $query->bindParam(':uf_toponimo', $_POST['uf_toponimo']);
            $query->bindParam(':uf_address', $_POST['uf_address']);
            $query->bindParam(':uf_civico', $_POST['uf_civico']);
            $query->bindParam(':uf_price', $_POST['uf_price']);
            $query->bindParam(':uf_location', $_POST['uf_location']);
            $query->bindParam(':uf_cap', $_POST['uf_cap']);
        }else{
            $query->bindValue(':uf_toponimo','');
            $query->bindValue(':uf_address', '');
            $query->bindValue(':uf_civico', '');
            $query->bindValue(':uf_price', '');
            $query->bindValue(':uf_location', '');
            $query->bindValue(':uf_cap', '');
        }

        if ($_POST['domicillazione_documenti_fatture']=='altro') {
            $query->bindParam(':ddf_toponimo', $_POST['ddf_toponimo']);
            $query->bindParam(':ddf_address', $_POST['ddf_address']);
            $query->bindParam(':ddf_civico', $_POST['ddf_civico']);
            $query->bindParam(':ddf_price', $_POST['ddf_price']);
            $query->bindParam(':ddf_location', $_POST['ddf_location']);
            $query->bindParam(':ddf_cap', $_POST['ddf_cap']);
        }else{
            $query->bindValue(':ddf_toponimo','');
            $query->bindValue(':ddf_address', '');
            $query->bindValue(':ddf_civico', '');
            $query->bindValue(':ddf_price', '');
            $query->bindValue(':ddf_location', '');
            $query->bindValue(':ddf_cap', '');
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

        if ($_POST['payment_type']=='cc') {
            $query->bindParam(':iban_code', $_POST['iban_code']);
            $query->bindParam(':iban_accounthoder', $_POST['iban_accounthoder']);
            $query->bindParam(':iban_fiscal_code', $_POST['iban_fiscal_code']);
        }else{
            $query->bindValue(':iban_code','');
            $query->bindValue(':iban_accounthoder', '');
            $query->bindValue(':iban_fiscal_code', '');
        }

        $query->bindParam(':note', $_POST['note']);


            if ($query->execute()) {

                if ($_POST['contract_type']=='luce') {
                    $_POST['contract_type']='gas';
                }elseif ($_POST['contract_type']=='gas') {
                    $_POST['contract_type']='luce';
                }
                $_POST['status']=$old_status;

                 $sql="UPDATE contracts SET `date`=:date,operator=:operator,supervisor=:supervisor,campaign=:campaign,ugm_cb=:ugm_cb,analisi_cb=:analisi_cb,iniziative_cb=:iniziative_cb, tel_number=:tel_number,alt_number=:alt_number,cel_number=:cel_number,cel_number2=:cel_number2,cel_number3=:cel_number3,email=:email,alt_email=:alt_email,client_type=:client_type,gender=:gender,rag_sociale=:rag_sociale,first_name=:first_name,last_name=:last_name,vat_number=:vat_number,partita_iva=:partita_iva,birth_date=:birth_date,birth_nation=:birth_nation,birth_municipality=:birth_municipality,document_type=:document_type,document_number=:document_number,document_date=:document_date,toponimo=:toponimo,address=:address,civico=:civico,price=:price,location=:location,cap=:cap,uf_toponimo=:uf_toponimo,uf_address=:uf_address,uf_civico=:uf_civico,uf_price=:uf_price,uf_location=:uf_location,uf_cap=:uf_cap,ddf_toponimo=:ddf_toponimo,ddf_address=:ddf_address,ddf_civico=:ddf_civico,ddf_price=:ddf_price,ddf_location=:ddf_location,ddf_cap=:ddf_cap,ubicazione_fornitura=:ubicazione_fornitura,domicillazione_documenti_fatture=:domicillazione_documenti_fatture,contract_type=:contract_type,listino=:listino,gas_request_type=:gas_request_type,gas_pdr=:gas_pdr,gas_fornitore_uscente=:gas_fornitore_uscente,gas_consume_annuo=:gas_consume_annuo,gas_tipo_riscaldamento=:gas_consume_annuo,gas_tipo_cottura_acqua=:gas_tipo_cottura_acqua,gas_remi=:gas_remi,gas_matricola=:gas_matricola,luce_request_type=:luce_request_type,luce_pod=:luce_pod,luce_tensione=:luce_tensione,luce_potenza=:luce_potenza,luce_fornitore_uscente=:luce_fornitore_uscente,luce_opzione_oraria=:luce_opzione_oraria,luce_consume_annuo=:luce_consume_annuo,fature_via_email=:fature_via_email,payment_type=:payment_type,iban_code=:iban_code,iban_accounthoder=:iban_accounthoder,iban_fiscal_code=:iban_fiscal_code,note=:note,status=:status,delega_first_name=:delega_first_name,delega_last_name=:delega_last_name,delega_vat_number=:delega_vat_number,document_expiry=:document_expiry,document_issue_place=:document_issue_place,note_super=:note_super WHERE contract_id=:contract_id";

                    $query = $this->db->prepare($sql);
                    $query->bindValue(':date',date('Y-m-d',strtotime($_POST['date'])));

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
                    $query->bindValue(':first_name', trim($_POST['first_name']));
                    $query->bindValue(':last_name', trim($_POST['last_name']));
                    $query->bindParam(':vat_number', $_POST['vat_number']);
                    $query->bindParam(':partita_iva', $_POST['partita_iva']);
                    $query->bindValue(':birth_date', date('Y-m-d',strtotime($_POST['birth_date'])));
                    $query->bindParam(':birth_nation', $_POST['birth_nation']);
                    $query->bindParam(':birth_municipality', $_POST['birth_municipality']);
                    $query->bindParam(':document_type', $_POST['document_type']);
                    $query->bindParam(':document_number', $_POST['document_number']);
                    $query->bindValue(':document_date',date('Y-m-d',strtotime($_POST['document_date'])));
                    $query->bindValue(':document_expiry',date('Y-m-d',strtotime($_POST['document_expiry'])));
                    $query->bindValue(':document_issue_place', $_POST['document_issue_place']);

                    $query->bindParam(':toponimo', $_POST['toponimo']);
                    $query->bindParam(':address', $_POST['address']);
                    $query->bindParam(':civico', $_POST['civico']);
                    $query->bindParam(':price', $_POST['price']);
                    $query->bindParam(':location', $_POST['location']);
                    $query->bindParam(':cap', $_POST['cap']);
                    $query->bindParam(':note_super', $_POST['note_super']);

                    if ($_POST['ubicazione_fornitura']=='non_resident') {
                        $query->bindParam(':uf_toponimo', $_POST['uf_toponimo']);
                        $query->bindParam(':uf_address', $_POST['uf_address']);
                        $query->bindParam(':uf_civico', $_POST['uf_civico']);
                        $query->bindParam(':uf_price', $_POST['uf_price']);
                        $query->bindParam(':uf_location', $_POST['uf_location']);
                        $query->bindValue(':uf_cap', $_POST['uf_cap']);
                    }else{
                        $query->bindValue(':uf_toponimo','');
                        $query->bindValue(':uf_address', '');
                        $query->bindValue(':uf_civico', '');
                        $query->bindValue(':uf_price', '');
                        $query->bindValue(':uf_location', '');
                        $query->bindValue(':uf_cap', '');
                    }

                    if ($_POST['domicillazione_documenti_fatture']=='altro') {
                        $query->bindParam(':ddf_toponimo', $_POST['ddf_toponimo']);
                        $query->bindParam(':ddf_address', $_POST['ddf_address']);
                        $query->bindParam(':ddf_civico', $_POST['ddf_civico']);
                        $query->bindParam(':ddf_price', $_POST['ddf_price']);
                        $query->bindParam(':ddf_location', $_POST['ddf_location']);
                        $query->bindValue(':ddf_cap', $_POST['ddf_cap']);
                    }else{
                        $query->bindValue(':ddf_toponimo','');
                        $query->bindValue(':ddf_address', '');
                        $query->bindValue(':ddf_civico', '');
                        $query->bindValue(':ddf_price', '');
                        $query->bindValue(':ddf_location', '');
                        $query->bindValue(':ddf_cap', '');
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

                    if ($_POST['payment_type']=='cc') {
                        $query->bindParam(':iban_code', $_POST['iban_code']);
                        $query->bindParam(':iban_accounthoder', $_POST['iban_accounthoder']);
                        $query->bindParam(':iban_fiscal_code', $_POST['iban_fiscal_code']);
                    }else{
                        $query->bindValue(':iban_code','');
                        $query->bindValue(':iban_accounthoder', '');
                        $query->bindValue(':iban_fiscal_code', '');
                    }

                    $query->bindParam(':note', $_POST['note']);


                     $query->bindParam(':contract_id',$_POST['contract_id'],PDO::PARAM_INT);

                     $query->execute();
            }



    }
}
