<?php
include_once "../helper.php";
header('Content-type: application/json;charset=utf-8');
header("access-control-allow-origin: *");

if(isset($_POST['lastname']) && isset($_POST['code']) && isset($_POST['contacttype']) && isset($_POST["contactdata"])){  
    // primero revisar si el apellido y codigo son validos
    $query = "SELECT * FROM operations WHERE code = ".$_POST['code'] . 
            " AND patientid IN (SELECT id FROM patients WHERE lastname = '".$_POST['lastname']."')";
    $result = mysql_query($query,$link) or die('Errant query:  '.$query); 
    
    $operations = array();
    while($operation = mysql_fetch_assoc($result)) {
        $operations[] = array('operation'=>$operation);    
    }
    if(count($operations)>0){
        // agregar el nuevo relative
        $query = "INSERT INTO relatives (contactTypeId, contactData) VALUES (".$_POST['contacttype'].",'".
                $_POST["contactdata"]."')";
        $result = mysql_query($query,$link) or die('Errant query:  '.$query);  
        // actualiza operations con el relative
        $query = "UPDATE operations SET relativeid = " .mysql_insert_id(). " WHERE id = " . $operations[0]->operation.id;
        
        echo json_encode(array('status'=>'success'));    
    }
    echo json_encode(array('status'=>'fail'));        
}
