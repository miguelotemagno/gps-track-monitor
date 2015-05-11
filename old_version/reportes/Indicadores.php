<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("../controlador/mysql.php");
require_once("../modelo/gmp1_1_1.php");
/**
 * Description of Indicadores
 *
 * @author miguel
 */
class Indicadores
{
    var $dia;
    var $semana;
    var $mes;
    var $year;
    var $factor;
    var $velMax;
    var $velMed;
    var $funciones;
    static var $latitud  = 0;
    static var $longitud = 0;
    static var $tiempo   = 0;

    //put your code here
    function __construct()
    {
        $dia    = 3600*24;
        $semana = 7*$dia;
        $mes    = 4*$semana;
        $year   = 365*$dia;
        $factor = 2*$years + 4*$mes;
        $velMax  = 100;
        $velMed  = 70;
        $funciones = ('velocidadMaxima','detenido');
    }

    function revisar()
    {


        $query = "
            select g.*,u.patente,u.coduser,
                UNIX_TIMESTAMP(concat(fecha,' ',DATE_FORMAT(hora,'%H:%I:%S'))) as stamp
            from 
                geocodes g,user_autos u
            where
                g.otro3 = u.cod_id and
                unix_timestamp(now()) between
                UNIX_TIMESTAMP(concat(fecha,' ',DATE_FORMAT(hora,'%H:%I:%S'))) + $factor and
                UNIX_TIMESTAMP(concat(fecha,' ',DATE_FORMAT(hora,'%H:%I:%S'))) + $factor + $hora/2
            ";

        $result    = mysql_query($query);
        $indicador = 0;

        while($row = mysql_fetch_assoc($result))
            for($i=0; sizeof($funciones); $i++)
            {
                $resultado = 0;
                eval('$resultado='.$funciones[$i].'($row,$latitud,$longitud,$tiempo);');
                $indicador += $resultado;
            }
        
    }

    function velocidadMaxima($row,$latPrv,$lngPrv,$timePrv)
    {
        $lat     = $row['lat'];
        $lng     = $row['lon'];
        $hora    = $row['hora'];
        $gps     = $row['address'];
        $time    = $row['stamp'];
        $vel     = $row['otro1'];
        $patente = $row['patente'];
        $iduser  = $row['iduser'];

        $dist    = round($this->getDistance($latPrv, $lngPrv, $lat, $lng),5);
        $segs    = $time - $timePrv;
        $KmSeg   = $segs>0 ?$dist/$segs :0;
        $KmHora  = round($KmSeg * 3600,2);
        $latPrv  = $lat;
        $lngPrv  = $lng;
        $timePrv = $time;

        if($KmHora > $velMax && $segs < 3600)
        {
            array_push($queries, "
                insert into eventos
                    (fecha,latitud,longitud,velocidad,patente,activo)
                values (now(),$lat,$long,$KmHora,$patente,1)
                ");
            return 1;
        }
            

        return 0;
    }

    function detenido($row,$lati,$long,$timePrv)
    {
        $lat     = $row['lat'];
        $lng     = $row['lon'];
        $hora    = $row['hora'];
        $gps     = $row['address'];
        $time    = $row['stamp'];
        $vel     = $row['otro1'];

        $dist    = round($this->getDistance($latPrv, $lngPrv, $lat, $lng),5);
        $segs    = $time - $timePrv;
        $KmSeg   = $segs>0 ?$dist/$segs :0;
        $KmHora  = round($KmSeg * 3600,2);
        $latPrv  = $lat;
        $lngPrv  = $lng;
        $timePrv = $time;

        if($KmHora < 0.1 && 0 < $segs &&  $segs < 3600)
            return 1;

        return 0;
    
    }
}

?>
