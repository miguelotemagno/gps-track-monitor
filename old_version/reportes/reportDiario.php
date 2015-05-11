<?php ob_start();
session_start();
require('../controlador/Geocodes.php');
require ('../controlador/mysql.php');+

$id=$_SESSION["cod"];
$patente=$_GET["patente"];
$fecha=$_GET["fecha"];


$date2=split(" ",$fecha);
$fecha= $date2[0];
$ff=split("/",$fecha);
$fechafinal=$ff[2]."-".$ff[1]."-".$ff[0];

$g=new Geocodes();
$arr=$g->getPorDia($id, $patente, $fechafinal);


?>
<div>
<table id="diario" border="0" cellspacing="1" bgcolor="black">
    <thead>
        <tr style="color: white">
            <!--th>Fecha</th-->
            <th>Id</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Cantidad</th>

        </tr>
    </thead>
    <tbody>
    <?php foreach($arr as $i){?>
        <tr>
            <td bgcolor="white"><?php echo $i['address'];?></td>
            <td bgcolor="white"><?php echo $i['fecha'];?></td>
            <td bgcolor="white"><?php echo $i['hora'].':00 hrs';?></td>
            <td bgcolor="white"><?php echo $i['cantidad'].' Registros';?></td>


        </tr>
    <?php }?>
    </tbody>
</table>    <img src="img/blank.gif" onload="transformarDia();">
</div>