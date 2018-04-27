<?php

/**
 * //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit(); debug sql
 */
class v1 extends Controller
{


    public function index()
    { 

        echo "api v1";

    }
    


    public function getcontracts($type,$proposal_number,$date,$name,$address,$location,$operator,$status,$cancellation_reason){

        $where='';
        $arr = get_defined_vars();
      //  print_r($arr);
        $start=(int)$_REQUEST['start'];
        $limiter=(int)$_REQUEST['limiter'];
        $sortby=$_REQUEST['sortby'];
        $sorttype=$_REQUEST['sorttype'];
        $condition=is_null($_REQUEST['condition'])? $_REQUEST['condition'] : 'and';

        foreach ($arr as $name => $val) { 
            if ($val!='' && $val !='null' && $val!='undefined') {
                $where.=$name." like "."'".$val."%'" .$condition." ";
            }
        }
        $where=preg_replace('/\W\w+\s*(\W*)$/', '$1', $where);//remove `and` or `or` at  last word

        $output=array();
        $sql="SELECT * FROM list WHERE ".$where." ORDER BY $sortby $sorttype  LIMIT $start , $limiter";
        echo $sql;
        $query = $this->db->prepare($sql);
        //array(':provider' => $provider.'%')
        $query->execute();
        while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
            array_push($output, $row);
        }
      //  header('Content-type: application/json');
      //  echo json_encode($output); //echo data json 
    }//getAll rates filter

    public function insertContract(){
        $data=array(
            ':contract_type' => addslashes($_POST['contract_type']),
            ':proposal_number' => addslashes($_POST['proposal_number']),
            ':insert_date' => addslashes($_POST['date']),
            ':address' => addslashes($_POST['address']),
            ':location' => addslashes($_POST['location']),
            ':operator' => addslashes($_POST['operator']),
            ':status' => addslashes($_POST['status']),
            ':cancellation_reason' => addslashes($_POST['cancellation_reason']),
            ':gender' => addslashes($_POST['gender']),
            ':first_name' => addslashes($_POST['first_name']),
            ':last_name' => addslashes($_POST['last_name']),
            ':bussines_name' => addslashes($_POST['bussines_name']),
            ':client_type' => addslashes($_POST['client_type']),
            ':tel_number' => addslashes($_POST['tel_number']),
            ':alt_phone' => addslashes($_POST['alt_phone']),
            ':cel_number' => addslashes($_POST['cel_number']),
            ':cel_number2' => addslashes($_POST['cel_number2']),
            ':cel_number3' => addslashes($_POST['cel_number3']),
            ':email' => addslashes($_POST['email']),
            ':alt_email' => addslashes($_POST['alt_email']),
            ':nation' => addslashes($_POST['nation']),
            ':vat_number' => addslashes($_POST['vat_number']),
            ':birth_date' => addslashes($_POST['birth_date']),
            ':municipality' => addslashes($_POST['municipality']),
            ':iban_code' => addslashes($_POST['iban_code']),
            ':iban_accountholder' => addslashes($_POST['iban_accountholder']),
            ':iban_fiscal_code' => addslashes($_POST['iban_fiscal_code']),
            ':payment' => addslashes($_POST['payment'])
            

            );
            $sql=
            "INSERT INTO contracts (
                    contract_type,
                    proposal_number,
                    insert_date,
                    address,
                    location,
                    operator,
                    status,
                    cancellation_reason,
                    gender,
                    first_name,
                    last_name,
                    bussines_name,
                    client_type,
                    tel_number,
                    alt_phone,
                    cel_number,
                    cel_number2,
                    cel_number3,
                    email,
                    alt_email,
                    nation,
                    vat_number,
                    birth_date,
                    municipality,
                    iban_code,
                    iban_fiscal_code,
                    iban_accountholder,
                    payment

                ) VALUES (
                    :contract_type,
                    :proposal_number,
                    :insert_date,
                    :address,
                    :location,
                    :operator,
                    :status,
                    :cancellation_reason,
                    :gender,
                    :first_name,
                    :last_name,
                    :bussines_name,
                    :client_type,
                    :tel_number,
                    :alt_phone,
                    :cel_number,
                    :cel_number2,
                    :cel_number3,
                    :email,
                    :alt_email,
                    :nation,
                    :vat_number,
                    :birth_date,
                    :municipality,
                    :iban_code,
                    :iban_fiscal_code,
                    :iban_accountholder,
                    :payment
                )
            ";
        //$query = $this->db->prepare($sql);
        //$query->execute($data);
        print_r($_POST);

    }






    
    public function uploadData(){
        if ($_FILES['csv']['size'] > 0) { //name csv
            //get the csv file 
            $file = $_FILES['csv']['tmp_name']; 
            $handle = fopen($file,"r"); 
            //loop through the csv file and insert into database 
            do { 
                if (isset($data[0])) {
                   $query = $this->db->prepare("INSERT INTO list (country_code, phone_prefix,network,rate,provider) VALUES (:country_code , :phone_prefix , :network , :rate ,:provider)");
                        $query->execute(
                            array(':country_code' => addslashes($data[0]),
                                  ':phone_prefix' => addslashes($data[1]),
                                  ':network' => addslashes($data[2]),
                                  ':rate' => addslashes($data[3]),
                                  ':provider' => addslashes($data[4]),
                             ));
                }
            } while ($data = fgetcsv($handle)); 
           header("Location: " . $_SERVER["HTTP_REFERER"].'#success');
        } 
    }



}
