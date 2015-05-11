<?php ob_start();
session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?PHP
define('GMAP_LIB_PATH',dirname(__FILE__).'/lib/');require('controlador/AddControlador.php'); require('controlador/loadConsultas.php');require('vista/menpanel.php');$crear=new MenuMap();
require_once(GMAP_LIB_PATH.'GMap.class.php');

$gMap = new GMap();

  




/*
            foreach ($coordinates as $key=>$coordinate)
            {
              // parameters: lat, lng, marker's javascript object's name, icon object
              $gMapMarker = new GMapMarker($coordinate[0],$coordinate[1],array('icon' => $icon));
              $gMapMarker->addHtmlInfoWindow('<b>Coordinates:</b><br />'.implode(', ',$coordinate));
              // will add a custom property to the marker's javascript object
              $gMapMarker->setCustomProperty('num',$key);
              // binds the event listeners to the marker
        $gMapMarker->addEvent(new GMapEvent('click', 'map.setZoom(8);'));

              $gMap->addMarker($gMapMarker);
            }

*/


    // Initialize GMapDirection
   // $direction = new GMapDirection($paris, $bordeaux, 'direction_sample', array('optimizeWaypoints'=>true,'panel' => "document.getElementById('direction_pane')"));
    //$gMap->addDirection($direction);



?>
<?php require_once(GMAP_LIB_PATH.'helper/GMapHelper.php'); ?>
<script type="text/javascript" src="js/add.js"></script>
<?php include_google_map_javascript_file($gMap); ?>




<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.1.custom.min.js"></script>
<script type="text/javascript" src="js/ui-combobox.js"></script>

<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />
<link type="text/css" href="css/redmond/jquery-ui-1.8.1.custom.css" rel="stylesheet" />
<script src="js/jquery.bgiframe.js" type="text/javascript"></script>



     <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemasmicrosoft-com:vml">
<script type="text/javascript" src="js/add2.js"></script>
  

<!-- Contact Form CSS files -->


		
	<script type="text/javascript" src="js/jquery.livequery.js"></script>
        <link rel="stylesheet" type="text/css" href="compassdatagrid.css" />
<link rel="stylesheet" type="text/css" href="demo.css" />
<link href="front.css" media="screen, projection" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/vtip.js"></script>

<link rel="stylesheet" type="text/css" href="css/vtip.css" />
  <script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAXvGTDI-e-NjiBd7OSTbVCBTXLs1J0DuPEl5LRYB5DShTb4c5zRRBR9zvNXpxbJPQrxocKJA3ht9o0g"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.ptTimeSelect.css" />
<script type="text/javascript" src="js/jquery.ptTimeSelect.js"></script>
<script type="text/javascript" src="table2CSV.js"></script>
<link rel="stylesheet" type="text/css" href="msdropdown/dd.css" />

<script type="text/javascript" src="msdropdown/js/uncompressed.jquery.dd.js"></script>
  <script type="text/javascript" src="js/fg.menu.js"></script>
<script src="js/jquery.multiselect.js" type="text/javascript"></script>
<link href="css/jquery.multiselect.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="css/fg.menu.css" media="screen" rel="stylesheet" />
    <script type="text/javascript">
        function newmenu(){
    $(function(){
    	// BUTTONS
    

    	// MENUS
		$('#alertasM').menu({
			content: $('#alertasM').next().html(), // grab content from this page
			showSpeed: 400


		});
                	$('#ReportesM').menu({
			content: $('#ReportesM').next().html(), // grab content from this page
			showSpeed: 400


		});
       	$('#AutoM').menu({
			content: $('#AutoM').next().html(), // grab content from this page
			showSpeed: 400


		});
                     	$('#MapaM').menu({
			content: $('#MapaM').next().html(), // grab content from this page
			showSpeed: 400


		});
		

		// or from an external source
		


    });}
    </script>
<script type="text/javascript" >
    <?php echo $crear->GridDinamica('DataAlertas','alert_vel','Palerta','alerta','alert_vel','','','700','100','cargando alertas...'); ?>
        <?php echo $crear->GridDinamica('DataAlertasH','alert_hora','PalertaH','alertaH','alert_hora','','','700','100',''); ?>
        <?php echo $crear->GridDinamica('DataConfiguracion','configuracion','Pconfiguracion','configuracions','configuracion','','','700','100',''); ?>
        <?php echo $crear->GridDinamica('DataGeo','geocodes','Pgeo','geo','geocodes','','','900','200','Cargando Direcciones...'); ?>
            <?php echo $crear->GridDinamica('DataAuto','usuerautos','Pauto','auto','userautos','','','730','100',''); ?>

      var lat,lon;
  google.load("maps", "2.x");


  	$(document).ready(function(){
            $("#websites3").msDropDown();

		$('.super').click(function(){
			$('#pageContent').fadeOut();
			var a = $(this).attr('id');
			$.post("ajax_page.php?id="+a, {
			}, function(response){
				//$('#container').html(unescape(response));
				///$('#container').fadeIn();
				setTimeout("finishAjax('pageContent', '"+escape(response)+"')", 400);
			});
		});
	});
	




  function cerrarmapa(){
      $(function() {
      $('#historial').dialog('close');});
      var lm=document.getElementById('map');
        lm.style.width="0px;";
        lm.style.height="0px";
      cargarPagina('controlador/nada.php','map');
  }
  function mapa(){
      historial();
  

  var lm=document.getElementById('map');
        lm.style.width="300px;";
        lm.style.height="200px";

 $(document).ready(function(){
				var map = new GMap2($("#map").get(0));
				var burnsvilleMN = new GLatLng(lat,lon);
				map.setCenter(burnsvilleMN, 15);
                                
                                    

				// setup 10 random points
				
				var markers = [];
				
					marker = new GMarker(burnsvilleMN);
					map.addOverlay(marker);
					markers[0] = marker;
				

				$(markers).each(function(i,marker){
					$("<li />")
						.html("Point "+i)
						.click(function(){
							displayPoint(marker, i);
						})
						.appendTo("#list");

					GEvent.addListener(marker, "click", function(){
						displayPoint(marker, i);
					});
				});

				$("#message").appendTo(map.getPane(G_MAP_FLOAT_SHADOW_PANE));

				function displayPoint(marker, index){
					$("#message").hide();

					var moveEnd = GEvent.addListener(map, "moveend", function(){
						var markerOffset = map.fromLatLngToDivPixel(marker.getLatLng());
						$("#message")
							.fadeIn()
							.css({ top:markerOffset.y, left:markerOffset.x });

						GEvent.removeListener(moveEnd);
					});
					map.panTo(marker.getLatLng());
				}
			});
  }
function transformar(){
 tableToGrid("#vel");}
function transformarDete(){
 tableToGrid("#detenido");}
</script>

 <style></style>

</head>
    <script>

function sindata(){
jQuery("#op").click( function() {
    var url=jQuery('#Geo').jqGrid('getGridParam','url');
    jQuery("#Geo").jqGrid('setGridParam',{url:url+'&geocodes&dataOP=id-lon-lat'}).trigger("reloadGrid");
});
}</script>
<body>
<?php

if (!isset($_SESSION["nombre"])){
echo $crear->login('1', 'Ingrese al sistema');
}
else{
echo $crear->login('0', 'Cerrar Session: '.$_SESSION["nombre"]);}?>
<script type="text/javascript">

        $(document).ready(function() {
$('#fechmax').datepicker({
    	duration: '',
        showTime: true,
        constrainInput: false,
        stepMinutes: 1,
        stepHours: 1,
        altTimeField: '',
        time24h: true,
        changeMonth: true,
			changeYear: true,
                        onClose:function() {

                            //searchLocationsNear("g",document.getElementById('datepicker').value);
                            /*var contentString="";
                            var vertices = flightPath.getPath();

                              for (var i =0; i < vertices.length; i++) {
    var xy = vertices.getAt(i);
    contentString += "<br />" + "Coordinate: " + i + "<br />" + xy.lat() +"," + xy.lng();
  }


                            alert(contentString);*/ }
     });
     $('#fechdetenido').datepicker({
    	duration: '',
        showTime: true,
        constrainInput: false,
        stepMinutes: 1,
        stepHours: 1,
        altTimeField: '',
        time24h: true,
        changeMonth: true,
			changeYear: true,
                        onClose:function() {

                            //searchLocationsNear("g",document.getElementById('datepicker').value);
                            /*var contentString="";
                            var vertices = flightPath.getPath();

                              for (var i =0; i < vertices.length; i++) {
    var xy = vertices.getAt(i);
    contentString += "<br />" + "Coordinate: " + i + "<br />" + xy.lat() +"," + xy.lng();
  }


                            alert(contentString);*/ }
     });
          $('#fechrecorrido').datepicker({
    	duration: '',
        showTime: true,
        constrainInput: false,
        stepMinutes: 1,
        stepHours: 1,
        altTimeField: '',
        time24h: true,
        changeMonth: true,
			changeYear: true,
                        onClose:function() {

                            //searchLocationsNear("g",document.getElementById('datepicker').value);
                            /*var contentString="";
                            var vertices = flightPath.getPath();

                              for (var i =0; i < vertices.length; i++) {
    var xy = vertices.getAt(i);
    contentString += "<br />" + "Coordinate: " + i + "<br />" + xy.lat() +"," + xy.lng();
  }


                            alert(contentString);*/ }
     });

            $(".signin").click(function(e) {
				e.preventDefault();
                $("fieldset#signin_menu").toggle();
				$(".signin").toggleClass("menu-open");
            });

			$("fieldset#signin_menu").mouseup(function() {
				return false
			});
			$(document).mouseup(function(e) {
				if($(e.target).parent("a.signin").length==0) {
					$(".signin").removeClass("menu-open");
					$("fieldset#signin_menu").hide();
				}
			});

        });

</script>

<div id="rounded">
    <img src="img/top_bg.gif" alt="top" width="100%" /><div id="main" class="container">
    <h1>Geolocalizacion Vehiculos</h1>
    <h2></h2>


    <div class="clear"></div>
       <div id="menunew5">

        </div>
 <div id="verificar"></div>
 <script>
 function xls(){

$('#Geo').table2CSV({
	header:['prefix','Employee Name','Contact']
});
 }</script>
 <div id="main"></div>
 <div id="exportdata"></div>
 <div id="exportform"></div>
    

  
    <div id="pageContent">
    

    </div>
 <a id="expample" onclick="xls();" href="#">prueba excel</a>
    <div class="clear"></div>

</div>

</div>
    <div id="nada"></div>
</body>
    <?php
    //include('Dialogos.php');
    //$Aplicacion=new Modelo();
    //echo $Aplicacion->ConsultasDialogo();
?>
<script>
    var vehiculosElegidos="";
    cargarPagina('controlador/demo.php?op=1','menunew5');
function Bote(){
    $(function() {
		$("button, input:submit, a", ".demo").button();

		$("a", ".demo").click(function() { return false; });
	});
    }
    function CloseSession(){
        cargarPagina('controlador/cerrarsesion.php','nada');
 document.location="index.php";
   
}
 function dd(){


                var $callback = $("#callback");
            $("#example5").multiSelect({

    		onCheck: function(){
			
                        vehiculosElegidos=this.value;
		},
		onOpen: function(){
			
		},
		onCheckAll: function(){
			
		},
		onUncheckAll: function(){
			
		},

               

multiple: false,noneSelectedText:'Seleccionar Patente',minWidth: 225,
		showHeader: false,

    shadow:true });

                }
                
</script>
</html>
<?php
$fun='';
echo $crear->DefauldDialogo('historial', 'MiniMapa', '<div id="map"></div>');
$fun='
var lm=document.getElementById(\'fechmax\');
sindata();
';
echo $crear->GetJSScript('historial', 'historial', 300, 300, 'false', $show, $hide, 'true', 'true', 'CerrarMapa', $NomBoton2, $fun, $func2, 'left');





echo $crear->DefauldDialogo('reporteMax', 'Ingrese Fecha', '<input id="fechmax" type="text" name="fechamax" value="" />');
$fun='
var lm=document.getElementById(\'fechmax\');

cargarPagina(\'reportes/repMaxVelocidad.php?fecha=\'+lm.value,\'pageContent\');';
echo $crear->GetJSScript('velmax', 'reporteMax', 150, 200, 'true', $show, $hide, 'false', 'false', 'Consultar', $NomBoton2, $fun, $func2, $posicion);


require('controlador/addpatente.php');

$pate=new PatenteV();
$rs=$pate->getpatentes();
echo $crear->DefauldDialogo('reporteRecorrida', 'Ingrese Patente/Hora', $rs.'<br><br><input id="fechrecorrido" type="text" name="fechamax" value="" /><img src="img/blank.gif" onload="dd();" />');

$fun='
var lm2=document.getElementById(\'fechrecorrido\');
if (vehiculosElegidos.length > 0 & lm2.value.length>0){
var pate = vehiculosElegidos;

cargarPagina(\'reportes/repDistanciaRecorrida.php?patente=\'+pate+\'&fecha1=\'+lm2.value,\'pageContent\');}
else{Cantidad_Seleccionada();

}';
echo $crear->GetJSScript('velrecorrido', 'reporteRecorrida', 300, 300, 'true', $show, $hide, 'true', 'true', 'Consultar', $NomBoton2, $fun, $func2, $posicion);





echo $crear->DefauldDialogo('reporteDetenido', 'Ingrese Fecha', '<br><input id="fechdetenido" type="text" name="fechamax" value="" />');

$fun='
var lm2=document.getElementById(\'fechdetenido\');


cargarPagina(\'reportes/repVehiculoDetenido.php?fecha=\'+lm2.value,\'pageContent\');


';
echo $crear->GetJSScript('veldetenido', 'reporteDetenido', 200, 200, 'true', $show, $hide, 'true', 'true', 'Consultar', $NomBoton2, $fun, $func2, $posicion);




echo $crear->DefauldDialogo('Cantidad_Seleccionada', 'Falta Vehiculo', 'Seleccion una Patente / Fecha');
echo $crear->GetJSScript('Cantidad_Seleccionada', 'Cantidad_Seleccionada', 200, 200, 'true', $show, $hide, 'false', 'false', 'Continuar', $NomBoton2, '', '', $posicion);



$html='';
echo $crear->DefauldDialogo('HistorialDiv', 'Opciones a Ver', '');
$fun='
var lm2=document.getElementById(\'fechdetenido\');
cargarPagina(\'reportes/repVehiculoDetenido.php?fecha=\'+lm2.value,\'pageContent\');';
//echo $crear->GetJSScript('veldetenido', 'reporteDetenido', 150, 200, 'true', $show, $hide, 'false', 'false', 'Consultar', $NomBoton2, $fun, $func2, $posicion);

$con=new AddControlador();
$js="jQuery(\"#Alert_vel\").trigger(\"reloadGrid\"); ";
echo $crear->DefauldDialogo("alert_veladd", "nuevo", $con->getData('alert_vel'));
echo $crear->GetJSScript("alert_veljsadd", "alert_veladd", '400', '500', 'true', $show, $hide, true, true, 'guardar', $NomBoton2, $js, $func2, $posicion);


        ?>

<link rel="stylesheet" type="text/css" media="screen" href="themes/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" media="screen" href="themes/ui.multiselect.css" />

<!-- Of course we should load the jquery library -->


<script src="js/jquery.layout.js" type="text/javascript"></script>
<script src="js/i18n/grid.locale-sp_1.js" type="text/javascript"></script>
<script type="text/javascript">
	$.jgrid.no_legacy_api = true;
	$.jgrid.useJSON = true;
</script>
<script src="js/ui.multiselect.js" type="text/javascript"></script>
<script src="js/jquery.jqGrid.min.js" type="text/javascript"></script>
<script src="js/jquery.tablednd.js" type="text/javascript"></script>
<script src="js/jquery.contextmenu.js" type="text/javascript"></script>
<script src="js/jquery.tipsy.js" type="text/javascript"></script>
<?php if (!isset($_SESSION["nombre"])){?>



<script type='text/javascript'>

    $(function() {
        
	  $('#forgot_username_link').tipsy({gravity: 'w'});
    });
  </script>

<script>

function addEvent(obj, evType, fn, useCapture){

 if (obj.addEventListener){
    obj.addEventListener(evType, fn, useCapture);

  } else if (obj.attachEvent){
    obj.attachEvent("on"+evType, fn);

  } else {
   obj['on'+evType]=fn;
  }
}

function hablar(e)
{

}


function login(){

    // Coloco el evento click
    addEvent(document.getElementById('loggg'), 'click', hablar, false);
    // Lo lanzo forzosamente
    if( document.fireEvent ) {                            // IE
        document.getElementById('loggg').fireEvent("onclick");
    }
    else if( document.dispatchEvent ) {                    // estándar
        var evObj = document.createEvent('MouseEvents');                                // creamos el evento de tipo MouseEvents
        evObj.initMouseEvent( 'click', true, true, window, 1, 12, 345, 7, 220, false, false, true, false, 0, null );    // le damos características
        document.getElementById('loggg').dispatchEvent(evObj);
    }
    else
        alert("No puedo lanzar evento");
}

 </script>

<?php }else {}?>
