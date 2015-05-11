<?php
ob_start();
session_start();
function EsNumero($numero){

if (eregi("^[A-z]+$",$numero)){
return true;
}else{
return false;
}
}
require_once('Geocodes.php');
require('mysql.php');
     require_once("../lib/GMap.class.php");
     $map = new GMap();
     $ConsultaMap=new Geocodes();

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}




$opt=$_GET['opt'];
$date= $_GET['date'];
$ve=$_GET['Patente'];
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
$star=$_GET['star'];
$limit=$_GET['limit'];

$consul=$_GET['consult'];
$arrayApp=Array();
        if ($consul=="1")
        {
            
           $arrayApp=$ConsultaMap->GetCantidadPorPatente($_SESSION["cod"],$ve,$fechafinal2,$fechafinal2,$horasql, $horasql2);
                    header("Content-type: text/xml");
                    echo '<markers>';

                    foreach ($arrayApp as $row){

                     echo '<marker patente="'.$row['patente'].'" cantidad="'.$row['cantidad'].'"/>';


                    }

                    echo '</markers>';
        }
        elseif ($consul=="2"){
            $arrayApp=$ConsultaMap->GetDatosGPS($vehiculo, $fechafinal2,$fechafinal2, $horasql, $horasql2, $_SESSION["cod"], $star, $limit);
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

                    foreach ($arrayApp as $row){
                        if ($row['lat']<0){
                        $lat[$sw]=$row['lat'];
                        $lon[$sw]=$row['lon'];}else{
                            $lat[$sw]=$map->lat($row['lat']);
                        $lon[$sw]=$map->lon($row['lon']);
                        }

                        if ($sw>0){

                              $dis= $map->distance($lat[$sw2],$lon[$sw2],$lat[$sw],$lon[$sw],false);
                              if(($dis)>0){

                              $diss=round($dis,2);
                              $distancia=$distancia+$diss;
                              }
                        }
                      $sw=$sw+1;
                      $sw2=$sw-1;
                      if ($row['lat']<0){
                      $lati=$row['lat'];
                      $cordi=$row['lon'];
                      }
                      else{
                          $lati=$map->lat($row['lat']);
                          $cordi=$map->lon($row['lon']);
                      }
                      

                     echo '<marker dist="'.$distancia.'" id="'.$row['id'].'" hora="'.$row['hora'].'" patente="'.$row['patente'].'" modelo="'.$row['MODELO'].'" marca="'.$row['MARCA'].'" fecha="'.$row['fecha'].'" velocidad="'.$row['otro1'].'" lat="'.$lati.'" lng="'.$cordi.'"/>';


                    }

                    echo '</markers>';
                }



?>
