<?php
session_start();
if (isset($_SESSION["nombre"])){
define('GMAP_LIB_PATH',dirname(__FILE__).'/lib/');
require_once(GMAP_LIB_PATH.'GMap.class.php');

$gMap = new GMap();

           $gMap->setZoom(13);


$gMap->setHeight('100%');
$gMap->setWidth('100%');

$gMap->setCenter(-33.43874775201185,-70.64916152954099);



            // some places in the world
            $coordinates = array(
              array(51.245475,6.821373),
              array(46.262248,6.115969),
              array(48.848959,2.341577),
              array(48.718952,2.219180),
              array(47.376420,8.547995)
            );

            // adds a variable "markers" defined on the global level
            $gMap->addGlobalVariable('markers','new Array()');

            // creates a custom icon for markers

               $icon = new GMapMarkerImage(
      '/web/images/nice_icon.png',
      array(
        'width' => 18,
        'height' => 25,
      )
    );


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

                 $sample_address = 'sao paulo,brasil';
    $renca = new GMapGeocodedAddress($sample_address);
    $renca->geocode($gMap->getGMapClient());
    $sample_address = 'arica, chile';
    $huechuarba = new GMapGeocodedAddress($sample_address);
    $huechuarba->geocode($gMap->getGMapClient());
    // Center the map on geocoded address

    $paris = new GMapCoord($renca->getLat(),$renca->getLng());
    $bordeaux = new GMapCoord($huechuarba->getLat(),$huechuarba->getLng());

    $dijon = new GMapCoord(47.327213, 5.043988);
    $lyon  = new GMapCoord(45.767299, 4.834329);

    // Waypoint samples
    $waypoints = array(
      new GMapDirectionWaypoint($dijon),
      new GMapDirectionWaypoint($lyon, false)
    );

    // Initialize GMapDirection
   // $direction = new GMapDirection($paris, $bordeaux, 'direction_sample', array('optimizeWaypoints'=>true,'panel' => "document.getElementById('direction_pane')"));
    //$gMap->addDirection($direction);



?>
<?php require_once(GMAP_LIB_PATH.'helper/GMapHelper.php'); ?>
<script type="text/javascript" src="js/add.js"></script>
<?php include_google_map_javascript_file($gMap); ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js">
</script>
<script type="text/javascript" src="js/Concurrent.Thread-full-20090713.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/ui-combobox.js"></script>
<script type="text/javascript" src="js/ui-gMapDirections.js"></script>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.3.custom.css" rel="stylesheet" />


     <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemasmicrosoft-com:vml">

  <link href="css/mbExtruder1.css" media="all" rel="stylesheet" type="text/css"/>

  <script type="text/javascript" src="inc/jquery.hoverIntent.min.js"></script>
  <script type="text/javascript" src="inc/jquery.metadata.js"></script>
  <script type="text/javascript" src="inc/jquery.mb.flipText.min.js"></script>
  <script type="text/javascript" src="inc/mbExtruder.js"></script>
  <script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>
                <script type="text/javascript" src="js/timepicker.js"></script>
<head>
</head>
<script type="text/javascript">
   
   var d=true; var swadd=true; var markersArray = [];

var directionsService=null;var flightPath; var kkg=0;var swg=new Array();var contg=0;var sw=0;var dir;var recorrido=new Array();var Direcc=new Array ();var tiemporecorrido=0;var delay=2000;var distancia;var gmarkers =new Array();var cont=0;var cont2=new Array();var htt=new Array ();var HORA2=new Array ();var lat=new Array();var lngg=new Array ();var lng=new Array ();var point=new Array ();var pat=new Array ();var mar=new Array ();var mod=new Array ();var fech=new Array ();var hora=new Array ();var vel=new Array ();var total=new Array();
    $(function(){


      $("#extruderTop").buildMbExtruder({
        positionFixed:false,
        width:350,
        extruderOpacity:1,
        autoCloseTime:4000,
        hidePanelsOnClose:false,
        onExtOpen:function(){},
        onExtContentLoad:function(){},
        onExtClose:function(){}
      });

      $("#extruderLeft").buildMbExtruder({
        position:"left",
        width:300,
        extruderOpacity:.8,
        onExtOpen:function(){},
        onExtContentLoad:function(){},
        onExtClose:function(){}
      });

      $("#extruderLeft1").buildMbExtruder({
        position:"left",
        width:300,
        extruderOpacity:.8,
        onExtOpen:function(){},
        onExtContentLoad:function(){},
        onExtClose:function(){}
      });

      $("#extruderLeft2").buildMbExtruder({
        position:"left",
        width:300,
        positionFixed:false,
        top:0,
        extruderOpacity:.8,
        onExtOpen:function(){},
        onExtContentLoad:function(){},
        onExtClose:function(){}
      });

    });

  </script>
<script type="text/javascript">
			$(function(){

				// Accordion
				$("#accordion").accordion({ header: "h3" });

				// Tabs
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
                            searchLocationsNear("g",document.getElementById('datepicker').value);
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
<link href="css/add.css" media="all" rel="stylesheet" type="text/css"/>

<body>
    <div id="extruderTop" class="{title:'Menu', url:'parts/extruderTop.php'}">
</div>
 <div id="extruderLeft" class="{title:'Vehiculos', url:'parts/vehiculo.php'}"></div>
 <div id="extruderLeft2" class="a {title:'Consultar', url:'parts/consultasss.php'}"></div>
  <div id="extruderLeft3" class="a {title:'Consultar', url:'parts/consultass.php'}"></div>






    <div id="map_canvas"><?php include_map($gMap); ?></div>




        <?php include_map_javascript($gMap); ?>
<script>
<?php echo $gMap->getxml();
echo $gMap->despliega();
echo $gMap->appmain();
echo $gMap->rutas();
?>
 </script>
<script>


  //setTimeout("BuscarDireccion('santiago,chile');", 800);

</script>


    <div id="getDirs"></div>
    <div id="button">
        <div id="accordion">
	<h3><a href="#">Buscar por Fechas</a></h3>
       
        <div>
            <fieldset>
<p>Fecha / Hora <input type="text" id="datepicker"/></p>
         Tiempo Refresco<select name="delay" id="delay" onclick="cambiartiempo(this.selectedIndex);">
                                <option>0.0</option>
                                <option>0.2</option>
                                <option>0.5</option>
                                <option>0.7</option>
                                <option >1.0</option>
                                <option>1.5</option>
                                <option selected="selected">2.0</option>
                                <option>2.5</option>
                                <option>3.0</option>
                                <option>6.0</option>
                              </select>
            </fieldset>
         <br></br> <button id="create-user" class="ui-button ui-state-default ui-corner-all">Buscar por Direccion</button>
        <br></br><button class="ui-button ui-state-default ui-corner-all"  onclick="initMapDirs();" >Buscar Rutas Optimas</button></div>
        <h3><a href="#">Ruta Optimas</a></h3><div>
            
 <div id="styleSelector"></div>

</div>
        <h3><a href="#">Crear Rutas</a></h3><div>
 <button class="ui-button ui-state-default ui-corner-all" onclick="crearRuta(true);">Crear Ruta</button>
    <button class="ui-button ui-state-default ui-corner-all" onclick="crearRuta(false);" >Cancelar</button>
    <button class="ui-button ui-state-default ui-corner-all"  onclick="reset();" >Limpiar Pantalla</button></div>



        <h3><a href="#">Buscar Direccion</a></h3><div>
           
   </div>

        </div>Thema<div id="jQueryUICssSwitch"></div></div>
  <div id="dialog2" title="Consulta">
    No se encontraron Registros en esta Fecha y hora.
  	</div>
      <div id="dialog4" title="Consulta">
   Direccion no Encontrada.
  	</div>

<div id="dialog3" title="Buscar Direccion">
	<p id="validateTips">Ingrese la Direccion a Buscar</p>

	<fieldset>
		<label for="name">Direccion:</label>
		<input type="text" name="name" id="address" class="text ui-widget-content ui-corner-all" />
		</fieldset>
	</div>

<link id="jQueryUICssSrc" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/ui-lightness/jquery-ui.css" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript">
        $('#jQueryUICssSwitch').combobox({
            listHeight:200,
            list: [
                    { value: "base", text: "base", selected: true  },
                    { value: "black-tie", text: "black-tie" },
                    { value: "blitzer", text: "blitzer" },
                    { value: "cupertino", text: "cupertino" },
                    { value: "dark-hive", text: "dark-hive" },
                    { value: "dot-luv", text: "dot-luv" },
                    { value: "eggplant", text: "eggplant" },
                    { value: "excite-bike", text: "excite-bike" },
                    { value: "flick", text: "flick" },
                    { value: "hot-sneaks", text: "hot-sneaks" },
                    { value: "humanity", text: "humanity" },
                    { value: "le-frog", text: "le-frog" },
                    { value: "mint-choc", text: "mint-choc" },
                    { value: "overcast", text: "overcast" },
                    { value: "pepper-grinder", text: "pepper-grinder" },
                    { value: "redmond", text: "redmond" },
                    { value: "smoothness", text: "smoothness" },
                    { value: "south-street", text: "south-street" },
                    { value: "start", text: "start" },
                    { value: "sunny", text: "sunny" },
                    { value: "swanky-purse", text: "swanky-purse" },
                    { value: "trontastic", text: "trontastic" },
                    { value: "ui-darkness", text: "ui-darkness"},
                    { value: "ui-lightness", text: "ui-lightness"},
                    { value: "vader", text: "vader" },
                    ]
                , changed: function(e, ui) {
                    $('#jQueryUICssSrc').attr('href', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/' + ui.value + '/jquery-ui.css');
                }
                ,open:function(e, ui){
                    $('#jQueryUICssSrc').attr('href', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/trontastic/jquery-ui.css');
                }
        });
        function jQueryUICss_Changed(ddl, i) {

        }
    </script>

      </body>
</html>
<?php
} else {
header("Location: index.php");
}?>