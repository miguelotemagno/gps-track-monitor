<?php
require('mysql.php');
require_once('Alertas.php');
$hora=$_GET["hora"];
$fecha=$_GET["fecha"];
$patente=$_GET["patente"];
$alerta=new Alertas();
$fecha=str_replace('<b>Fecha: </b>','',$fecha);
$fecha=str_replace('<br>','',$fecha);
$hora=str_replace('<b>Hora: </b>','',$hora);
$hora=str_replace('<br>','',$hora);
$patente=str_replace('<b>Patente: </b>','',$patente);
$patente=str_replace('<br>','',$patente);
$a=$alerta->verificarAlerta($patente, $fecha, $hora);
if ($a!=""){

    echo 'alerta_patente[]='.$patente.';
        alerta_fecha[]='.$fecha.';
            alerta_hora[]='.$hora.';<img src="img/blank.gif" onload="createNewSticky(\'Patente:'.$patente.'<br>Fecha: '.$fecha.'<br>Hora: '.$hora.'\');">';
}

?>
