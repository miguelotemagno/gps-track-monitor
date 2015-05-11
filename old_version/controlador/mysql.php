<?php
require('conf.php');
$username=$user;
$password=$pass;
$database=$db;
$localhost=$ipsql;
conec($localhost,$username,$password,$database);
function conec($localhost,$username,$password,$database){
$connection=mysql_connect($localhost, $username, $password);

if (!$connection) {
  die('Not connected : ' . mysql_error());
}
// Set the active mySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}
}
?>