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

?><div>
<table id="detenido" border="0" cellspacing="1" bgcolor="black">
    <thead>
        <tr style="color: white">
            <!--th>Fecha</th-->
            <th>Desde</th>
            <th>Hasta</th>
            <th>Auto</th>
            <th>Modelo</th>
            <th>Patente</th>
            <th>Segs</th>
            <th>Latitud</th>
            <th>Longitud</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($arr as $i){?>
        <tr>
            <!--td bgcolor="white"><?php echo $i['fecha'];?></td-->
            <td bgcolor="white"><?php echo $i['hora1'];?></td>
            <td bgcolor="white"><?php echo $i['hora2'];?></td>
            <td bgcolor="white"><?php echo $i['marca'];?></td>
            <td bgcolor="white"><?php echo $i['modelo'];?></td>
            <td bgcolor="white"><?php echo $i['patente'];?></td>
            <td bgcolor="white"><?php echo $i['segs'];?></td>
            <td bgcolor="white"><?php echo $i['lat'];?></td>
            <td bgcolor="white"><?php echo $i['lng'];?></td>
        </tr>
    <?php }?>
    </tbody>
</table>    <img src="img/blank.gif" onload="transformarDete();">
</div>