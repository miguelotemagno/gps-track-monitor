<?php ob_start();
session_start();
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



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/ui-combobox.js"></script>
<script type="text/javascript" src="js/ui-gMapDirections.js"></script>

<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.3.custom.css" rel="stylesheet" />
<script src="js/jquery.bgiframe.js" type="text/javascript"></script>
<script src="js/jquery.multiselect.js" type="text/javascript"></script>
<link href="css/jquery.multiselect.css" rel="stylesheet" type="text/css" />

     <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemasmicrosoft-com:vml">
<script type="text/javascript" src="js/add2.js"></script>
  <link href="css/mbExtruder1.css" media="all" rel="stylesheet" type="text/css">
<script type="text/javascript" src="ui/ui.progressbar.js"></script>
<link type='text/css' href='css/demo2.css' rel='stylesheet' media='screen' />
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<!-- Contact Form CSS files -->
<link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />
  <script type="text/javascript" src="inc/jquery.hoverIntent.min.js"></script>
  <script type="text/javascript" src="inc/jquery.metadata.js"></script>
  <script type="text/javascript" src="inc/jquery.mb.flipText.min.js"></script>
  <script type="text/javascript" src="inc/mbExtruder.js"></script>
  <script type="text/javascript" src="js/ui-combobox.js"></script>
  <script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>
  <script type="text/javascript" src="js/jquery.tools.min.js"></script>
                <script type="text/javascript" src="js/timepicker.js"></script>
                <script type='text/javascript' src='js/contact.js'></script>
 <style>div#tabs {
background:none repeat scroll 0 0 white;
border:1px solid black;
cursor:pointer;
 align:"left";
left:50px;
right: 50px;
position:fixed;
text-align:center;
top:200px;
}</style>
<script type="text/javascript">
  
function verAlertas(op){

            var div=document.getElementById('Alertas');
    if (!op){
        if (div.style.visibility!='hidden'){
        div.style.visibility='hidden'
        div.style.width='0px';
        div.style.height='0px';}
    }
    else{div.style.visibility='visible'
        div.style.width='1200px';
        div.style.height='250px';}
}
function verReportes(op){

            var div=document.getElementById('Reportes');
    if (!op){
        if (div.style.visibility!='hidden'){
        div.style.visibility='hidden'
        div.style.width='0px';
        div.style.height='0px';}
    }
    else{div.style.visibility='visible'
        div.style.width='1200px';
        div.style.height='250px';}
}
function verOpciones(op){

            var div=document.getElementById('opciones');
    if (!op){
        if (div.style.visibility!='hidden'){
        div.style.visibility='hidden'
        div.style.width='0px';
        div.style.height='0px';}
    }
    else{div.style.visibility='visible'
        div.style.width='1200px';
        div.style.height='250px';}
}
$(document).ready(function(){
$('#tabs').tabs({show: 'bounce',
                        hide: 'fade'});
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
$(function() {
		$("#resizable2").resizable();
	});

function addAlert(patente,horaI,HoraF){ $('#users tbody').append('<tr>' +
							'<td>'+patente+'</td>' +
							'<td>'+horaI+'</td>' +
							'<td>'+HoraF+'</td>' +
							'</tr>');
                                                
                                         }

</script>


                	<style type="text/css">
		body { font-size: 62.5%; }
		label, input { display:block; }
		input.text { margin-bottom:12px; width:95%; padding: .4em; }
		fieldset { padding:0; border:0; margin-top:25px; }
		h1 { font-size: 1.2em; margin: .6em 0; }
		div#users-contain {  width: 350px; margin: 20px 0; }
		div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
		div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
		.ui-button { outline: 0; margin:0; padding: .4em 1em .5em; text-decoration:none;  !important; cursor:pointer; position: relative; text-align: center; }
		.ui-dialog .ui-state-highlight, .ui-dialog .ui-state-error { padding: .3em;  }


	</style>
	<style type="text/css">
			/*demo page css*/
			
			
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
                        #dialog_link2 {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link2 span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}

			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
                        div#users-contain {  width: 350px; margin: 20px 0; }
                        		div#users-contain table { margin: 1em 0; width: 100%; }
		div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
		</style>
<link rel="stylesheet" type="text/css" href="demo.css" />
<link href="front.css" media="screen, projection" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script.js"></script>
</head>

<body>
<div id="container2"><?php if (!isset($_SESSION["nombre"])){?>
  <div id="topnav" class="topnav"> <?php if($_GET["login"]==0){
   Echo "Usuario o Contraseña mal Ingresados";
  } ?> <a href="login" class="signin"><span>Ingresar Sistema</span></a> </div>
    <fieldset id="signin_menu">
    <form name="signin" method="post" id="signin" action="controlador/login.php">
      <label for="username">Usuario</label>
      <input id="username" name="username" value="" title="username" tabindex="4" type="text">
      </p>
      <p>
        <label for="password">Password</label>
        <input id="password" name="password" value="" title="password" tabindex="5" type="password">
      </p>
      <p class="remember">
        <input id="signin_submit" value="Ingresar" tabindex="6" type="submit">
        <input id="remember" name="remember_me" value="1" tabindex="7" type="checkbox">
        <label for="remember">Recordar Usuario y Password</label>
      </p>
      
    </form>
  </fieldset>
  <?php }else{?>
  <div id="topnav" class="topnav"> <?php Echo "Bienvenido ".$_SESSION["nombre"]; ?> <a href="#" onclick="CloseSession();" class="signin" ><span>Cerrar Session</span></a> </div>



      <?php }?>
</div>

<script type="text/javascript">
        $(document).ready(function() {

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
<img src="img/top_bg.gif" alt="top" /><div id="main" class="container">
    <h1>Geolocalizacion GPS</h1>
    <h2></h2>

    <ul id="navigation">
    <li><a href="#" onclick="cargarPagina('controlador/verificar.php?dialogo=hola&op=crearH&op2=0','pageContent');">Alertas_Horas</a></li>
    <li><a href="#" onclick="cargarPagina('controlador/verificar.php?dialogo=hola&op=crearH&op2=1','pageContent');" >Page 2</a></li>
    <li><a href="app.php" onclick="">Page 3</a></li>
    <li><a href="#page5">Page 5</a></li>
    <li><img id="loading" src="img/ajax_load.gif" alt="loading" /></li>
    </ul>

    <div class="clear"></div>
 <div id="verificar"></div>
    <div id="pageContent">
    Hello, this is a demo for a <a href="http://tutorialzine.com/2009/09/simple-ajax-website-jquery/" target="_blank">Tutorialzine tutorial</a>. To test it, click some of the buttons above. Have a nice stay!</div>

    </div>
    <div class="clear"></div>
<img src="img/bottom_bg.gif" alt="bottom" /></div>

<div align="center" class="demo">
this is a <a href="http://tutorialzine.com/" target="_blank">tutorialzine</a> demo</div>
    <div id="nada"></div>
</body>
<script>
    function CloseSession(){
        cargarPagina('controlador/cerrarsesion.php','nada');
 document.location="index_1.php";
   
}
</script>
</html>
<?php if (!isset($_SESSION["nombre"])){?>

<script src="js/jquery.tipsy.js" type="text/javascript"></script>
<script type='text/javascript'>
    $(function() {
	  $('#forgot_username_link').tipsy({gravity: 'w'});
    });
  </script>

<script>

function AlertH(){
    						$('#users tbody').append('<tr>' +
							'<td>' + name.val() + '</td>' +
							'<td>' + email.val() + '</td>' +
							'<td>' + password.val() + '</td>' +
							'</tr>'); 
}
	$(function() {
		$("button, input:submit, a", ".demo").button();

		$("a", ".demo").click(function() { alert('ee'); });
	});
 </script>

<?php }else {}?>
