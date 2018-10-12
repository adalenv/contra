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
}
