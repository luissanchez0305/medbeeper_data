<?php
include_once "../helper.php";
header('Content-type: application/json;charset=utf-8');
header("access-control-allow-origin: *");

if(isset($_GET['lastname']) && isset($_GET['code']) && isset($_GET['contacttype']) && 
        (isset($_GET["email"]) || isset($_GET["celphone"]))){  
    // primero revisar si el apellido y codigo son validos
    $query = "SELECT * FROM operations WHERE code = ".$_GET['code'] . 
            " AND patientid IN (SELECT id FROM patients WHERE lastname = '".$_GET['lastname']."')";
    $result = mysql_query($query,$link) or die('Errant query:  '.$query); 
    
    $operations = array();
    while($operation = mysql_fetch_assoc($result)) {
        $operations[] = array('operation'=>$operation);    
    }
    if(count($operations)>0){
        // agregar el nuevo relative
        /*$query = "INSERT INTO relatives (contactTypeId, contactData) VALUES (".$_GET['contacttype'].",'".
                (isset($_GET["email"]) ? $_GET["email"] : $_GET["celphone"])."')";
        $result = mysql_query($query,$link) or die('Errant query:  '.$query);  */
        // actualiza operations con el relative
        /*$query = "UPDATE operations SET relativeid = " .mysql_insert_id(). " WHERE id = " . $operations[0]->operation.id;*/
        print_r($operations[0].operation);
        echo json_encode(array('status'=>'success'));    
    }
    else{
        echo json_encode(array('status'=>'fail'));     
    }
}
 else {
     echo 'no data';
 }
