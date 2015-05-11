<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("../controlador/mysql.php");
require_once("../modelo/gmp1_1_1.php");

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


    //put your code here
    function __construct()
    {
        $this->map = new GoogleMapAPI('map_canvas');
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
        $map = new GoogleMapAPI('map_canvas');

        $query = "
            SELECT *, UNIX_TIMESTAMP(concat(fecha,' ',DATE_FORMAT(hora,'%H:%I:%S'))) as stamp
            FROM geocodes
            where fecha = '$fecha'
            ORDER BY fecha, hora
        ";

        $result = mysql_query($query);
        $latPrv = 0;
        $lngPrv = 0;
        $timePrv = 0;

        while($row = mysql_fetch_assoc($result))
        {
            $lat     = $row['lat'];
            $lng     = $row['lon'];
            $hora    = $row['hora'];
            $gps     = $row['address'];
            $time    = $row['stamp'];
            $sql1    = mysql_query("SELECT * FROM user_autos where cod_id = $gps");
            $car     = mysql_fetch_assoc($sql1);
            $dist    = round($this->getDistance($latPrv, $lngPrv, $lat, $lng),5);
            $segs    = $time - $timePrv;
            $KmSeg   = $segs>0 ?$dist/$segs :0;
            $KmHora  = round($KmSeg * 3600,2);
            $latPrv  = $lat;
            $lngPrv  = $lng;
            $timePrv = $time;

            if($KmHora > 50 && $segs < 3600)
            {
                $idx = "$timePrv,$time";
                $arr[$idx] = array(
                    $fecha,          //0
                    $hora,           //1
                    $lat,            //2
                    $lng,            //3
                    $gps,            //4
                    $car['patente'], //5
                    $car['MARCA'],   //6
                    $car['MODELO'],  //7
                    $car['coduser'], //8
                    $dist,           //9
                    $segs,           //10
                    $KmSeg,          //11
                    $KmHora          //12
                );
            }
        }

        mysql_free_result($result);

        return $arr;
    }

    function vehiculoDetenido($fecha)
    {
        $arr   = array();

        $query = "
            SELECT *, UNIX_TIMESTAMP(concat(fecha,' ',DATE_FORMAT(hora,'%H:%I:%S'))) as stamp
            FROM geocodes
            where fecha = '$fecha'
            ORDER BY fecha, hora
        ";

        $result = mysql_query($query);
        $latPrv = 0;
        $lngPrv = 0;
        $timePrv = 0;

        while($row = mysql_fetch_assoc($result))
        {
            $lat     = $row['lat'];
            $lng     = $row['lon'];
            $hora    = $row['hora'];
            $gps     = $row['address'];
            $time    = $row['stamp'];
            $sql1    = mysql_query("SELECT * FROM user_autos where cod_id = $gps");
            $car     = mysql_fetch_assoc($sql1);
            $dist    = round($this->getDistance($latPrv, $lngPrv, $lat, $lng),5);
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
                    $fecha,          //0
                    $hora,           //1
                    $lat,            //2
                    $lng,            //3
                    $gps,            //4
                    $car['patente'], //5
                    $car['MARCA'],   //6
                    $car['MODELO'],  //7
                    $car['coduser'], //8
                    $dist,           //9
                    $segs,           //10
                    $KmSeg,          //11
                    $KmHora          //12
                );
            }
        }

        mysql_free_result($result);

        return $arr;
    }
}
?>
