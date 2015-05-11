<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("Reportes.php");

///////////////////////////////////////////////////////////////////////////////

$fecha = $_REQUEST['fecha'];
$reportes = new Reportes();
$arr = $reportes->vehiculoDetenido($fecha);

?>
<table border="0" cellspacing="1" bgcolor="black">
    <thead>
        <tr style="color: white">
            <th>Fecha</th>
            <th>Hora</th>
            <th>Auto</th>
            <th>Modelo</th>
            <th>Patente</th>
            <th>Segs</th>
            <th>Dist</th>
            <th>Km/h</th>
            <th>Lat.</th>
            <th>Long.</th>
        </tr>
    </thead>
    <tbody>
    <?foreach($arr as $i){?>
        <tr>
            <td bgcolor="white"><?=$i[0]?></td>
            <td bgcolor="white"><?=$i[1]?></td>
            <td bgcolor="white"><?=$i[6]?></td>
            <td bgcolor="white"><?=$i[7]?></td>
            <td bgcolor="white"><?=$i[5]?></td>
            <td bgcolor="white"><?=$i[10]?></td>
            <td bgcolor="white"><?=$i[9]?></td>
            <td bgcolor="white"><?=$i[12]?></td>
            <td bgcolor="white"><?=$i[2]?></td>
            <td bgcolor="white"><?=$i[3]?></td>
        </tr>
    <?}?>
    </tbody>
</table>
