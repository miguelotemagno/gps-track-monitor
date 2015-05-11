<?php ob_start();
session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
if (isset($_SESSION["nombre"])){
define('GMAP_LIB_PATH',dirname(__FILE__).'/lib/');
require_once(GMAP_LIB_PATH.'GMap.class.php');

$gMap = new GMap();

           $gMap->setZoom(13);

$gMap->setHeight('100%');
$gMap->setWidth('100%');

$gMap->setCenter(-33.43874775201185,-70.64916152954099);



         
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
<script type="text/javascript" src="js/jquery.min.js">
</script>
<script type="text/javascript" src="js/Concurrent.Thread-full-20090713.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/ui-combobox.js"></script>
<script type="text/javascript" src="js/ui-gMapDirections.js"></script>

<link type="text/css" href="css/redmond/jquery-ui-1.8.1.custom.css" rel="stylesheet" />
<script src="js/jquery.bgiframe.js" type="text/javascript"></script>
<script src="js/jquery.multiselect.js" type="text/javascript"></script>
<link href="css/jquery.multiselect.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="demo.css" />
     <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemasmicrosoft-com:vml">

  <link href="css/mbExtruder1.css" media="all" rel="stylesheet" type="text/css">
<script type="text/javascript" src="ui/ui.progressbar.js"></script>
<script type="text/javascript" src="js/vtip.js"></script>
<script type="text/javascript" src="js/polypack.js"></script>
<link rel="stylesheet" type="text/css" href="css/vtip.css" />

  <script type="text/javascript" src="inc/jquery.hoverIntent.min.js"></script>
  <script type="text/javascript" src="inc/jquery.metadata.js"></script>
  <script type="text/javascript" src="inc/jquery.mb.flipText.min.js"></script>
  <script type="text/javascript" src="inc/mbExtruder.js"></script>
  <script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>
                <script type="text/javascript" src="js/timepicker.js"></script>
                                   

<head>
</head>
<script type="text/javascript">

var alerta_patente=new Array();
var alerta_fecha=new Array();
var alerta_hora=new Array();
   var d=true; var swadd=true; var markersArray = [];
var markers=[];
var directionsService=null;var directionsService2=null; var kkg=0;var swg=new Array();var contg=0;var sw=0;var dir;var recorrido=new Array();var Direcc=new Array ();var tiemporecorrido=0;var distancia;var gmarkers =new Array();var cont=0;var cont2=new Array();var htt=new Array ();var HORA2=new Array ();var lat=new Array();var lngg=new Array ();var lng=new Array ();var point=new Array ();var pat=new Array ();var mar=new Array ();var mod=new Array ();var fech=new Array ();var hora=new Array ();var vel=new Array ();var total=new Array();
var delay=20000;
var flightPath;
</script>
<script type="text/javascript">
			$(function(){

				
				$("#accordion").accordion({ header: "h3" });

				
				$('#tabs').tabs();


				// Dialog
				$('#dialog').dialog({
					autoOpen: false,
					width: 600,
					buttons: {
						"Ok": function() {
							$(this).dialog("close");
						},
						"Cancel": function() {
							$(this).dialog("close");
						}
					}
				});

				// Dialog Link
				$('#dialog_link').click(function(){
					$('#dialog').dialog('open');
					return false;
				});

				// Datepicker

         $('#datepicker').datepicker({
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
     $('#datepicker2').datepicker({
    	duration: '',
        showTime: true,
        constrainInput: false,
        stepMinutes: 1,
        stepHours: 1,
        altTimeField: '',
        position: 'center',
        time24h: true,
        changeMonth: true,
			changeYear: true,
                        onClose:function() {
                            searchLocationsNear("g",document.getElementById('datepicker2').value);
                            /*var contentString="";
                            var vertices = flightPath.getPath();

                              for (var i =0; i < vertices.length; i++) {
    var xy = vertices.getAt(i);
    contentString += "<br />" + "Coordinate: " + i + "<br />" + xy.lat() +"," + xy.lng();
  }


                            alert(contentString);*/ }
     });

				// Slider
				$('#slider').slider({
					range: true,
					values: [17, 67]
				});

				// Progressbar
				$("#progressbar").progressbar({
					value: 20
				});

				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); },
					function() { $(this).removeClass('ui-state-hover'); }
				);

			});
		</script>
<link href="css/add.css" media="all" rel="stylesheet" type="text/css">
<script type="text/javascript">
$(document).ready(function(){

	$("ul.subnav").parent().append("<span></span>");

	$("ul.topnav li span").click(function() { //When trigger is clicked...

		//Following events are applied to the subnav itself (moving subnav up and down)
		$(this).parent().find("ul.subnav").slideDown('fast').show(); //Drop down the subnav on click

		$(this).parent().hover(function() {
		}, function(){
			$(this).parent().find("ul.subnav").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up
		});

		//Following events are applied to the trigger (Hover events for the trigger)
		}).hover(function() {
			$(this).addClass("subhover"); //On hover over, add class "subhover"
		}, function(){	//On Hover Out
			$(this).removeClass("subhover"); //On hover out, remove class "subhover"
	});

});
</script>


<body>





  <div id="map_canvas" ><?php include_map($gMap); ?></div>
  
<?php require 'vista/menpanel.php';?>


        <?php include_map_javascript($gMap); ?>
<script><?php echo $gMap->getxml();
echo $gMap->despliega();
echo $gMap->appmain();
echo $gMap->rutas();
echo $gMap->BuscarDir();?></script>
<?php //echo $gMap->dialog();

$menu= new MenuMap();
echo $menu->Panel($panel);
echo $menu->SinRegistro('no hay registro');
echo $menu->PanelBusqueda();
echo $menu->BuscarDir();
echo $menu->DefauldDialogo('alerta', 'Alerta Vehiculo fuera de hora', $datoHTML);
//$fun="cargarPagina"
echo $menu->GetJSScript('alertaHora', 'alerta', 200, 300, 'false', $show, $hide, 'false', 'true', 'OK', $NomBoton2, $fun, $func2, 'rigth');
echo $menu->DefauldDialogo('reportes', 'Seleccione Reporte!', $datoHTML);
$fnt1="velmax();";
$fnt2="veldetenido();";
echo $menu->GetJSScript('reporte', 'reportes', 200, 300, 'false', $show, $hide, 'false', 'true', 'Velocidad_Maxima','Vehiculo_Detenido', $fnt1, $fnt2,'lefth');
echo $menu->DefauldDialogo('reporteMax', 'Ingrese Fecha', '<input id="fechmax" type="text" name="fechamax" value="" />');
$fun='
var lm=document.getElementById(\'fechmax\');
cargarPagina(\'reportes/repMaxVelocidad.php?fecha=\'+lm.value,\'pageContent\');';
echo $menu->GetJSScript('velmax', 'reporteMax', 150, 200, 'true', $show, $hide, 'false', 'false', 'Consultar', $NomBoton2, $fun, $func2, $posicion);


echo $menu->DefauldDialogo('reporteDetenido', 'Ingrese Fecha', '<input id="fechdetenido" type="text" name="fechamax" value="" />');
$fun='
var lm2=document.getElementById(\'fechdetenido\');
cargarPagina(\'reportes/repVehiculoDetenido.php?fecha=\'+lm2.value,\'pageContent\');';
echo $menu->GetJSScript('veldetenido', 'reporteDetenido', 150, 200, 'true', $show, $hide, 'false', 'false', 'Consultar', $NomBoton2, $fun, $func2, $posicion);

?>

<SCRIPT>

//setTimeout("up();", 800);
  //setTimeout("BuscarDireccion('santiago,chile');", 800);

     </script>


    <div id="getDirs"></div>
    <script>
 
function plot(){


    var bermudaTriangle;

  var triangleCoords = [
  new google.maps.LatLng(-33.43638,-70.67804), new google.maps.LatLng(-33.436715,-70.6780119), new google.maps.LatLng(-33.43705,-70.6779839), new google.maps.LatLng(-33.43772,-70.6779277), new google.maps.LatLng(-33.438055,-70.6778997), new google.maps.LatLng(-33.437385,-70.6779558), new google.maps.LatLng(-33.4382824,-70.6777602), new google.maps.LatLng(-33.4382568,-70.677359), new google.maps.LatLng(-33.4382312,-70.6769577), new google.maps.LatLng(-33.4382057,-70.6765564), new google.maps.LatLng(-33.4381801,-70.6761552), new google.maps.LatLng(-33.4382319,-70.6758337), new google.maps.LatLng(-33.4385668,-70.6758044), new google.maps.LatLng(-33.4389017,-70.6757751), new google.maps.LatLng(-33.4392366,-70.6757458), new google.maps.LatLng(-33.4395716,-70.6757165), new google.maps.LatLng(-33.4399065,-70.6756871), new google.maps.LatLng(-33.4402414,-70.6756578), new google.maps.LatLng(-33.4405763,-70.6756285), new google.maps.LatLng(-33.4409113,-70.6755992), new google.maps.LatLng(-33.4412462,-70.6755699), new google.maps.LatLng(-33.4415811,-70.6755406), new google.maps.LatLng(-33.4419161,-70.6755113), new google.maps.LatLng(-33.442251,-70.6754819), new google.maps.LatLng(-33.4425859,-70.6754526), new google.maps.LatLng(-33.4429208,-70.6754233), new google.maps.LatLng(-33.4432558,-70.675394), new google.maps.LatLng(-33.4435217,-70.6752978), new google.maps.LatLng(-33.443476,-70.6748991), new google.maps.LatLng(-33.4434302,-70.6745004), new google.maps.LatLng(-33.4433845,-70.6741017), new google.maps.LatLng(-33.4433387,-70.6737029), new google.maps.LatLng(-33.443293,-70.6733042), new google.maps.LatLng(-33.4432472,-70.6729055), new google.maps.LatLng(-33.4432015,-70.6725069), new google.maps.LatLng(-33.4431557,-70.6721082), new google.maps.LatLng(-33.44311,-70.6717095), new google.maps.LatLng(-33.4430642,-70.6713108), new google.maps.LatLng(-33.4430185,-70.6709121), new google.maps.LatLng(-33.4429727,-70.6705134), new google.maps.LatLng(-33.4429269,-70.6701147), new google.maps.LatLng(-33.4428712,-70.6697181), new google.maps.LatLng(-33.4428013,-70.6693244), new google.maps.LatLng(-33.4427313,-70.6689308), new google.maps.LatLng(-33.4426614,-70.6685372), new google.maps.LatLng(-33.4425914,-70.6681436), new google.maps.LatLng(-33.4425215,-70.6677499), new google.maps.LatLng(-33.4424515,-70.6673563), new google.maps.LatLng(-33.4423816,-70.6669627), new google.maps.LatLng(-33.4423116,-70.6665691), new google.maps.LatLng(-33.442272,-70.6661695), new google.maps.LatLng(-33.4422331,-70.6657697), new google.maps.LatLng(-33.4421943,-70.66537), new google.maps.LatLng(-33.4421554,-70.6649703), new google.maps.LatLng(-33.4421165,-70.6645705), new google.maps.LatLng(-33.4420776,-70.6641708), new google.maps.LatLng(-33.4420388,-70.663771), new google.maps.LatLng(-33.4419999,-70.6633713), new google.maps.LatLng(-33.441961,-70.6629716), new google.maps.LatLng(-33.4419221,-70.6625718), new google.maps.LatLng(-33.4418832,-70.6621721), new google.maps.LatLng(-33.4418443,-70.6617723), new google.maps.LatLng(-33.4418054,-70.6613726), new google.maps.LatLng(-33.4417665,-70.6609729), new google.maps.LatLng(-33.4417207,-70.6605744), new google.maps.LatLng(-33.4416598,-70.6601786), new google.maps.LatLng(-33.441615,-70.6597807), new google.maps.LatLng(-33.4416004,-70.6593786), new google.maps.LatLng(-33.4415793,-70.6589771), new google.maps.LatLng(-33.4415415,-70.6585772), new google.maps.LatLng(-33.4415038,-70.6581774), new google.maps.LatLng(-33.441466,-70.6577775), new google.maps.LatLng(-33.4414282,-70.6573776), new google.maps.LatLng(-33.4413904,-70.6569777), new google.maps.LatLng(-33.4413526,-70.6565778), new google.maps.LatLng(-33.4413148,-70.6561779), new google.maps.LatLng(-33.441277,-70.655778), new google.maps.LatLng(-33.4412392,-70.6553782), new google.maps.LatLng(-33.4412014,-70.6549783), new google.maps.LatLng(-33.4411636,-70.6545784), new google.maps.LatLng(-33.4411258,-70.6541785), new google.maps.LatLng(-33.441088,-70.6537786), new google.maps.LatLng(-33.4410502,-70.6533787), new google.maps.LatLng(-33.4410124,-70.6529788), new google.maps.LatLng(-33.4409746,-70.652579), new google.maps.LatLng(-33.4409368,-70.6521791), new google.maps.LatLng(-33.440899,-70.6517792), new google.maps.LatLng(-33.4408612,-70.6513793), new google.maps.LatLng(-33.4408234,-70.6509794), new google.maps.LatLng(-33.4407856,-70.6505796), new google.maps.LatLng(-33.4407478,-70.6501797), new google.maps.LatLng(-33.4407099,-70.6497798), new google.maps.LatLng(-33.4406721,-70.6493799), new google.maps.LatLng(-33.4406343,-70.64898), new google.maps.LatLng(-33.4405965,-70.6485801), new google.maps.LatLng(-33.4405587,-70.6481803), new google.maps.LatLng(-33.4405208,-70.6477804), new google.maps.LatLng(-33.440483,-70.6473805), new google.maps.LatLng(-33.4404452,-70.6469806), new google.maps.LatLng(-33.4404074,-70.6465808), new google.maps.LatLng(-33.4403696,-70.6461809), new google.maps.LatLng(-33.4403317,-70.645781), new google.maps.LatLng(-33.4402939,-70.6453811), new google.maps.LatLng(-33.4402561,-70.6449812), new google.maps.LatLng(-33.4402353,-70.644604), new google.maps.LatLng(-33.4405634,-70.6446898), new google.maps.LatLng(-33.4408912,-70.6447632), new google.maps.LatLng(-33.4412158,-70.6446597), new google.maps.LatLng(-33.4415245,-70.6445069), new google.maps.LatLng(-33.4418235,-70.6443237), new google.maps.LatLng(-33.4420872,-70.6440832), new google.maps.LatLng(-33.4423213,-70.6437947), new google.maps.LatLng(-33.442452,-70.6434355), new google.maps.LatLng(-33.4425398,-70.6430471), new google.maps.LatLng(-33.4426277,-70.6426586), new google.maps.LatLng(-33.4427155,-70.6422702), new google.maps.LatLng(-33.4428033,-70.6418817), new google.maps.LatLng(-33.4428911,-70.6414933), new google.maps.LatLng(-33.4429788,-70.6411048), new google.maps.LatLng(-33.4430621,-70.6407151), new google.maps.LatLng(-33.4431261,-70.64032), new google.maps.LatLng(-33.4431901,-70.6399249), new google.maps.LatLng(-33.4432336,-70.6395265), new google.maps.LatLng(-33.443259,-70.6391253), new google.maps.LatLng(-33.4432204,-70.6387258), new google.maps.LatLng(-33.4431609,-70.6383315), new google.maps.LatLng(-33.4430489,-70.6379521), new google.maps.LatLng(-33.4429369,-70.6375727), new google.maps.LatLng(-33.4428248,-70.6371933), new google.maps.LatLng(-33.4427128,-70.6368139), new google.maps.LatLng(-33.4426008,-70.6364346), new google.maps.LatLng(-33.4424887,-70.6360552), new google.maps.LatLng(-33.4423767,-70.6356758), new google.maps.LatLng(-33.4422647,-70.6352964), new google.maps.LatLng(-33.4421526,-70.634917), new google.maps.LatLng(-33.4420406,-70.6345376), new google.maps.LatLng(-33.4419285,-70.6341582), new google.maps.LatLng(-33.4420256,-70.6339137), new google.maps.LatLng(-33.4423516,-70.6338168), new google.maps.LatLng(-33.4426775,-70.6337199), new google.maps.LatLng(-33.4430035,-70.633623), new google.maps.LatLng(-33.4433294,-70.6335261), new google.maps.LatLng(-33.4436553,-70.6334292), new google.maps.LatLng(-33.4439813,-70.6333323), new google.maps.LatLng(-33.4443072,-70.6332354), new google.maps.LatLng(-33.4446332,-70.6331385), new google.maps.LatLng(-33.4449591,-70.6330416), new google.maps.LatLng(-33.445285,-70.6329447), new google.maps.LatLng(-33.445611,-70.6328478), new google.maps.LatLng(-33.4459369,-70.6327509), new google.maps.LatLng(-33.4462629,-70.632654), new google.maps.LatLng(-33.4465888,-70.6325571), new google.maps.LatLng(-33.4469147,-70.6324602), new google.maps.LatLng(-33.4472407,-70.6323633), new google.maps.LatLng(-33.4473917,-70.6321322), new google.maps.LatLng(-33.4473288,-70.6317368), new google.maps.LatLng(-33.4472658,-70.6313415), new google.maps.LatLng(-33.4472029,-70.6309461), new google.maps.LatLng(-33.4471399,-70.6305508), new google.maps.LatLng(-33.447081,-70.6301546), new google.maps.LatLng(-33.4470291,-70.629757), new google.maps.LatLng(-33.4469772,-70.6293594), new google.maps.LatLng(-33.4469253,-70.6289617), new google.maps.LatLng(-33.4468733,-70.6285641), new google.maps.LatLng(-33.4468214,-70.6281665), new google.maps.LatLng(-33.4467695,-70.6277689), new google.maps.LatLng(-33.4467159,-70.6273716), new google.maps.LatLng(-33.4466292,-70.6269828), new google.maps.LatLng(-33.4465425,-70.626594), new google.maps.LatLng(-33.4464558,-70.6262052), new google.maps.LatLng(-33.4462558,-70.6260443), new google.maps.LatLng(-33.4459292,-70.6261381), new google.maps.LatLng(-33.4456026,-70.6262319), new google.maps.LatLng(-33.4455381,-70.6264947), new google.maps.LatLng(-33.4456527,-70.6268729), new google.maps.LatLng(-33.4457673,-70.6272512), new google.maps.LatLng(-33.4459044,-70.6275815), new google.maps.LatLng(-33.4462332,-70.6274997), new google.maps.LatLng(-33.446562,-70.6274179), new google.maps.LatLng(-33.4468908,-70.6273362), new google.maps.LatLng(-33.4472196,-70.6272544), new google.maps.LatLng(-33.4475484,-70.6271726), new google.maps.LatLng(-33.447876,-70.6270843), new google.maps.LatLng(-33.4482012,-70.6269841), new google.maps.LatLng(-33.4485265,-70.6268839), new google.maps.LatLng(-33.4488517,-70.6267837), new google.maps.LatLng(-33.449177,-70.6266835), new google.maps.LatLng(-33.4495022,-70.6265834), new google.maps.LatLng(-33.4498275,-70.6264832), new google.maps.LatLng(-33.4501527,-70.626383), new google.maps.LatLng(-33.450478,-70.6262828), new google.maps.LatLng(-33.4508032,-70.6261826), new google.maps.LatLng(-33.4511285,-70.6260824), new google.maps.LatLng(-33.4514537,-70.6259822), new google.maps.LatLng(-33.451779,-70.625882), new google.maps.LatLng(-33.4521042,-70.6257818), new google.maps.LatLng(-33.4522548,-70.6259738), new google.maps.LatLng(-33.4522801,-70.6263751), new google.maps.LatLng(-33.4523054,-70.6267765), new google.maps.LatLng(-33.4523308,-70.6271778), new google.maps.LatLng(-33.4523561,-70.6275792), new google.maps.LatLng(-33.4523814,-70.6279805), new google.maps.LatLng(-33.4524068,-70.6283819), new google.maps.LatLng(-33.4524217,-70.6287818), new google.maps.LatLng(-33.4523216,-70.629166), new google.maps.LatLng(-33.4522215,-70.6295502), new google.maps.LatLng(-33.4521213,-70.6299343), new google.maps.LatLng(-33.4520212,-70.6303185), new google.maps.LatLng(-33.4519518,-70.6307048), new google.maps.LatLng(-33.4519177,-70.6310983), new google.maps.LatLng(-33.4518439,-70.631491), new google.maps.LatLng(-33.4517702,-70.6318836), new google.maps.LatLng(-33.4516964,-70.6322763), new google.maps.LatLng(-33.4516579,-70.6326739), new google.maps.LatLng(-33.4516538,-70.6330764), new google.maps.LatLng(-33.4516497,-70.6334789), new google.maps.LatLng(-33.4516455,-70.6338813), new google.maps.LatLng(-33.4516414,-70.6342838), new google.maps.LatLng(-33.4518574,-70.6343651), new google.maps.LatLng(-33.452186,-70.634282), new google.maps.LatLng(-33.4525145,-70.6341989), new google.maps.LatLng(-33.4528431,-70.6341159), new google.maps.LatLng(-33.4531717,-70.6340328), new google.maps.LatLng(-33.4535003,-70.6339497), new google.maps.LatLng(-33.4538289,-70.6338667), new google.maps.LatLng(-33.4541575,-70.6337836), new google.maps.LatLng(-33.4544861,-70.6337005), new google.maps.LatLng(-33.4548147,-70.6336175), new google.maps.LatLng(-33.4551433,-70.6335344), new google.maps.LatLng(-33.4554719,-70.6334513), new google.maps.LatLng(-33.4558004,-70.6333683), new google.maps.LatLng(-33.4561293,-70.6332926), new google.maps.LatLng(-33.4564607,-70.6332853), new google.maps.LatLng(-33.4567886,-70.6331983), new google.maps.LatLng(-33.4571164,-70.6331112), new google.maps.LatLng(-33.4574443,-70.6330242), new google.maps.LatLng(-33.4577722,-70.6329372), new google.maps.LatLng(-33.4581001,-70.6328501), new google.maps.LatLng(-33.4584279,-70.6327631), new google.maps.LatLng(-33.4587558,-70.632676), new google.maps.LatLng(-33.4590837,-70.632589), new google.maps.LatLng(-33.4594115,-70.632502), new google.maps.LatLng(-33.4597394,-70.6324149), new google.maps.LatLng(-33.4600673,-70.6323279), new google.maps.LatLng(-33.4603952,-70.6322408), new google.maps.LatLng(-33.460723,-70.6321538), new google.maps.LatLng(-33.4610509,-70.6320667), new google.maps.LatLng(-33.4613486,-70.6320365), new google.maps.LatLng(-33.4614214,-70.6324294), new google.maps.LatLng(-33.4614943,-70.6328224), new google.maps.LatLng(-33.4615671,-70.6332154), new google.maps.LatLng(-33.4616399,-70.6336083), new google.maps.LatLng(-33.4617127,-70.6340013), new google.maps.LatLng(-33.4617855,-70.6343943), new google.maps.LatLng(-33.4618583,-70.6347872), new google.maps.LatLng(-33.4619311,-70.6351802), new google.maps.LatLng(-33.4620039,-70.6355731), new google.maps.LatLng(-33.4620768,-70.6359661), new google.maps.LatLng(-33.4621496,-70.6363591), new google.maps.LatLng(-33.4622224,-70.636752), new google.maps.LatLng(-33.4622952,-70.637145), new google.maps.LatLng(-33.462368,-70.637538), new google.maps.LatLng(-33.4624408,-70.6379309), new google.maps.LatLng(-33.4625136,-70.6383239), new google.maps.LatLng(-33.4625864,-70.6387169), new google.maps.LatLng(-33.4626592,-70.6391098), new google.maps.LatLng(-33.462732,-70.6395028), new google.maps.LatLng(-33.4628028,-70.6398962), new google.maps.LatLng(-33.4628449,-70.6402956), new google.maps.LatLng(-33.4628871,-70.6406949), new google.maps.LatLng(-33.4629293,-70.6410943), new google.maps.LatLng(-33.4629715,-70.6414936), new google.maps.LatLng(-33.4630136,-70.641893), new google.maps.LatLng(-33.4630558,-70.6422923), new google.maps.LatLng(-33.463098,-70.6426917), new google.maps.LatLng(-33.4631401,-70.6430911), new google.maps.LatLng(-33.4631823,-70.6434904), new google.maps.LatLng(-33.4632245,-70.6438898), new google.maps.LatLng(-33.4632666,-70.6442891), new google.maps.LatLng(-33.4633088,-70.6446885), new google.maps.LatLng(-33.4636345,-70.6446607), new google.maps.LatLng(-33.4639686,-70.6446203), new google.maps.LatLng(-33.4643027,-70.6445799), new google.maps.LatLng(-33.4646369,-70.6445394), new google.maps.LatLng(-33.464971,-70.644499), new google.maps.LatLng(-33.4653051,-70.6444586), new google.maps.LatLng(-33.4656392,-70.6444182), new google.maps.LatLng(-33.4659733,-70.6443777), new google.maps.LatLng(-33.4663075,-70.6443373), new google.maps.LatLng(-33.4666416,-70.6442969), new google.maps.LatLng(-33.4669757,-70.6442564), new google.maps.LatLng(-33.4673098,-70.644216), new google.maps.LatLng(-33.467644,-70.6441756), new google.maps.LatLng(-33.4679781,-70.6441351), new google.maps.LatLng(-33.4683122,-70.6440947), new google.maps.LatLng(-33.4686463,-70.6440543), new google.maps.LatLng(-33.4689804,-70.6440138), new google.maps.LatLng(-33.4693148,-70.6439774), new google.maps.LatLng(-33.4696503,-70.6439613), new google.maps.LatLng(-33.4699859,-70.6439453), new google.maps.LatLng(-33.4703214,-70.6439292), new google.maps.LatLng(-33.470657,-70.6439131), new google.maps.LatLng(-33.4709925,-70.6438971), new google.maps.LatLng(-33.4713281,-70.643881), new google.maps.LatLng(-33.4716636,-70.6438649), new google.maps.LatLng(-33.4719992,-70.6438489), new google.maps.LatLng(-33.4723348,-70.6438328), new google.maps.LatLng(-33.4726703,-70.6438167), new google.maps.LatLng(-33.4730059,-70.6438007), new google.maps.LatLng(-33.473042,-70.6441847), new google.maps.LatLng(-33.473065,-70.6445864), new google.maps.LatLng(-33.473088,-70.644988), new google.maps.LatLng(-33.473111,-70.6453897), new google.maps.LatLng(-33.473134,-70.6457913), new google.maps.LatLng(-33.4731569,-70.6461929), new google.maps.LatLng(-33.4731799,-70.6465946), new google.maps.LatLng(-33.4732029,-70.6469962), new google.maps.LatLng(-33.4732259,-70.6473979), new google.maps.LatLng(-33.4732489,-70.6477995), new google.maps.LatLng(-33.4732718,-70.6482012), new google.maps.LatLng(-33.4732948,-70.6486028), new google.maps.LatLng(-33.4733178,-70.6490045), new google.maps.LatLng(-33.4733408,-70.6494061), new google.maps.LatLng(-33.4733637,-70.6498078), new google.maps.LatLng(-33.4733867,-70.6502094), new google.maps.LatLng(-33.4734097,-70.6506111), new google.maps.LatLng(-33.4734326,-70.6510127), new google.maps.LatLng(-33.4734556,-70.6514144), new google.maps.LatLng(-33.4734786,-70.651816), new google.maps.LatLng(-33.4735015,-70.6522177), new google.maps.LatLng(-33.4735245,-70.6526193), new google.maps.LatLng(-33.4735475,-70.653021), new google.maps.LatLng(-33.4735704,-70.6534226), new google.maps.LatLng(-33.4735934,-70.6538243), new google.maps.LatLng(-33.4736163,-70.6542259), new google.maps.LatLng(-33.4739016,-70.6542664), new google.maps.LatLng(-33.4742366,-70.6542383), new google.maps.LatLng(-33.4745716,-70.6542102), new google.maps.LatLng(-33.4749066,-70.6541821), new google.maps.LatLng(-33.4752416,-70.6541541), new google.maps.LatLng(-33.4755766,-70.654126), new google.maps.LatLng(-33.4759116,-70.6540979), new google.maps.LatLng(-33.4762466,-70.6540698), new google.maps.LatLng(-33.4765816,-70.6540417), new google.maps.LatLng(-33.4769166,-70.6540136), new google.maps.LatLng(-33.4770505,-70.6543432), new google.maps.LatLng(-33.4771546,-70.654726), new google.maps.LatLng(-33.4772194,-70.6551177), new google.maps.LatLng(-33.4772395,-70.6555196), new google.maps.LatLng(-33.4772596,-70.6559215), new google.maps.LatLng(-33.4769896,-70.656126), new google.maps.LatLng(-33.4767853,-70.6558674), new google.maps.LatLng(-33.4767451,-70.655497), new google.maps.LatLng(-33.4770379,-70.6553861), new google.maps.LatLng(-33.4773522,-70.6555278), new google.maps.LatLng(-33.4776665,-70.6556695), new google.maps.LatLng(-33.4779808,-70.6558112), new google.maps.LatLng(-33.4782952,-70.655953), new google.maps.LatLng(-33.4786095,-70.6560947), new google.maps.LatLng(-33.4787225,-70.6564135), new google.maps.LatLng(-33.4787409,-70.6568155), new google.maps.LatLng(-33.4787593,-70.6572175), new google.maps.LatLng(-33.4787776,-70.6576195), new google.maps.LatLng(-33.478796,-70.6580215), new google.maps.LatLng(-33.4788144,-70.6584235), new google.maps.LatLng(-33.4788328,-70.6588256), new google.maps.LatLng(-33.4788512,-70.6592276), new google.maps.LatLng(-33.4788695,-70.6596296), new google.maps.LatLng(-33.4788518,-70.6600316), new google.maps.LatLng(-33.4788332,-70.6604336), new google.maps.LatLng(-33.4788145,-70.6608356), new google.maps.LatLng(-33.4787959,-70.6612376), new google.maps.LatLng(-33.4787772,-70.6616396), new google.maps.LatLng(-33.4787585,-70.6620416), new google.maps.LatLng(-33.4787399,-70.6624436), new google.maps.LatLng(-33.4787212,-70.6628455), new google.maps.LatLng(-33.4787026,-70.6632475), new google.maps.LatLng(-33.4786839,-70.6636495), new google.maps.LatLng(-33.4786652,-70.6640515), new google.maps.LatLng(-33.4786466,-70.6644535), new google.maps.LatLng(-33.4786303,-70.6648556), new google.maps.LatLng(-33.4786331,-70.6652582), new google.maps.LatLng(-33.478636,-70.6656608), new google.maps.LatLng(-33.4786388,-70.6660634), new google.maps.LatLng(-33.4786416,-70.666466), new google.maps.LatLng(-33.4786444,-70.6668686), new google.maps.LatLng(-33.4786473,-70.6672712), new google.maps.LatLng(-33.4786501,-70.6676738), new google.maps.LatLng(-33.4786529,-70.6680764), new google.maps.LatLng(-33.4786557,-70.668479), new google.maps.LatLng(-33.4786585,-70.6688816), new google.maps.LatLng(-33.478646,-70.6692835), new google.maps.LatLng(-33.4786168,-70.6696846), new google.maps.LatLng(-33.4785877,-70.6700857), new google.maps.LatLng(-33.4785586,-70.6704868), new google.maps.LatLng(-33.4785295,-70.6708879), new google.maps.LatLng(-33.4785004,-70.671289), new google.maps.LatLng(-33.4784784,-70.6716905), new google.maps.LatLng(-33.478473,-70.6720931), new google.maps.LatLng(-33.4784676,-70.6724957), new google.maps.LatLng(-33.4784622,-70.6728982), new google.maps.LatLng(-33.4784568,-70.6733008), new google.maps.LatLng(-33.4784514,-70.6737033), new google.maps.LatLng(-33.4784459,-70.6741059), new google.maps.LatLng(-33.4784405,-70.6745085), new google.maps.LatLng(-33.4784351,-70.674911), new google.maps.LatLng(-33.4784297,-70.6753136), new google.maps.LatLng(-33.4784243,-70.6757162), new google.maps.LatLng(-33.4784189,-70.6761187), new google.maps.LatLng(-33.4784135,-70.6765213), new google.maps.LatLng(-33.478408,-70.6769238), new google.maps.LatLng(-33.4784026,-70.6773264), new google.maps.LatLng(-33.4783972,-70.677729), new google.maps.LatLng(-33.4783918,-70.6781315), new google.maps.LatLng(-33.4783863,-70.6785341), new google.maps.LatLng(-33.4783809,-70.6789367), new google.maps.LatLng(-33.4783755,-70.6793392), new google.maps.LatLng(-33.4783701,-70.6797418), new google.maps.LatLng(-33.4783646,-70.6801444), new google.maps.LatLng(-33.4783592,-70.6805469), new google.maps.LatLng(-33.4783538,-70.6809495), new google.maps.LatLng(-33.4783483,-70.681352), new google.maps.LatLng(-33.4783429,-70.6817546), new google.maps.LatLng(-33.4783375,-70.6821572), new google.maps.LatLng(-33.478332,-70.6825597), new google.maps.LatLng(-33.4783046,-70.6829605), new google.maps.LatLng(-33.4782639,-70.6833601), new google.maps.LatLng(-33.4782233,-70.6837598), new google.maps.LatLng(-33.4781827,-70.6841594), new google.maps.LatLng(-33.4781421,-70.6845591), new google.maps.LatLng(-33.4781317,-70.6849614), new google.maps.LatLng(-33.478123,-70.6853639), new google.maps.LatLng(-33.4781395,-70.6857655), new google.maps.LatLng(-33.478169,-70.6861665), new google.maps.LatLng(-33.4781984,-70.6865676), new google.maps.LatLng(-33.4782279,-70.6869686), new google.maps.LatLng(-33.4782483,-70.6873701), new google.maps.LatLng(-33.4782417,-70.6877726), new google.maps.LatLng(-33.478235,-70.6881751), new google.maps.LatLng(-33.4782284,-70.6885777), new google.maps.LatLng(-33.4782217,-70.6889802), new google.maps.LatLng(-33.4782151,-70.6893828), new google.maps.LatLng(-33.4782084,-70.6897853), new google.maps.LatLng(-33.4782018,-70.6901878), new google.maps.LatLng(-33.4781951,-70.6905904), new google.maps.LatLng(-33.478252,-70.6909558), new google.maps.LatLng(-33.4785206,-70.6911974), new google.maps.LatLng(-33.4787892,-70.6914391), new google.maps.LatLng(-33.4790578,-70.6916807), new google.maps.LatLng(-33.4793264,-70.6919224), new google.maps.LatLng(-33.479595,-70.6921641), new google.maps.LatLng(-33.4798636,-70.6924057), new google.maps.LatLng(-33.4801322,-70.6926474), new google.maps.LatLng(-33.4804008,-70.6928891), new google.maps.LatLng(-33.4806694,-70.6931307), new google.maps.LatLng(-33.480938,-70.6933724), new google.maps.LatLng(-33.4812066,-70.6936141), new google.maps.LatLng(-33.4814752,-70.6938557), new google.maps.LatLng(-33.4817438,-70.6940974), new google.maps.LatLng(-33.4820071,-70.6943471), new google.maps.LatLng(-33.482265,-70.694605), new google.maps.LatLng(-33.4825229,-70.6948628), new google.maps.LatLng(-33.4827808,-70.6951207), new google.maps.LatLng(-33.4830387,-70.6953786), new google.maps.LatLng(-33.4832966,-70.6956365), new google.maps.LatLng(-33.4835545,-70.6958944), new google.maps.LatLng(-33.4838124,-70.6961523), new google.maps.LatLng(-33.4840702,-70.6964102), new google.maps.LatLng(-33.4843281,-70.6966681), new google.maps.LatLng(-33.484586,-70.696926), new google.maps.LatLng(-33.4848439,-70.6971839), new google.maps.LatLng(-33.4851018,-70.6974418), new google.maps.LatLng(-33.4853597,-70.6976997), new google.maps.LatLng(-33.4856176,-70.6979576), new google.maps.LatLng(-33.4858755,-70.6982155), new google.maps.LatLng(-33.4861334,-70.6984734), new google.maps.LatLng(-33.4863923,-70.6987298), new google.maps.LatLng(-33.4866564,-70.6989784), new google.maps.LatLng(-33.4869206,-70.699227), new google.maps.LatLng(-33.4871848,-70.6994756), new google.maps.LatLng(-33.4874489,-70.6997243), new google.maps.LatLng(-33.4877132,-70.6999727), new google.maps.LatLng(-33.4879893,-70.7002019), new google.maps.LatLng(-33.4882654,-70.7004311), new google.maps.LatLng(-33.4885415,-70.7006603), new google.maps.LatLng(-33.4888176,-70.7008895), new google.maps.LatLng(-33.4890937,-70.7011187), new google.maps.LatLng(-33.4893699,-70.7013479), new google.maps.LatLng(-33.489646,-70.7015771), new google.maps.LatLng(-33.4899221,-70.7018063), new google.maps.LatLng(-33.4901982,-70.7020355), new google.maps.LatLng(-33.4904743,-70.7022647), new google.maps.LatLng(-33.4907504,-70.7024939), new google.maps.LatLng(-33.4910314,-70.7027143), new google.maps.LatLng(-33.4913143,-70.7029312), new google.maps.LatLng(-33.4915973,-70.7031481), new google.maps.LatLng(-33.4918802,-70.7033649), new google.maps.LatLng(-33.4921632,-70.7035818), new google.maps.LatLng(-33.4924461,-70.7037987), new google.maps.LatLng(-33.4927291,-70.7040156), new google.maps.LatLng(-33.493012,-70.7042325), new google.maps.LatLng(-33.493295,-70.7044493), new google.maps.LatLng(-33.4935779,-70.7046662), new google.maps.LatLng(-33.4938609,-70.7048831), new google.maps.LatLng(-33.4941438,-70.7051), new google.maps.LatLng(-33.4944268,-70.7053169), new google.maps.LatLng(-33.4944182,-70.7050992), new google.maps.LatLng(-33.4941305,-70.7048913), new google.maps.LatLng(-33.4938429,-70.7046835), new google.maps.LatLng(-33.4935553,-70.7044757), new google.maps.LatLng(-33.4932676,-70.7042678), new google.maps.LatLng(-33.49298,-70.70406)
  ];


  var flightPath = new google.maps.Polyline({
    path: triangleCoords,
    strokeColor: "#FF0000",
    strokeWeight: 2
  });

  flightPath.setMap(map);

  /*



    var vertices = flightPath.getPath();
var contentString="";
                              for (var i =0; i < vertices.length; i++) {
    var xy = vertices.getAt(i)
    contentString =  "new google.maps.LatLng("+xy.lat() +"," + xy.lng()+"),";
      cargarPagina('controlador/kmlMain.php?data='+contentString+'&op=txt','domm');
  }



  */
}
    </script>

      </body>

  
    <div id="none"></div>
</html>
<?php
} else {
header("Location: index.php");
}?>
