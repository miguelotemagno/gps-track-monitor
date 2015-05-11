<?php ob_start();
session_start();?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/Concurrent.Thread-full-20090713.js"></script>
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
         function makeArray(n) {
       this.length = n;
     }
     function stopBanner() {
       if (bannerRunning)
         clearTimeout(timerID);
       bannerRunning = false;
     }
     function startBanner() {
       stopBanner();
       showBanner();
     }
     function showBanner() {
       var text = ar[currentMessage];
       if (offset < text.length) {
         if (text.charAt(offset) == " ")
           offset++;
         var partialMessage = text.substring(0, offset + 1);
         window.status = partialMessage;
         offset++;
         timerID = setTimeout("showBanner()", speed);
         bannerRunning = true;
       } else {
         offset = 0;
         currentMessage++;
         if (currentMessage == arlength)
           currentMessage = 0;
         timerID = setTimeout("showBanner()", pause);
         bannerRunning = true;
       }
     }

var speed = 100 // velocidad del texto
var pause = 1000 // Pausa cuando el texto esta completo
var timerID = null;
var bannerRunning = false;
var currentMessage = 0;
var offset = 0;

var arlength = 3; // numero de mensajes
var ar = new makeArray(arlength); // numero de mensajes
ar[0] = "Esto es un texto escrito en la barra estado";
ar[1] = "Esta es el segundo texto";
ar[2] = "Visita http://dipro.multimania.com para ver miles de scripts."
window.onload=function() {
    startBanner();
}
  
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

</script>
<link id="jQueryUICssSrc" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/ui-lightness/jquery-ui.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript">

        $('#jQueryUICssSwitch').combobox({
            listHeight:200,
            list: [
                    { value: "base", text: "base" },
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
                    { value: "ui-lightness", text: "ui-lightness", selected: true },
                    { value: "vader", text: "vader" },
                    ]
                , changed: function(e, ui) {
                    $('#jQueryUICssSrc').attr('href', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/' + ui.value + '/jquery-ui.css');
                }
        });
        function jQueryUICss_Changed(ddl, i) {

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

body {
	margin: 0; padding: 0;
	font: 10px normal Arial, Helvetica, sans-serif;
	background: #ddd url(images/body_bg.gif) repeat-x;
}
.container {
	width: 960px;
	margin: 0 auto;
	position: relative;
}
#header {
	background: url(images/header_bg2.png) no-repeat center top;
	padding-top: 120px;
}
#header .disclaimer {
	color: #999;
	padding: 100px 0 7px 0;
	text-align: right;
	display: block;
	position: absolute;
	top: 0; right: 0;
}
#header .disclaimer a {	color: #ccc;}
ul.topnav {
	list-style: none;
	padding: 0 20px;
	margin: 0;
	float: left;
	width: 920px;
	background: #222;
	font-size: 1.2em;
	background: url(images/topnav_bg.gif) repeat-x;
}
ul.topnav li {
	float: left;
	margin: 0;
	padding: 0 15px 0 0;
	position: relative; /*--Declare X and Y axis base--*/
}
ul.topnav li a{
	padding: 10px 5px;
	color: #fff;
	display: block;
	text-decoration: none;
	float: left;
}
ul.topnav li a:hover{
	background: url(images/topnav_hover.gif) no-repeat center top;
}
ul.topnav li span { /*--Drop down trigger styles--*/
	width: 17px;
	height: 35px;
	float: left;
	background: url(images/subnav_btn.gif) no-repeat center top;
}
ul.topnav li span.subhover {background-position: center bottom; cursor: pointer;} /*--Hover effect for trigger--*/
ul.topnav li ul.subnav {
	list-style: none;
	position: absolute; /*--Important - Keeps subnav from affecting main navigation flow--*/
	left: 0; top: 35px;
	background: #333;
	margin: 0; padding: 0;
	display: none;
	float: left;
	width: 170px;
	-moz-border-radius-bottomleft: 5px;
	-moz-border-radius-bottomright: 5px;
	-webkit-border-bottom-left-radius: 5px;
	-webkit-border-bottom-right-radius: 5px;
	border: 1px solid #111;
}
ul.topnav li ul.subnav li{
	margin: 0; padding: 0;
	border-top: 1px solid #252525; /*--Create bevel effect--*/
	border-bottom: 1px solid #444; /*--Create bevel effect--*/
	clear: both;
	width: 170px;
}
html ul.topnav li ul.subnav li a {
	float: left;
	width: 145px;
	background: #333 url(images/dropdown_linkbg.gif) no-repeat 10px center;
	padding-left: 20px;
}
html ul.topnav li ul.subnav li a:hover { /*--Hover effect for subnav links--*/
	background: #222 url(images/dropdown_linkbg.gif) no-repeat 10px center;
}
#header img {
	margin: 20px 0 10px;
}
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

</head>

<body onLoad="startBanner()">


<div id="tabs" >
	<ul>
		<li><a href="#tabs-1"><?php echo $_SESSION["nombre"];?> </a></li>
		<li><a href="vista/datos.php">Vehiculos</a></li>
	</ul>
	<div id="tabs-1">
            <div id="Alertas" class="ui-widget-content" style="visibility:hidden">
	<h3 class="ui-widget-header">Configurar Alertas!</h3>
		<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
			
                            <div id="verificar"></div>
        <button onclick="cargarPagina('controlador/verificar.php?dialogo=hola&op=crearH&op2=0','divtablaH');">Ver Alertas de Hora</button>
        <button onclick="cargarPagina('controlador/verificar.php?dialogo=hola&op=crearH&op2=1','divtablaH');">Ver Alertas Velocidad</button>
                            <div id="divtablaH"></div>
                            
			</div>
                    
		</div>
        <input value="A submit button" type="submit">
        
        
	

	

		</div>
            </div>
  <div id="Reportes" class="ui-widget-content" style="visibility:hidden">
	<h3 class="ui-widget-header">Resizable</h3>
</div>
            <div id="opciones" class="ui-widget-content" style="visibility:hidden">
	<h3 class="ui-widget-header">Resizable</h3>
</div>
<div id="jQueryUICssSwitch"></div>
	</div>

<div class="container">

    <div id="header">
    	
        <ul class="topnav">
            <li><a href="#">Home</a></li>
             <li>
             <a href="#">Ver</a>

                <ul class="subnav">
                    <li><a href="#" onclick="verAlertas(true),verReportes(false),verOpciones(false)">Ver Alertas</a></li>
                    <li><a href="#" onclick="verAlertas(false),verReportes(true),verOpciones(false)">Ver Reportres</a></li>

                    <li><a href="#">...</a></li>

                </ul>
            </li>
            <li>
             <a href="#">Opciones</a>

                <ul class="subnav">
                    <li><a href="#" onclick="verAlertas(true),verReportes(false),verOpciones(false)">Configurar Alertas</a></li>
                    <li><a href="#" onclick="verAlertas(false),verReportes(true),verOpciones(false)">Configurar Reportres</a></li>
                    
                    <li><a href="#">...</a></li>
                    
                </ul>
            </li>
            <li>
                <a href="#">Mapa</a>
                <ul class="subnav">
                    <li><a href="app.php">Panel Principal</a></li>
                 </ul>
            </li>
            <li>
                <a href="#">Opciones</a>
                <ul class="subnav">
                    <li><a href="#" onclick="verAlertas(false),verReportes(false),verOpciones(true)">General</a></li>
                 </ul>
            </li>


            
            
            <li><a href="#">Contacto</a></li>
            <li><a href="controlador/cerrarsesion.php">Salir</a></li>
        </ul>
    </div>
</div>
   
	<div id='content'>
		<div id='contact-form'>

                    <input type='button' name='contact' value='Demo' class='contact demo' id="pp" style="visibility:hidden"/>
		</div>
		<!-- preload the images -->
		<div style='display:none'>
			<img src='img/contact/loading.gif' alt='' />
		</div>
	</div>


</body>

</html>
<?php if (!isset($_SESSION["nombre"])){?>

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

function addEvent(obj, evType, fn, useCapture){

 if (obj.addEventListener){
    obj.addEventListener(evType, fn, useCapture);

  } else if (obj.attachEvent){
    obj.attachEvent("on"+evType, fn);

  } else {
   obj['on'+evType]=fn;
  }
}
function hablar(e) {

}


window.onload=function() {

    // Coloco el evento click
    addEvent(document.getElementById('pp'), 'click', hablar, false);
    // Lo lanzo forzosamente
    if( document.fireEvent ) {                            // IE
        document.getElementById('pp').fireEvent("onclick");
    }
    else if( document.dispatchEvent ) {                    // estándar
        var evObj = document.createEvent('MouseEvents');                                // creamos el evento de tipo MouseEvents
        evObj.initMouseEvent( 'click', true, true, window, 1, 12, 345, 7, 220, false, false, true, false, 0, null );    // le damos características
        document.getElementById('pp').dispatchEvent(evObj);
    }
    else
        alert("No puedo lanzar evento");
} </script>

<?php }else {}?>
