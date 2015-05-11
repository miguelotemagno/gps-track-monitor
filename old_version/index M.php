<!DOCTYPE html>
<html>
<head>
<title> Sistema de Posicionamiento Global Ucinf 2010</title>

<!-- Page styles -->
<link type='text/css' href='css/demo2.css' rel='stylesheet' media='screen' />

<!-- Contact Form CSS files -->
<link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />

<!-- JS files are loaded at the bottom of the page -->
</head>
<body>
<div id='container'>
	<div id='logo'>
		
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
	
</div>
<!-- Load JavaScript files -->
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/contact.js'></script>
<?php ob_start();
session_start();


if (!isset($_SESSION["nombre"])){?>
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


window.onload=function()
{
    
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
}
</script>
<?php }else {header('location: app.php');}?>
</body>
</html>