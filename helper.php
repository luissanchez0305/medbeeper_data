<?php
function localCurl($url){
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
	
return $ch;
}
$username = 'root';
$password = 'goingup123';
$database = 'medbeeper';

$link = mysql_connect('52.38.113.207',$username,$password) or die('Cannot connect to the DB');
mysql_select_db($database) or die(mysql_errno());
mysql_query("SET NAMES 'utf8'");
?>