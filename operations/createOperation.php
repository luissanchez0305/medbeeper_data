<?php
include_once "../helper.php";
header('Content-type: application/json;charset=utf-8');
header("access-control-allow-origin: *");

if(isset($_GET['patientId']) && isset($_GET['doctorId']) && isset($_GET['operationName'])){    
    $query = "INSERT INTO operations (patientid, doctorid, name, code) VALUES (".$_GET['patientId'].",".
            $_GET['doctorId'].",'".$_GET['operationName']."','".generateRandomString()."')";
    $result = mysql_query($query,$link) or die('Errant query:  '.$query);  
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

