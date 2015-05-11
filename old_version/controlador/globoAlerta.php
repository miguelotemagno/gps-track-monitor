<?php

require('mysql.php');
require('Solicitudes.php');

$crear=new Menusolicitudes();

$s=new Solicitudes();
$arr=$s->alertasGlobo();
foreach($arr as $i){
    $js="";
    $bot=str_replace('"', '\'', $crear->CrearBoton('alerta'.$i['id'], '', $js));
    echo '<img src="img/blank.gif" onload="createNewSticky(\'Nro'.$i['id'].'<br>Solicitante: '.utf8_encode($i['usuario']).'<br>Tipo Problema: '.$i['tipo'].'<br>Comentarios:'.$i['comentario'].'\');">"';
}

?>
