<?php
include ('../vista/menpanel.php');
$p=new MenuMap();
if ($_REQUEST['op']=="3"){
    echo "<img src='img/blank.gif' onload='DataCompu();'>";


$html='   <table id="Computadores"></table>
<div id="Pcompu"></div>';
echo $p->DefauldDialogo('computadores', 'Consultas/Informes Inventario', $html);
echo $p->GetJSScript('computadores', 'computadores', 500, 800, 'false', $show, $hide, 'false', 'false', 'OK', $NomBoton2, $func1, $func2, 'center');
}
if($_REQUEST['op']=="1"){echo'<img src="img/blank.gif" onload="Bote();newmenu();"></img><div class="demo">';
    if ($_SESSION["tipo"]>=10){
        echo $p->CrearBoton('Conf', 'Configuracion', 'cargarPagina(\'controlador/demo.php?op=17\',\'pageContent\');cerrarmapa();');
        echo $p->MenuNew('MapaM', 'Control Mapa', 'Ir a Panel Mapa', 'document.location=\'Mapa.php\'');
        echo $p->MenuNew('AutoM', 'Configurar Vehiculos', 'Ver-Estadistica', 'cargarPagina(\'controlador/demo.php?op=19\',\'pageContent\');cerrarmapa();');
        echo $p->MenuNew('alertasM', 'Configurar Alertas', 'Hora-Velocidad','cargarPagina(\'controlador/demo.php?op=15\',\'pageContent\');cerrarmapa();-cargarPagina(\'controlador/demo.php?op=14\',\'pageContent\');cerrarmapa();');
        echo $p->MenuNew('ReportesM', 'Ver Reportes', 'Velocidad Maxima-Vehic. Detenido-Fuera de Hora-Historial','cargarPagina(\'controlador/nada.php\',\'pageContent\');velmax();cerrarmapa();-cargarPagina(\'controlador/nada.php\',\'pageContent\');veldetenido();dd();cerrarmapa();- -cargarPagina(\'controlador/demo.php?op=18\',\'pageContent\');cerrarmapa();');
        }
     else{if ($_SESSION["tipo"]>=5){
        
        
        

        
        
        echo $p->MenuNew('alertasM', 'Configurar Alertas', 'Hora-Velocidad','cargarPagina(\'controlador/demo.php?op=15\',\'pageContent\');cerrarmapa();-cargarPagina(\'controlador/demo.php?op=14\',\'pageContent\');cerrarmapa();');
        echo $p->MenuNew('ReportesM', 'Ver Reportes', 'Velocidad Maxima-Vehic. Detenido-Distancia Recorrida-Fuera de Hora-Historial','cargarPagina(\'controlador/nada.php\',\'pageContent\');velmax();cerrarmapa();-cargarPagina(\'controlador/nada.php\',\'pageContent\');veldetenido();cerrarmapa();-cargarPagina(\'controlador/nada.php\',\'pageContent\');velrecorrido();cerrarmapa();- -cargarPagina(\'controlador/demo.php?op=18\',\'pageContent\');cerrarmapa();');
        echo $p->MenuNew('MapaM', 'Control Mapa', 'Ir a Panel Mapa', 'document.location=\'Mapa.php\'');
        echo $p->MenuNew('AutoM', 'Configurar Vehiculos', 'Ver-Estadistica', 'cargarPagina(\'controlador/demo.php?op=19\',\'pageContent\');cerrarmapa();');
     }
     }
echo'<br><br>
	<div id="admpanel"></div>

</div>';}
if($_REQUEST['op']=="14"){
echo "<img src='img/blank.gif' onload='DataAlertas();'>";


$html='   <table aling="center" id="alert_vel"></table>
<div id="Palerta"></div><div id="speed_div"></div>';
echo $p->DefauldDialogo('alerta', 'Consultas/Informes Inventario', $html);
echo $p->GetJSScript('alerta', 'alerta', 500, 800, 'false', $show, $hide, 'false', 'false', 'OK', $NomBoton2, $func1, $func2, 'center');
}
if($_REQUEST['op']=="15"){
echo "<img src='img/blank.gif' onload='DataAlertasH();'>";


$html='   <table id="alert_hora"></table>
<div id="PalertaH"></div><div id="speed_div"></div>';
echo $p->DefauldDialogo('alertaH', 'Consultas/Informes Inventario', $html);
echo $p->GetJSScript('alertaH', 'alertaH', 500, 800, 'false', $show, $hide, 'false', 'false', 'OK', $NomBoton2, $func1, $func2, 'center');
}
if($_REQUEST['op']=="17"){
echo "<img src='img/blank.gif' onload='DataConfiguracion();'>";


$html='   <table id="configuracion"></table>
<div id="Pconfiguracion"></div><div id="speed_div"></div>';
echo $p->DefauldDialogo('configuracions', 'Consultas/Informes Inventario', $html);
echo $p->GetJSScript('configuracion', 'alerta', 500, 800, 'false', $show, $hide, 'false', 'false', 'OK', $NomBoton2, $func1, $func2, 'center');
}
if($_REQUEST['op']=="18"){
echo "


<img src='img/blank.gif' onload='sindata();DataGeo();'>";


$html='   <table id="geocodes"></table>
<div id="Pgeo"></div>


<div id="speed_div"></div> ';
echo $p->DefauldDialogo('geo', 'Consultas/Informes Inventario', $html);
echo $p->GetJSScript('configuracion', 'alerta', 500, 800, 'false', $show, $hide, 'false', 'false', 'OK', $NomBoton2, $func1, $func2, 'center');
}
if($_REQUEST['op']=="19"){
echo "<img src='img/blank.gif' onload='DataAuto();'>";


$html='   <table id="usuerautos"></table>
<div id="Pauto"></div><div id="speed_div"></div>';
echo $p->DefauldDialogo('auto', 'Consultas/Informes Inventario', $html);
echo $p->GetJSScript('auto', 'auto', 500, 800, 'false', $show, $hide, 'false', 'false', 'OK', $NomBoton2, $func1, $func2, 'center');
}
?>
