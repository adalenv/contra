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
           echo "sucess";
        }else{
            echo "error";
        } 
    }  
    public function deleteHours(){
        $sql = "DELETE FROM workhours WHERE workhours_id=:workhours_id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':workhours_id', $_POST['workhours_id'],PDO::PARAM_INT);
        if ($query->execute()) {
           echo "sucess";
        }else{
            echo "error";
        } 
    }
    public function deleteAudio(){
        $file = APP."documents/".$_POST['url'];
        $sql = "DELETE FROM audios WHERE audio_id=:audio_id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':audio_id', $_POST['audio_id'],PDO::PARAM_INT);
        if ($query->execute()) {
           echo "sucess";
           unlink($file);
        }else{
            echo "error";
        } 
    }
    public function deleteDocument(){
        $file = APP."documents/".$_POST['url'];
        $sql = "DELETE FROM documents WHERE document_id=:document_id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':document_id', $_POST['document_id'],PDO::PARAM_INT);
        if ($query->execute()) {
           echo "sucess";
           unlink($file);
        }else{
            echo "error";
        } 
    }

}
