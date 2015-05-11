<?php
ob_start();
function EsNumero($numero){

if (eregi("^[A-z]+$",$numero)){
return true;
}else{
return false;
}
}

    require_once("mysql.php");
     require_once("../modelo/gmp1_1_1.php");
     $map = new GoogleMapAPI('map_canvas');


     function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}







$query = "SELECT * FROM geocodes,user_autos where address=cod_id  ";
$opt=$_GET['opt'];
$date= $_GET['date'];
$date2=split(" ",$date);
$fecha= $date2[0];
$ff=split("/",$fecha);
$fechafinal=$ff[2]."-".$ff[1]."-".$ff[0];
$date= $_GET['date2'];
$date2=split(" ",$date);
$fecha= $date2[0];
$ff=split("/",$fecha);
$fechafinal2=$ff[2]."-".$ff[1]."-".$ff[0];
$vehiculo= $_GET['idv'];
$iduser= $_GET['iduser'];
$horasql=$date2[1];

$hora1=$horasql;
$hora2="1:00";
$hora1=split(":",$hora1);
$hora2=split(":",$hora2);
$horas=(int)$hora1[0]+(int)$hora2[0];
$minutos=(int)$hora1[1]+(int)$hora2[1];
$horas+=(int)($minutos/60);
$minutos=$minutos%60;
if($minutos<10)$minutos="0".$minutos ;
$horasql2= $horas.":".$minutos;

if ($fecha!=""){
    $query.=" and geocodes.fecha>='".$fechafinal2."' and geocodes.fecha<='".$fechafinal2."'";
   $query.=" and geocodes.hora>='".$horasql."' and geocodes.hora<='".$horasql2." '";
}
if ($vehiculo!="0"){
    $query.=" and patente='".$vehiculo."'";
}
if ($iduser!=""){
    $query.=" and coduser=".$iduser;
}
$query.=" order by address,geocodes.fecha,geocodes.hora";
if ($opt=="s"){
   $query = "select * from geocodes,user_autos where address=cod_id and  coduser='".$iduser."' order  by geocodes.fecha,geocodes.hora desc limit 1";
}

$query = mysql_query($query);

$sw=0;
$sw2=1;
$dis=0;
$distancia=0;
$lat2=0;
$lon;
$lat;
$lon2=0;
header("Content-type: text/xml");
echo '<markers>';

while ($row=mysql_fetch_assoc($query)){
    $lat[$sw]=$map->lat($row['lat']);
    $lon[$sw]=$map->lon($row['lon']);
    
    if ($sw>0){

          $dis= $map->distance($lat[$sw2],$lon[$sw2],$lat[$sw],$lon[$sw],false);
          if(($dis)>0){
  
          $diss=round($dis,2);
          $distancia=$distancia+$diss;
          }
    }
  $sw=$sw+1;
  $sw2=$sw-1;

 echo '<marker dist="'.$distancia.'" id="'.$row['address'].'" hora="'.$row['hora'].'" patente="'.$row['patente'].'" modelo="'.$row['MODELO'].'" marca="'.$row['MARCA'].'" fecha="'.$row['fecha'].'" velocidad="'.$row['otro1'].'" lat="'.$map->lat($row['lat']).'" lng="'.$map->lon($row['lon']).'"/>';


}

echo '</markers>';




?>
