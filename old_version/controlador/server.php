<?php
include("dbconfig.php");
include("Vehiculos.php");
require("Alertas.php");
include("ConfiguracionApp.php");

$vehiculo=new Vehiculos();
$alerta=new Alertas();
$configuracion=new ConfiguracionApp();
$examp = $_REQUEST["q"]; //query number
$tabla = $_GET['table'];
$data= $_GET['dataOP'];
$campos=str_replace('-',',',$data);
$campos2=explode("-",$data);
$page = $_REQUEST['page']; // get the requested page
$limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
$sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
$sord = $_REQUEST['sord']; // get the direction
$oper=$_REQUEST['oper'];
$valores=array ();
$i=0;
foreach ($campos2 as $a){
    $valores[]=$_REQUEST[$campos2[$i]];
    $i++;
}

if(!$sidx) $sidx =1;
$db = mysql_connect($dbhost, $dbuser, $dbpassword)
or die("Connection Error: " . mysql_error());
mysql_select_db($database) or die("Error conecting to db.");

// select the database
/*mysql_select_db($database) or die("Error conecting to db.");
$result = mysql_query( $SQL ) or die($SQL."Couldn t execute query.".mysql_error());
while($row = @mysql_fetch_assoc($result,MYSQL_ASSOC || $row2 = @mysql_fetch_row ($result,MYSQL_ASSOC))) {
    
}*/

$value=" values('";
$i=0;
if ($oper=='add'){

foreach ($valores as $a){
    $value.=$valores[$i]."','";
    $i++;
}
$value.=')';
 $value= substr_replace($value,'', strlen($value)-3, 2);
$SQL='insert into '.$tabla.' '.$value;
if ($tabla=="alert_hora"){
    $alerta->SetAlertaHora($_SESSION["cod"], $valores[1],  $valores[2],  $valores[3]);
}
if ($tabla=="alert_vel"){
    $alerta->serAlertaVel($_SESSION["cod"], $valores[1],  $valores[2]);
}

if ($tabla=="configuracion"){
    $configuracion->setConfig($_SESSION["cod"], $valores[1], $valores[2], $valores[3], $valores[4], $valores[5], $valores[6], $valores[7]);
}
if ($tabla=="userautos"){
    $vehiculo->SetVehiculo($_SESSION["cod"], $valores[0], $valores[1],$valores[2], $valores[3],$valores[4], $valores[5]);
}
 //mysql_query( $SQL ) or die($SQL."Couldn t execute query.".mysql_error());
}
$i=0;
$edit=" Set ";
if ($oper=='edit'){

foreach ($valores as $a){
    $edit.=$campos2[$i]."='".$valores[$i]."',";
    $i++;
}
$idd=$_REQUEST['id'];
 $edit= substr_replace($edit,'', strlen($edit)-1, 1);
//$SQL='update '.$tabla.' '.$edit.' where '.$campos2[1].' =\'' .$valores[1].'\'';
//mysql_query( $SQL ) or die($SQL."Couldn t execute query.".mysql_error());
 if ($tabla=="alert_hora"){
     $alerta->UpdateAlertaHora($_SESSION["cod"], $idd, $valores[1],$valores[2], $valores[3]);

 }
  if ($tabla=="alert_vel"){
     $alerta->UpdateAlertaVel($_SESSION["cod"], $idd, $valores[2]);
     echo $valores[1];

 }
   if ($tabla=="configuracion"){
     $configuracion->updateCong($_SESSION["cod"],$valores[1] , $valores[2], $valores[3], $valores[4], $valores[5], $valores[6], $valores[7], $valores[8]);
 }
 if ($tabla=="userautos"){
     $vehiculo->editVehiculo($_SESSION["cod"], $valores[0],  $valores[1],  $valores[2],  $valores[3], $valores[4],  $valores[6],$valores[5]);
 }
}
$i=0;
$del="";
if ($oper=='del'){
    $idd=$_POST['id'];
    //$SQL='delete from '.$tabla.'  where '.$campos2[0].' =\'' .$idd.'\'';
//mysql_query( $SQL ) or die($SQL."Couldn t execute query.".mysql_error());
    if ($tabla=="alert_hora"){
    $alerta->delAlertasHora($_SESSION["cod"], $idd);}
    if ($tabla=="alert_vel"){
    $alerta->delAlertasVel($_SESSION["cod"], $idd);}
    if ($tabla=="configuracion"){
    $configuracion->delConfig($_SESSION["cod"], $idd);}
    if ($tabla=="userautos"){
        $vehiculo->DelVehiculo($_SESSION["cod"], $idd);
    }
}
?>
