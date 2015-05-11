<?php
ob_start();
session_start();
require_once('mysql.php');
$op=$_GET["OP"];
if ($op=="H"){
$patente=$_GET["patente"];

$HoraInicio=$_GET["Horai"];
$HoraFinal=$_GET["HoraF"];
$idalerta=0;
$idalertaH=0;
$idalertaT=0;
$sql="select max(idalerta) from alertas";
$result = mysql_query($sql);
while ($row = @mysql_fetch_row($result)){
$idalerta=$row[0]+1;
}
echo $sql;
echo mysql_affected_rows();
if ($idalerta<1){
    $idalerta=1;
}
$sql="select max(IdAlerH) from alert_hora";
$result = mysql_query($sql);
while ($row = @mysql_fetch_row($result)){
$idalertaH=$row[0]+1;
}
//echo $sql;
echo mysql_affected_rows();
if ($idalertaH<1){
    $idalertaH=1;
}

$sql="insert into alertas values(".$idalerta.",'".$patente."','0','".$_SESSION["cod"]."',".$idalertaH.")";
mysql_query($sql);
echo $sql;
$sql="insert into alert_hora values(".$idalertaH.",'".$HoraInicio."','".$HoraFinal."')";
mysql_query($sql);
echo $sql;

echo "Grabado Gracias";
echo '<img src="images/ao.png" onload="addAlert(\''.$patente.'\',\''.$HoraInicio.'\',\''.$HoraFinal.'\');cargarPagina(\'controlador/nada.php\',\'verificar\');"/>';
}
else {
$patente=$_GET["patente"];
$vel=$_GET["vel"];

$idalerta=0;
$idalertaH=0;
$idalertaT=0;
$sql="select max(idalerta) from alertas";
$result = mysql_query($sql);
while ($row = @mysql_fetch_row($result)){
$idalerta=$row[0]+1;
}
echo $sql;
echo mysql_affected_rows();
if ($idalerta<1){
    $idalerta=1;
}
$sql="select max(IdAlerV) from alert_vel";
$result = mysql_query($sql);
while ($row = @mysql_fetch_row($result)){
$idalertaH=$row[0]+1;
}
echo $sql;
echo mysql_affected_rows();
if ($idalertaH<1){
    $idalertaH=1;
}

$sql="insert into alertas values(".$idalerta.",'".$patente."','1','".$_SESSION["cod"]."',".$idalertaH.")";
mysql_query($sql);
echo $sql;

$sql="insert into alert_vel values(".$idalertaH.",'".$vel."')";
mysql_query($sql);
echo $sql;


echo "grabado";
    echo '<img src="images/ao.png" onload="addAlertV(\''.$patente.'\',\''.$vel.'\');cargarPagina(\'controlador/nada.php\',\'verificar\');"/>';
}

?>
