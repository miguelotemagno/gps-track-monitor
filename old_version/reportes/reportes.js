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

function menuReportes()
{
    var lsBody = document.getElementsByTagName('BODY');
    var body   = null;
    
    for(var i in lsBody)
        if(lsBody[i].tagName == 'BODY')
            body = lsBody[i];

    if(body != null)
    {
        var obj1 = document.createElement('DIV');
        var obj2 = document.createElement('DIV');
        //var obj3 = document.createElement('SELECT');
        var opt1 = document.createElement('OPTION');
        var opt2 = document.createElement('OPTION');
        var opt3 = document.createElement('OPTION');

        obj1.id = 'dock';
        obj2.id = 'theme';
        body.appendChild(obj1);
        obj1.appendChild(obj2);

        var obj = document.getElementById('theme');
        obj.innerHTML  = '<select id="menuReportes" onchange="abre(this.options[this.selectedIndex].value)">';
        //obj.innerHTML += '<option value="">-- Reportes --</option>';
        //obj.innerHTML += '<option value="onVehiculoDetenido">Vehiculos Detenidos</option>';
        //obj.innerHTML += '<option value="onMaxVelocidad">Vehiculos alta Velocidad</option>';
        obj.innerHTML += '</select>';

        var sel = document.getElementById('menuReportes');
        //obj2.appendChild(obj3);
        //obj3.onChange = 'abre(this.options[this.selectedIndex].value)';
        //obj3.addProperty('onChange','abre(this.options[this.selectedIndex].value)');
        opt1.value = '';
        opt1.text  = '-- Reportes --';
        opt2.value = 'onVehiculoDetenido';
        opt2.text  = 'Vehiculos Detenidos';
        opt3.value = 'onMaxVelocidad';
        opt3.text  = 'Vehiculos alta Velocidad';
        sel.appendChild(opt1);
        sel.appendChild(opt2);
        sel.appendChild(opt3);
    }
    else
        alert('null');

}

//menuReportes();