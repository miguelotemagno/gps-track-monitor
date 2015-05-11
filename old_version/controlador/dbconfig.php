<?php

$ip=getIP2();
if ($ip=='127.0.0.1'){
$dbhost = 'localhost';
$dbuser   = 'root';
$dbpassword = 'miguelote';
$database = 'maps';}
else{
$dbhost = 'localhost';
$dbuser   = 'propcl_info';
$dbpassword = '16327225';
$database = 'propcl_soporteonline';

}
 function getIP2() {
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    elseif (isset($_SERVER['HTTP_VIA'])) {
       $ip = $_SERVER['HTTP_VIA'];
    }
    elseif (isset($_SERVER['REMOTE_ADDR'])) {
       $ip = $_SERVER['REMOTE_ADDR'];
    }
    else {
       $ip = "unknown";
    }

    return $ip;
}?>
