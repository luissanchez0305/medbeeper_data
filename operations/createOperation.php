<?php
include_once "../helper.php";
header('Content-type: application/json;charset=utf-8');
header("access-control-allow-origin: *");

if(isset($_GET['lastname']) && isset($_GET['doctorId'])){    
    $query = "INSERT INTO patients (name, lastname, doctorid) VALUES ('" . $_GET['name'] . "', '" . $_GET['lastname'] . "',".
            $_GET['doctorId'] . ")";
    $result = mysql_query($query,$link) or die('Errant query:  ' . $query); 
    
    $query = "INSERT INTO operations (patientid, relativeid, name, code) VALUES (" . mysql_insert_id() . ",null,'".
            $_GET['operationName'] . "','" . generateRandomString() . "')";
    $result = mysql_query($query,$link) or die('Errant query:  ' . $query); 
    
    $query = "SELECT code FROM operations WHERE id = " . mysql_insert_id();
    $result = mysql_query($query,$link) or die('Errant query:  '.$query); 

    $operations = array();
    while($operation = mysql_fetch_assoc($result)) {
        $operations[] = array('operation'=>$operation);    
    }
    echo json_encode(array('status'=>'success', 'code'=>$patients[0]['operation']['code']));
     
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

