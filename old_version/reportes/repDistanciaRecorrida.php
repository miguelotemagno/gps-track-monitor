<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("Reportes.php");

$fecha1   = $_REQUEST['fecha1'];
$fecha2   = $_REQUEST['fecha2'];
$patente  = $_REQUEST['patente'];
$reportes = new Reportes();
$arr = $reportes->DistanciaRecorrida($patente, $fecha1, $fecha2);
/////////////////////////////////////////////////////////////////////////////
?><div>
<table id="vel" width="700" border="0" cellspacing="1" bgcolor="black">
    <thead>
        <tr style="color: white">
            <!--th>Fecha</th-->
            <th>Desde</th>
            <th>Hasta</th>
            <th>Auto</th>
            <th>Modelo</th>
            <th>Patente</th>
            <th>Tiempo</th>
            <th>Km/h</th>
            <th>Dist. Recorrida</th>
            <th>Tiempo Total</th>
            <th>Dist. Total</th>
            <th>Consumo Total</th>
            <th>Latitud</th>
            <th>Longitud</th>
        </tr>
    </thead>
    <tbody>
    <?php
    /*echo $arr;*/
    foreach($arr as $i){?>
        <tr>
            <!--td bgcolor="white"><?php echo $i['fecha'];?></td-->
            <td bgcolor="white"><?php echo $i['hora1'];?></td>
            <td bgcolor="white"><?php echo $i['hora2'];?></td>
            <td bgcolor="white"><?php echo $i['marca'];?></td>
            <td bgcolor="white"><?php echo $i['modelo'];?></td>
            <td bgcolor="white"><?php echo $i['patente'];?></td>
            <td bgcolor="white"><?php echo $i['segs'];?></td>
            <td bgcolor="white"><?php echo $i['kmhora'];?></td>
            <td bgcolor="white"><?php echo $i['dist'];?> km</td>
            <td bgcolor="white"><?php echo $i['accTime'];?></td>
            <td bgcolor="white"><?php echo $i['accDist'];?> km</td>
            <td bgcolor="white"><?php echo $i['litros'];?> lt</td>
            <td bgcolor="white"><?php echo $i['lat'];?></td>
            <td bgcolor="white"><?php echo $i['lng'];?></td>
        </tr>
    <?php }?>
    </tbody>
</table>
    <img src="img/blank.gif" onload="transformar();">
</div>
