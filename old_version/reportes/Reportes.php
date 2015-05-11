<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("../controlador/mysql.php");
require_once("../lib/GMap.class.php");
require_once("Math/Stats.php");
# Mas Info. ver link debajo
# http://pear.php.net/package/Math_Stats/docs/0.8.5/Math_Stats/Math_Stats.html

/**
 * Description of Reportes
 *
 * @author miguel
 */
class Reportes
{
    var $latitud;
    var $longitud;
    var $distancia;
    var $tiempo;
    var $map;
    var $velMax;

    //put your code here
    function __construct()
    {
        $this->map = new GMap();
        $sql = mysql_query("SELECT velmax FROM alert_vel WHERE IdAlerV = 2");
        $vel = @mysql_fetch_assoc($sql);
        $this->velMax = $vel['velmax'];
    }

    function get_distance($lat1, $long1, $lat2, $long2)
    {
        $earth = 6371; //km change accordingly
        //$earth = 3960; //miles

        //Point 1 cords
        $lat1 = deg2rad($lat1);
        $long1= deg2rad($long1);

        //Point 2 cords
        $lat2 = deg2rad($lat2);
        $long2= deg2rad($long2);

        //Haversine Formula
        $dlong=$long2-$long1;
        $dlat=$lat2-$lat1;

        $sinlat=sin($dlat/2);
        $sinlong=sin($dlong/2);

        $a=($sinlat*$sinlat)+cos($lat1)*cos($lat2)*($sinlong*$sinlong);

        $c=2*asin(min(1,sqrt($a)));

        $d=round($earth*$c);

        return $d;
    }

    function distance($lat1, $lng1, $lat2, $lng2, $miles = false)
    {
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lng1 *= $pi80;
        $lat2 *= $pi80;
        $lng2 *= $pi80;

        $r = 6372.797; // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlng = $lng2 - $lng1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;

        return ($miles ? ($km * 0.621371192) : $km);
    }

    function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        $lat_1 = $this->map->lat($lat1);
        $lon_1 = $this->map->lon($lng1);
        $lat_2 = $this->map->lat($lat2);
        $lon_2 = $this->map->lon($lng2);

        return $this->map->distance($lat_1,$lon_1,$lat_2,$lon_2,false);
    }

    function maxVelocidad($fecha)
    {
        $arr   = array();
        $map = new GMap();

        $ff=split("/",$fecha);
        $fechafinal=$ff[2]."-".$ff[1]."-".$ff[0];

        $query = "
            SELECT u.cod_id, u.patente, u.marca, u.modelo,
                date_format( g.hora, '%H:%i' ) hora, g.otro1, g.otro2, g.lat, g.lon,
                UNIX_TIMESTAMP(concat(g.fecha,' ', DATE_FORMAT(g.hora,'%H:%i:%s'))) as stamp,
                UNIX_TIMESTAMP(concat(g.fecha,' ', DATE_FORMAT(g.hora,'%H:00:00'))) as desde,
                UNIX_TIMESTAMP(concat(g.fecha,' ', DATE_FORMAT(g.hora,'%H:59:59'))) as hasta,
                DATE_FORMAT(g.hora,'%H:00') hora1, DATE_FORMAT(g.hora,'%H:59') hora2
            FROM geocodes g, userautos u
            WHERE g.fecha = '$fechafinal'
              AND g.otro3 = u.cod_id
            group by date_format(g.hora,'%H:%i')
            ORDER BY g.fecha, g.hora
            ";

        $result  = mysql_query($query);
        $latPrv  = 0;
        $lngPrv  = 0;
        $timePrv = 0;
        $velPrv  = 0;

        while($row = mysql_fetch_assoc($result))
        {
            $lat     = $map->lat($row['lat']);
            $lng     = $map->lon($row['lon']);
            $hora    = $row['hora'];
            $hora1   = $row['hora1'];
            $hora2   = $row['hora2'];
            $idx     = $hora1.$hora2;
            $gps     = $row['address'];
            $time    = $row['stamp'];
            $desde   = $row['desde'];
            $hasta   = $row['hasta'];
            $patente = $row['patente'];
            $marca   = $row['marca'];
            $modelo  = $row['modelo'];
            $coduser = $row['coduser'];
            $dist    = round($map->distance($lat, $lng,$latPrv,$lngPrv),5);
            $segs    = $time - $timePrv;
            $KmSeg   = $segs>0 ?$dist/$segs :0;
            $KmHora  = $row['otro1'];//round($KmSeg * 3600,2);
            $latPrv  = $lat;
            $lngPrv  = $lng;
            $timePrv = $time;

            $max = ($KmHora > $max) ?$KmHora :0;

            if($max >= $this->velMax)# && ereg('/[0-9]+\.[0-9]+/', $idx))
            {
                //$idx = "$timePrv,$time";
                $arr["$idx"] = array(
                    'fecha'   => $fecha,          //0
                    'hora'    => $hora,           //1
                    'lat'     => round($lat,5),   //2
                    'lng'     => round($lng,5),   //3
                    'gps'     => $gps,            //4
                    'patente' => $patente,        //5
                    'marca'   => $marca,          //6
                    'modelo'  => $modelo,         //7
                    'coduser' => $coduser,        //8
                    'dist'    => $dist,           //9
                    'segs'    => $segs,           //10
                    'kmseg'   => $KmSeg,          //11
                    'kmhora'  => $KmHora,         //12
                    'hora1'   => $hora1,          //13
                    'hora2'   => $hora2,          //14
                    'vel'     => $max
                );
            }
        }

        mysql_free_result($result);

        return $arr;
    }

    function maxVelocidad1($fecha)
    {
        $arr   = array();
        $map = new GMap();

        $ff=split("/",$fecha);
        $fechafinal=$ff[2]."-".$ff[1]."-".$ff[0];

        $query = "
            SELECT *, UNIX_TIMESTAMP(concat(fecha,' ',DATE_FORMAT(hora,'%H:%i:%s'))) as stamp
            FROM geocodes
            where fecha = '$fechafinal'
            ORDER BY fecha, hora
        ";


        $result = mysql_query($query);
        $latPrv = 0;
        $lngPrv = 0;
        $timePrv = 0;

        while($row = mysql_fetch_assoc($result))
        {
            $lat     = $map->lat($row['lat']);
            $lng     = $map->lon($row['lon']);
            $hora    = $row['hora'];
            $gps     = $row['address'];
            $time    = $row['stamp'];
            $sql1    = mysql_query("SELECT * FROM user_autos where cod_id = $gps");
            $car     = @mysql_fetch_assoc($sql1);
            $dist    = round($map->distance($lat, $lng,$latPrv,$lngPrv),5);
            $segs    = $time - $timePrv;
            $KmSeg   = $segs>0 ?$dist/$segs :0;
            $KmHora  = round($KmSeg * 3600,2);
            $latPrv  = $lat;
            $lngPrv  = $lng;
            $timePrv = $time;

            if($KmHora > 20 && $segs < 3600)
            {
                $idx = "$timePrv,$time";
                $arr[$idx] = array(
                    'fecha'   => $fecha,          //0
                    'hora'    => $hora,           //1
                    'lat'     => $lat,            //2
                    'lng'     => $lng,            //3
                    'gps'     => $gps,            //4
                    'patente' => $car['patente'], //5
                    'marca'   => $car['MARCA'],   //6
                    'modelo'  => $car['MODELO'],  //7
                    'coduser' => $car['coduser'], //8
                    'dist'    => $dist,           //9
                    'segs'    => $segs,           //10
                    'kmseg'   => $KmSeg,          //11
                    'kmhora'  => $KmHora,         //12
                    'desde'   => $desde,          //13
                    'hasta'   => $hasta           //14
                );
            }
        }

        mysql_free_result($result);

        return $arr;
    }

    function vehiculoDetenido($fecha)
    {
        $arr = array();
        $map = new GMap();

        $ff  = split("/",$fecha);
        $fechafinal = $ff[2]."-".$ff[1]."-".$ff[0];

        $query = "
            SELECT u.cod_id, u.patente, u.marca, u.modelo,
                date_format( g.hora, '%H:%i' ) hora, g.otro1, g.otro2, g.lat, g.lon,
                UNIX_TIMESTAMP(concat(g.fecha,' ', DATE_FORMAT(g.hora,'%H:%i:%s'))) as stamp,
                UNIX_TIMESTAMP(concat(g.fecha,' ', DATE_FORMAT(g.hora,'%H:00:00'))) as desde,
                UNIX_TIMESTAMP(concat(g.fecha,' ', DATE_FORMAT(g.hora,'%H:59:59'))) as hasta,
                DATE_FORMAT(g.hora,'%H:00') hora1, DATE_FORMAT(g.hora,'%H:59') hora2
            FROM geocodes g, userautos u
            WHERE g.fecha = '$fechafinal'
              AND g.otro3 = u.cod_id
            group by date_format(g.hora,'%H:%i')
            ORDER BY g.fecha, g.hora
            ";

        $result  = mysql_query($query);
        $latPrv  = 0;
        $lngPrv  = 0;
        $timePrv = 0;
        $velPrv  = 0;

        while($row = mysql_fetch_assoc($result))
        {
            $lat     = $map->lat($row['lat']);
            $lng     = $map->lon($row['lon']);
            $hora    = $row['hora'];
            $hora1   = $row['hora1'];
            $hora2   = $row['hora2'];
            $idx     = $hora1.$hora2;
            $gps     = $row['address'];
            $time    = $row['stamp'];
            $desde   = $row['desde'];
            $hasta   = $row['hasta'];
            $patente = $row['patente'];
            $marca   = $row['marca'];
            $modelo  = $row['modelo'];
            $coduser = $row['coduser'];
            $dist    = round($map->distance($lat, $lng,$latPrv,$lngPrv),5);
            $segs    = $time - $timePrv;
            $KmSeg   = $segs>0 ?$dist/$segs :0;
            $KmHora  = $row['otro1'];//round($KmSeg * 3600,2);
            $latPrv  = $lat;
            $lngPrv  = $lng;
            $timePrv = $time;

            if(!defined($arr[$idx]))
                $min = 0;
            $min = ($KmHora == 0) ?$segs+$min :0;

            if($KmHora == 0)# && ereg('/[0-9]+\.[0-9]+/', $idx))
            {
                //$idx = "$timePrv,$time";
                $arr["$idx"] = array(
                    'fecha'   => $fecha,          //0
                    'hora'    => $hora,           //1
                    'lat'     => round($lat,5),   //2
                    'lng'     => round($lng,5),   //3
                    'gps'     => $gps,            //4
                    'patente' => $patente,        //5
                    'marca'   => $marca,          //6
                    'modelo'  => $modelo,         //7
                    'coduser' => $coduser,        //8
                    'dist'    => $dist,           //9
                    'segs'    => $min,           //10
                    'kmseg'   => $KmSeg,          //11
                    'kmhora'  => $KmHora,         //12
                    'hora1'   => $hora1,          //13
                    'hora2'   => $hora2,          //14
                    'vel'     => $max
                );
            }
        }

        mysql_free_result($result);

        return $arr;
    }

    function vehiculoDetenido1($fecha)
    {
        $arr        = array();
        $ff         = split("/",$fecha);
        $fechafinal = $ff[2]."-".$ff[1]."-".$ff[0];
        $query      = "
            SELECT g.lat, g.lon, g.hora, g.address, u.patente, u.marca, u.modelo, u.coduser,
                UNIX_TIMESTAMP(concat(g.fecha,' ',DATE_FORMAT(g.hora,'%H:%i:%s'))) as stamp
            FROM geocodes g, userautos u
            where g.fecha = '$fechafinal'
              and u.cod_id = g.address
            ORDER BY g.fecha, g.hora
        ";

        $result = mysql_query($query);
        $latPrv = 0;
        $lngPrv = 0;
        $timePrv = 0;

        while($row = @mysql_fetch_assoc($result))
        {
            $lat     = $row['lat'];
            $lng     = $row['lon'];
            $hora    = $row['hora'];
            $gps     = $row['address'];
            $time    = $row['stamp'];
            $segs    = $time - $timePrv;
            $KmSeg   = $segs>0 ?$dist/$segs :0;
            $KmHora  = round($KmSeg * 3600,2);
            $latPrv  = $lat;
            $lngPrv  = $lng;
            $timePrv = $time;

            if($KmHora < 0.1 && 0 < $segs &&  $segs < 3600)
            {
                $idx = "$timePrv,$time";
                $arr[$idx] = array(
                    //'fecha'   => $fecha,          //0
                    'hora'    => $hora,           //1
                    'lat'     => $lat,            //2
                    'lng'     => $lng,            //3
                    'gps'     => $gps,            //4
                    'patente' => $row['patente'], //5
                    'marca'   => $row['marca'],   //6
                    'modelo'  => $row['modelo'],  //7
                    'coduser' => $row['coduser'], //8
                    'dist'    => $dist,           //9
                    'segs'    => $segs,           //10
                    'kmseg'   => $KmSeg,          //11
                    'kmhora'  => $KmHora          //12
                );
            }
        }

        mysql_free_result($result);

        return $arr;
    }

    function DistanciaRecorrida($patente, $fecha) /* $fecha1 ^ $fecha2 => dd/mm/yyyy hh:mi */
    {
        $map = new GMap();
        $arr = array();
        $math = new Math_Stats();

        $fechainicial = preg_replace('/(\d+)[\/\-](\d+)[\/\-](\d+)/', '$3-$2-$1 00:00:00', $fecha);
        $fechafinal   = preg_replace('/(\d+)[\/\-](\d+)[\/\-](\d+)/', '$3-$2-$1 23:59:59', $fecha);

        /*$query = "
            SELECT
                u.cod_id, g.lat, g.lon, g.hora, g.address, u.patente,
                u.marca, u.modelo, u.coduser, g.otro1, g.otro2,
                date_format( g.hora, '%H:%i' ) hora,
                UNIX_TIMESTAMP(concat(g.fecha,' ', DATE_FORMAT(g.hora,'%H:%i:%s'))) as stamp,
                UNIX_TIMESTAMP(concat(g.fecha,' ', DATE_FORMAT(g.hora,'%H:00:00'))) as desde,
                UNIX_TIMESTAMP(concat(g.fecha,' ', DATE_FORMAT(g.hora,'%H:59:59'))) as hasta,
                DATE_FORMAT(g.hora,'%H:00') hora1, DATE_FORMAT(g.hora,'%H:59') hora2
            FROM geocodes g, userautos u
            where
              UNIX_TIMESTAMP(concat(g.fecha,' ',DATE_FORMAT(g.hora,'%H:%i:%s'))) between
                    UNIX_TIMESTAMP('$fechainicial') and UNIX_TIMESTAMP('$fechafinal')
              and u.cod_id = g.address
              and g.otro1 !=0
              and u.patente = '$patente'
            ORDER BY g.fecha, g.hora
        ";*/

        $query = "
            SELECT
                u.cod_id, g.lat, g.lon, g.hora, g.address, u.patente,
                u.marca, u.modelo, u.coduser, g.otro1, g.otro2, u.LxKM,
                date_format( g.hora, '%H:%i' ) hora,
                UNIX_TIMESTAMP(concat(g.fecha,' ', DATE_FORMAT(g.hora,'%H:%i:%s'))) as stamp,
                UNIX_TIMESTAMP(concat(g.fecha,' ', DATE_FORMAT(g.hora,'%H:00:00'))) as desde,
                UNIX_TIMESTAMP(concat(g.fecha,' ', DATE_FORMAT(g.hora,'%H:59:59'))) as hasta,
                DATE_FORMAT(g.hora,'%H:00') hora1, DATE_FORMAT(g.hora,'%H:59') hora2
            FROM geocodes g, userautos u
            where
              UNIX_TIMESTAMP(concat(g.fecha,' ',DATE_FORMAT(g.hora,'%H:%i:%s'))) between
                    UNIX_TIMESTAMP('$fechainicial') and UNIX_TIMESTAMP('$fechafinal')
              and u.cod_id = g.address
              and g.otro1 !=0
              and u.patente = '$patente'
            ORDER BY g.fecha, g.hora
        ";

        $result  = mysql_query($query);
        $latPrv  = 0;
        $lngPrv  = 0;
        $timePrv = 0;
        $velPrv  = 0;
        $accTime = 0;
        $accDist = 0;
		$horaPrv = '';

        while($row = mysql_fetch_assoc($result))
        {
            $lat     = $row['lat'] < 0 ?$row['lat'] :$map->lat($row['lat']);
            $lng     = $row['lat'] < 0 ?$row['lon'] :$map->lon($row['lon']);
            $time    = $row['stamp'];

            $latPrv  = $latPrv == 0  ?$lat :$latPrv;
            $lngPrv  = $lngPrv == 0  ?$lng :$lngPrv;
            $segs    = $timePrv == 0 ?0    :$time - $timePrv;

            $dist    = round($map->distance($lat, $lng,$latPrv,$lngPrv),5);

            $hora    = $row['hora'];
            $hora1   = $row['hora1'];
            $hora2   = $row['hora2'];
            $idx     = $hora1;
            $gps     = $row['address'];
            $desde   = $row['desde'];
            $hasta   = $row['hasta'];
            $patente = $row['patente'];
            $marca   = $row['marca'];
            $modelo  = $row['modelo'];
            $coduser = $row['coduser'];
            $KmHora  = $row['otro1'];
            $LxKM    = $row['LxKM'];
            $latPrv  = $lat;
            $lngPrv  = $lng;
 
            if($LxKM == 0)
                $LxKM = 1;

            if($KmHora > 0)
            {
                if(!isset($arr["$idx"]))                
                    $arr["$idx"] = array(
                        'vel'        =>  array(),
                        'tiempo'     =>  array(),
                        'distancia'  =>  array(),
                        'extra'      =>  array()
                    );                 

                array_push($arr["$idx"]['vel'],$KmHora);
                array_push($arr["$idx"]['extra'],"$segs = $time - $timePrv ; $hora - $horaPrv");
                array_push($arr["$idx"]['tiempo'],$segs);
                array_push($arr["$idx"]['distancia'],$dist);

                $arr["$idx"]['hora']    = $hora;           //1
                $arr["$idx"]['lat']     = round($lat,5);   //2
                $arr["$idx"]['lng']     = round($lng,5);   //3
                $arr["$idx"]['gps']     = $gps;            //4
                $arr["$idx"]['patente'] = $patente;        //5
                $arr["$idx"]['marca']   = $marca;          //6
                $arr["$idx"]['modelo']  = $modelo;         //7
                $arr["$idx"]['coduser'] = $coduser;        //8
                $arr["$idx"]['hora1']   = $hora1;          //13
                $arr["$idx"]['hora2']   = $hora2;          //14

                $arr["$idx"]['i']++;

                $math->setData($arr["$idx"]['vel']);
                $arr["$idx"]['kmhora'] = round($math->median(),5);

                $math->setData($arr["$idx"]['tiempo']);
				$periodo = $math->sum();
                $arr["$idx"]['segs'] = ((int)($periodo/60)).' min '.($periodo%60).' seg';
                $accTime += $segs;

                $math->setData($arr["$idx"]['distancia']);
                $distancia = $math->sum();
                $arr["$idx"]['dist'] = round($distancia,5);
                $accDist += $dist;

                $arr["$idx"]['accTime'] = ((int)($accTime/60)).' min '.($accTime%60).' seg';
                $arr["$idx"]['accDist'] = $accDist;
                $arr["$idx"]['litros']  = round($accDist/$LxKM,3);
            }

           $timePrv = $time;
		   $horaPrv = $hora;
        }

        mysql_free_result($result);

        //print "<pre>$query</pre>";
//         print "<pre>";
//         print_r($arr);
//         print "</pre>";

        return $arr;
    }
}
?>
