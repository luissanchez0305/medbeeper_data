<?php
include_once "../helper.php";
header('Content-type: application/json;charset=utf-8');
header("access-control-allow-origin: *");

if(isset($_GET['name']) && isset($_GET['lastname'])){    
    $query = "INSERT INTO patients (name, lastname) VALUES (".$_GET['name'].",".$_GET['lastname'].")";
    $result = mysql_query($query,$link) or die('Errant query:  '.$query);
    echo json_encode(array('id'=>mysql_insert_id()));    
}

