/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var tasks = new Array();
var AjaxStatus = 0;

function AJAX(funcion,args,strURL)
{
	var xmlHttpReq = false;
	var self       = this;
        var lista      = new Array();

	if(AjaxStatus == 0)
	{
		// Mozilla/Safari
		if (window.XMLHttpRequest) self.xmlHttpReq = new XMLHttpRequest();
		// IE
		else if (window.ActiveXObject) self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

		self.xmlHttpReq.open('POST', strURL, true);
		self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		self.xmlHttpReq.onreadystatechange = function() {
			AjaxStatus = self.xmlHttpReq.readyState;
			if (self.xmlHttpReq.readyState == 4)
			{
				var ejecuta = funcion+'(self.xmlHttpReq.responseText);';
				eval(ejecuta);
				AjaxStatus = 0;
			}
		}

		for(var key in args)
			lista.push(key+'='+args[key]);

		self.xmlHttpReq.send(lista.join('&'));
	}
}

/******************************************************************************/

function onVehiculoDetenido()
{
    var params = new Array();
    var ventana = document.getElementById('RepVehiculoDetenido');

    if(ventana == null)
    {
        var fecha = prompt("Ingrese una fecha a consultar:");
        if(fecha != null)
        {
            params['fecha'] = fecha;
            AJAX('displayRepVehiculoDetenido',params,'repVehiculoDetenido.php');
        }
    }
}

function onMaxVelocidad()
{
    var params = new Array();
    var ventana = document.getElementById('MaxVelocidad');

    if(ventana == null)
    {
        var fecha = prompt("Ingrese una fecha a consultar:");

        if(fecha != null)
        {
            params['fecha'] = fecha;
            AJAX('displayMaxVelocidad',params,'repMaxVelocidad.php');
        }
    }
}

function displayRepVehiculoDetenido(src)
{
    win = new Window({
        id: "RepVehiculoDetenido",
        className: "mac_os_x",
        title: "Reporte Vehiculos detenidos",
        width:300,
        height:300,
        destroyOnClose: true,
        recenterAuto:false
    });
    win.getContent().update(src);
    win.showCenter();
}

function displayMaxVelocidad(src)
{
    win = new Window({
        id: "MaxVelocidad",
        className: "mac_os_x",
        title: "Vehiculos con alta Velocidad",
        width:300,
        height:300,
        destroyOnClose: true,
        recenterAuto:false
    });
    win.getContent().update(src);
    win.showCenter();
}

function abre(funcion)
{
    //ejemplo fecha=2008-10-12

    if(funcion != '')
        eval(funcion+'();');
    else
        alert('Debe elejir un reporte a desplegar');
}