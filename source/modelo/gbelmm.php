<?php
session_start();
/* session_start();
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gbelmm
 *
 * @author Administrador
 */
class gbelmm {

        function declaravar(){

                $salida='var gmarkers22 = new Array();
                var gaddress = new Array();
                var gcomentarios = new Array();
                var glistas = new Array();
                var gtipos = new Array();
                var gstatus = new Array();
                var glabels = new Array();
                var problemas = null;
                var problemaActual = 0;
                var puntos = null;
                var i = 0;
                var tutu=0;
                var lastLabel = 0;
                var xmlDoc; //Variable que contiene el contenido de un fichero
                var map = null;
                var geocoder = null;
                var clickedPixel;
                var reversegeocoder = null;
                var manualpoint = null;	//Varible donde guardamos el punto marcado manualmente
                var actualmarker = null; //Variable que nos indica la marca que ha sido clickeada
                var distance = 0; //Guarda la distancia calculada entre dos puntos
                var distanceMatrix = null; // Variable que almacena la matriz de distancias calculada
                var gdirPeticion = null; //Variable que almacena las peticiones para conocer distancias
                var peticion = false; //Nos indica se se ha realizado una peticion de distancia al servidor de google
                var indiceF = 0; //Nos indica la fila acutal de la matriz de distancias
                var indiceC = 0; //Nos indica la columna acutal de la matriz de distancias
                var marker1 = 0; //Punto de inicio para el calculo de la distancia
                var marker2 = 0; //Punto final para el calculo de la distancia
                var xmlfile = ""; //Variable que almacena el contenido del archivo xml
                var fromHere = null; //Variable que apunta el punto inicial de la ruta
                var toHere = null; //Variable que apunta el punto final de la ruta
                var ruta = false; //Variable que nos indica si se quiere calcular la ruta entre dos puntos
                var polyline = new Array(); //Variable que contiene la ruta entre dos puntos
                var iconTypes = new Array(); //Array que contiene los iconos de los diferentes puntos
                var colorRoute = ""; //Variable que guarda el color para una ruta entre dos puntos
                var groutes = null; //Variable que contiene las rutas actualmente cargadas
                var route = null; //Varible que almacena las diferentes rutas de un resultado
                var oldMarker = false; // Indica si un punto que existia se ha sobreescrito
                var aviso = false; //Su funcion es enseñar el aviso de navegador solo una vez
                var peticionActual = 0;
                var peticionTotal = 0;
                var inicial = 0; //Indica donde empiezan los puntos del problema que se quiere dibujar
                var drawing = false; //Indica si se esta dibujando o no un problema
                var actualWay = null; //Indica la ruta clickeada';
            return $salida;

    }
        function iniciamenu(){

            $salida='
            //Inicializa el menu superior despues de elegir una opcion
            function initMenu() {
            var menu =\'<ul id="nav">\'
            + \'<li><a href="#nogo"><b>'.$_SESSION["nombre"].'</b>&#187;<!--[if gte IE 7]><!--></a><!--<![endif]-->\'
            + \'<!--[if lte IE 6]><table><tr><td><![endif]--><ul>\'
            + \'<li><a href="cerrarsesion.php">Cerrar Sesion</a></li>\'
            + \'</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->\'
            + \'</li>\'
            + \'<li><a href="#nogo">Ver &#187;<!--[if gte IE 7]><!--></a><!--<![endif]-->\'
            + \'<!--[if lte IE 6]><table><tr><td><![endif]--><ul>\'
            + \'<li> <a href="javascript:opciones(7)" /> Solo un Vehiculo </a></li>\'
            + \'<li><label><a href="javascript:opciones(6);"/>Ver Flota Entera </a></li>\'
            + \'</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->\'
            + \'</li>\'
        /*   + \'<li><a href="#nogo">Ruta Optimas &#187;<!--[if gte IE 7]><!--></a><!--<![endif]-->\'
            + \'<!--[if lte IE 6]><table><tr><td><![endif]--><ul>\'
            + \'<li><a href="javascript:opciones(8)">Fijar Nueva Direccion</a></li>\'
            + \'<li><a href="javascript:opciones(9)">Ruta entre dos puntos</a></li>\'
            + \'</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->\'*/
            + \'</ul>\'
            document.getElementById("menu").innerHTML = menu;
            }';
            return $salida;
    }
        function removeWay(){
                    $salida='function removeWay() {
                    actualWay.hide();
                    }';
                    return $salida;

        }
        function onGDirection3(){

                $salida='//Obtiene la distancia en metros entre dos puntos
                function onGDirectionsLoad3(){
                distance = gdir.getDistance().meters;
                var poly = gdir.getPolyline();
                var points = [];
                for (var i = 0; i < poly.getVertexCount(); i++) {
                points[i] = poly.getVertex(i);
                }
                var newWay = new GPolyline(points, \'#\' + colorRoute);
                GEvent.addListener(newWay, "click", function(){
                actualWay = newWay;
                document.getElementById("info").innerHTML = \'<legend><b>Info</b></legend>\'
                + \'<form name="form8" action="javascript:removeWay()">\'
                + \'<input type="submit" value="Eliminar Ruta">\'
                + \'</form></fieldset>\';
                });
                polyline.push(newWay);
                map.addOverlay(polyline[polyline.length - 1]);
                }';

                return $salida;

                }
        function removeM(){
        $salida='function removeMarker(point) {
                       var punto = buscar(point);

                        gmarkers22[punto].closeInfoWindow();
                        map.removeOverlay(gmarkers22[punto]);
                        gstatus[punto] = 1;

                        for (var j = punto + 1; j < glabels.length; j++) {
                        if (gstatus[j] == 0) {
                        glabels[j] -= 1;
                        }
                        }
                        var longitud = 0;
                        if (drawing) {
                        longitud = inicial;
                        } else {
                        longitud = gstatus.length;
                        }
                        for (var j = 0; j < longitud; j++) {
                        if ((gstatus[j] == 0) && (gtipos[j] == 3)) {
                        for (var x = 0; x < glistas[j].length; x++) {
                        var demanda = glistas[j][x].split('-');

                        if (demanda[0] == glabels[punto]) {
                        glistas[j].splice(x, 1);
                        x--;
                        } else if (demanda[0] > glabels[punto]) {
                        demanda[0] = demanda[0] - 1;
                        glistas[j][x] = demanda[0] + "-" + demanda[1];
                        }
                        }
                        }
                        }
                        lastLabel--;
                        document.getElementById("info").innerHTML = \'<legend><b>Info</b></legend>\';}';
                        return $salida;
                }
        function BluidW(){
            $salida='
                function buildWindow(punto) {

            var label = \'<b>\' + gaddress[punto] + \'</b><hr>\'
            + \'<b>Lat:</b>&nbsp;\' + gmarkers22[punto].getPoint().lat()
            + \'<b>&nbsp;Lng:</b>&nbsp;\' + gmarkers22[punto].getPoint().lng()
            + \'<b>&nbsp;ID:</b>&nbsp;\' + glabels[punto]
            + \'<br><fieldset><legend><b>Comentario</b></legend>\' + gcomentarios[punto] + \'</fieldset><br>\';
            label += \'<fieldset><legend><b>Demandas</b></legend>\';
            for (var j = 0; j < glistas[punto].length; j++) {
            label += glistas[punto][j];
            if (j < (glistas[punto].length - 1)) {
            label += " <b>,</b> "
            }
            }
            label += \'</fieldset><form name="form5" action="javascript:removeMarker(actualmarker)">\'
            + \'<input type="submit" value="Borrar">\'
            + \'</form>\';
            return label;
            }';
            return $salida;
        }
        function UpdatL(){
                    $salida='function updateList() {
                    var posicion = document.getElementById("lista").value;
                    var elemento = document.getElementById("elemento").value;
                    var llegada = document.getElementById("llegadas").value;
                    //document.write(elemento + \' \' + posicion);
                    if (llegada == -1) {
                    alert("!No ha introducido ningún punto de llegada!")
                    }
                    else {
                    var punto = buscar(actualmarker);
                    glistas[punto][posicion] = llegada + "-" + elemento;
                    //gllegadas[punto][posicion] = llegadas;
                    document.getElementById("info").innerHTML = updateInfo(punto);
                    }
                    }';
            return $salida;
            }
        function Removel(){
           $salida='function removeList() {

                var posicion = document.getElementById("a_borrar").value;

                var punto = buscar(actualmarker);
                glistas[punto].splice(posicion, 1);
                //gllegadas[punto].splice(posicion, 1);
                document.getElementById("info").innerHTML = updateInfo(punto);
                }';
            return $salida;
            }
        function Changei(){
            $salida='function changeIcon() {
            var newtype = parseInt(document.getElementById("tipos").value);

            var punto2 = buscar(actualmarker);
            var removed = gmarkers22[punto2];
            removed.closeInfoWindow();
            map.removeOverlay(removed);
            switch (newtype) {
            case 1:
            gmarkers22[punto2] = new GMarker(removed.getPoint(), {icon:iconTypes[0], draggable:true});
            gmarkers22[punto2].enableDragging();
            map.addOverlay(gmarkers22[punto2]);
            gtipos[punto2] = newtype;
            break;

            case 2:
            gmarkers22[punto2] = new GMarker(removed.getPoint(), {icon:iconTypes[1], draggable:true});
            gmarkers22[punto2].enableDragging();
            map.addOverlay(gmarkers22[punto2]);
            gtipos[punto2] = newtype;
            break;

            case 3:
            gmarkers22[punto2] = new GMarker(removed.getPoint(), {draggable:true});
            gmarkers22[punto2].enableDragging();
            map.addOverlay(gmarkers22[punto2]);
            gtipos[punto2] = newtype;
            break;

            default:
            alert("Tipo de punto desconocido");
            break;
            }

            GEvent.addListener(gmarkers22[punto2], "click", function(){
            var punto = buscar(gmarkers22[punto2].getPoint());
            actualmarker = gmarkers22[punto].getPoint();
            document.getElementById("info").innerHTML = updateInfo(punto);
            gmarkers22[punto].openInfoWindowHtml(buildWindow(punto));
            if (ruta) {
            setRoutePoints();
            }
            });


            }';
            return $salida;
        }
        function CreaInf(){        
                $salida='function createInfoMarker(point, address, comentario, lista, tipo){
                
                var marker = null;
                switch (tipo) {
                case 1:
                marker = new GMarker(point, {icon: iconTypes[0],draggable: true});
                marker.enableDragging();
                break;
                case 2:
                marker = new GMarker(point, {icon: iconTypes[1],draggable: true});
                marker.enableDragging();
                break;
                case 3:
                marker = new GMarker(point);

                break;
                }
                //Falta controlar que el punto no este dentro ya
                if (buscar(point) != -1) {
                removeMarker(point);
                oldMarker = true;
                }

                address = address.replace(/á/g, "a");
                address = address.replace(/Á/g, "A");
                address = address.replace(/é/g, "e");
                address = address.replace(/É/g, "E");
                address = address.replace(/í/g, "i");
                address = address.replace(/Í/g, "I");
                address = address.replace(/ó/g, "o");
                address = address.replace(/Ó/g, "O");
                address = address.replace(/ú/g, "u");
                address = address.replace(/Ú/g, "U");
                address = address.replace(/ñ/g, "n");
                address = address.replace(/Ñ/g, "N");

                gmarkers22[tutu] = marker;
                gaddress[tutu] = address;
                gcomentarios[tutu] = comentario;
                glistas[tutu] = lista; //a las pocisiones impares le sumamos el maximo label que habia antes de cargar
                gtipos[tutu] = tipo;
                gstatus[tutu] = 0;
                glabels[tutu] = lastLabel++;
                tutu++;

              /*  GEvent.addListener(marker, "click", function(){
                var punto = buscar(marker.getPoint());
                actualmarker = gmarkers22[punto].getPoint();
                //document.getElementById("info").innerHTML = updateInfo(punto);
                marker.openInfoWindowHtml(buildWindow(punto));
                if (ruta) {
                setRoutePoints();
                }
                });*/

                actualmarker = marker.getPoint();
                return marker;
                }';
            return $salida;
            }
        function clearR(){
                        //Borra todas las rutas dibujadas actualmente
            $salida='
            function clearRoute() {
            gdir.clear();
            document.getElementById("dirg").style.visibility="hidden";
            for (var j = 0; j < polyline.length; j++) {
            map.removeOverlay(polyline[j]);
            }
            polyline = new Array();
            document.getElementById("acciones").innerHTML = \'<legend><b>Opciones</b></legend>\';
            }';
            return $salida;
            }
        function SetRouteP(){
                $salida='//Asigna los puntos inicial y final de la ruta a las variables
                function setRoutePoints() {
                if (fromHere == null) {
                fromHere = actualmarker;
                colorRoute = document.getElementById("colors").value;
                var cadena = \'<legend><b>Opciones</b></legend>\' +
                \'<b>Escoja el punto de destino...</b>\';
                document.getElementById("acciones").innerHTML = cadena;
                }
                else {
                if (toHere == null) {
                toHere = actualmarker;
                var cadena = \'<legend><b>Opciones</b></legend>\'
                + \'<b>Los dos puntos han sido seleccionados.</b><br>\'
                + \'<b>El resultado se esta mostrando...</b>\'
                + \'<form name="form1" action="javascript:clearRoute()">\'
                + \'<input type="submit" value="Limpiar">\'
                + \'</form>\';

                document.getElementById("dirg").style.visibility="visible";
                document.getElementById("acciones").innerHTML = cadena;
                //var gdir2 = new GDirections(map);
                locale="es";
                gdir.load("from: " + fromHere.lat() + \', \' + fromHere.lng()
                + " to: " + toHere.lat() + \', \' + toHere.lng(), {getPolyline: true});
                gdir2.load("from: " + fromHere.lat() + \', \' + fromHere.lng()
                + " to: " + toHere.lat() + \', \' + toHere.lng(), { "locale": locale });

                fromHere = null;
                toHere = null;
                ruta = false;
                }
                }
                }';
            return $salida;
            }
        function Buscar(){
            $salida='//Busca un punto en el array
            function buscar(point) {
            for (var j = 0; j < gmarkers22.length; j++) {

            if (gstatus[j] != 1) {
            var aux = gmarkers22[j].getPoint();
            if ((point.lat() == aux.lat()) &&
            (point.lng() == aux.lng())) {
            return j;
            }
            }
            }
            return -1;
            }';
            return $salida;
        }
        function getDireccion(){
          $salida='  //Calcula un camino entre dos puntos
            function getDirections(){
            var saddr = document.getElementById("saddr").value
            var daddr = document.getElementById("daddr").value
            locale="es";
            gdir.load("from: " + saddr + " to: " + daddr);
            }';
            return $salida;
        }
        function ptosTot(){
         $salida='function puntosTotales(lista) {

            var contador = 0;

            for (var j = 0; j < lista.length; j++)
            contador++;
            contador = contador * contador;
            return contador;
            }';
            return $salida;
        }
        function GetDist(){
                $salida='//Funcion que calcula la matriz de distancias de los puntos actualmente marcados
                function getDistances() {
                while ((marker1 < puntos.length) & !peticion) {
                if (gstatus[puntos[marker1]] == 0) {
                var point1 = gmarkers22[puntos[marker1]].getPoint();
                while ((marker2 < puntos.length) & !peticion) {
                if (gstatus[puntos[marker2]] == 0) {
                if (marker1 != marker2) {
                var point2 = gmarkers22[puntos[marker2]].getPoint();
                gdirPeticion = new GDirections(); //document.getElementById("directions"));
                GEvent.addListener(gdirPeticion, "load", copyDistances);
                gdirPeticion.load(\'from: \' + point1.lat() + \', \' + point1.lng() + \' to: \' + point2.lat() + \', \' + point2.lng());
                peticion = true;
                } else {
                distanceMatrix[indiceF][indiceC] = 0;
                indiceC++;
                peticionActual++;
                var porcentaje = peticionActual * 100 / peticionTotal;
                progreso(porcentaje);
                }
                }
                if (!peticion) {
                marker2++;
                }
                }
                if (!peticion) {
                marker2 = 0;
                indiceC = 0;
                indiceF++;
                if (moreMarkers()) {
                distanceMatrix[indiceF] = new Array();
                }
                }
                }
                if (!peticion) {
                marker1++;
                }
                }
                if ((marker1 == puntos.length) & !peticion) {
                showDistanceMatrix();
                problemaActual += 2;
                calcularProblemas();
                }}
                ';
            return $salida;
        }
        function Pertenece(){
        $Salida='//Nos indica si un punto pertenece a una ruta concreta
            function perteneceARuta(punto, llegada) {
            for (var x = 0; x < glistas[punto].length; x++) {
            var demanda = glistas[punto][x].split('-');
            if (demanda[0] == llegada) {
            return true;
            }
            }
            return false;
            }';
            return $salida;
        }
        function TratarPto(){
        $salida='            function tratarPunto(response){
            if (!response || response.Status.code != 200) {
            alert("No encontrado");
            } else {
            var place = response.Placemark[0];
            var point = new GLatLng(place.Point.coordinates[1], place.Point.coordinates[0]);
            //reversegeocoder.reverseGeocode(point);
            var marker = createInfoMarker(point, place.address, "", [], 3);
            map.addOverlay(marker);
            map.setCenter(point, 15);
            document.getElementById("acciones").innerHTML = \'<legend><b>Opciones</b></legend>\';
            }

            }';
            return $salida;

          }
        function BuscarDire(){
           $salida='         //*************************FIND DIR**************************************
                    //Busca una direccion en el mapa
                    function findDir(){
                    var municipio = document.getElementById("municipio").value;
                    var calle = document.getElementById("calle").value;
                    var numero = document.getElementById("numero").value;

                    if (calle != "") {
                    municipio += \', \' + calle;
                    }
                    if (numero != "") {
                    municipio += \', \' + numero;
                    }

                    //municipio += \', \' + calle + \', \' + numero;
                    geocoder = new GClientGeocoder();
                    if (geocoder) {
                    geocoder.getLocations(municipio, tratarPunto);
                    }

                    }';
                    return $salida;
          }
        function maplimpio(){
                $salida='//***********************EMPTY MAP***************************************
                //Comprueba si el mapa esta vacio o no
                function emptyMap() {
                for (var j = 0; j < gstatus.length; j++) {
                if (gstatus[j] == 0) {
                return false;
                }
                }
                return true;
                }';
                return $salida;
            }
        function drawR(){
            $salida='function drawRoute() {
            if (indiceF < groutes.length) {
            route.loadFromWaypoints(groutes[indiceF], {getPolyline: true});
            } else {
            alert("Rutas Dibujadas");
            indiceF = 0;
            document.getElementById("acciones").innerHTML = \'<legend><b>Opciones</b></legend>\'
            + \'<b>Si desea limpiar todo el mapa presione el bot&oacute;n</b>\'
            + \'<form name="form5" action="javascript:clearRoute()">\'
            + \'<input type="submit" value="Eliminar todas las rutas">\'
            + \'</form></fieldset>\'
            }
            }';
            return $salida;
        }
        function onGDirecion2(){

            $salida='//Se ejecuta cuando la peticion de ruta ha sido devuelta
            function onGDirectionsLoad2(){
            var poly = route.getPolyline();
            var points = [];
            for (var io = 0; io < poly.getVertexCount(); io++) {
            points[io] = poly.getVertex(io);
            }
            var newWay = new GPolyline(points, \'#\' + colors[indiceF % 6])
            GEvent.addListener(newWay, "click", function(){
            actualWay = newWay;
            document.getElementById("info").innerHTML = \'<legend><b>Info</b></legend>\'
            + \'<form name="form8" action="javascript:removeWay()">\'
            + \'<input type="submit" value="Eliminar Ruta">\'
            + \'</form></fieldset>\';
            });
            polyline.push(newWay);
            map.addOverlay(polyline[polyline.length - 1]);
            indiceF++;
            setTimeout("drawRoute()", 2000);
            }';
            return $salida;
        }
        function opciones(){
                $salida='//Carga en el panel opciones el codigo adecuado para realizar acciones
                function opciones(i) {
                var cadena = \'<legend><b>Opciones</b></legend>\';

                switch(i){
                case 1: //Abrir archivo XML
                if (!aviso & (navigator.appName == "Microsoft Internet Explorer")) {
                alert("Advertencia: Para un funcionamiento correcto, deberá ir a Herramientas->Opciones de Internet->Opciones Avanzadas->Seguridad y desactivar la opcion Habilitar compatibilidad con XMLHTTP nativo, en el caso de no haberlo hecho anteriomente.");
                aviso = true;
                }
                cadena += \'<b>Introducir Fichero Xml:</b> <form name="form3" action="javascript:loadFile()">\'
                + \'<input type="file" SIZE=30 MAXLENGTH=255 name="archivo" id="archivo" value=""/>\'
                + \'<input type="submit" value="Aceptar">\'
                + \'</form>\';
                document.getElementById("acciones").innerHTML = cadena;
                initMenu();
                break;

                case 3: //Añadir al mapa el contenido del editor XML
                addToMap();
                initMenu();
                break;

                case 4: //Copiar al mapa el contenido del editor XML
                copyToMap();
                initMenu();
                break;

                case 6: //Copiar el contenido del mapa al editor XML
                ocultar2();
                document.getElementById("acciones").innerHTML = cadena+=\'\';
                break;

                case 7: //Añadir el contenido del mapa al editor XML
                document.getElementById("acciones").innerHTML = cadena+=\'<div id="pat"></div>\';
                cargarPagina(\'addpatente.php?user='.$_SESSION["cod"].'\',\'pat\');ver();
                initMenu();
                break;

                case 8: //Centra el mapa en la zona que se busca
                cadena += \'<b>Introducir Direccion:</b>\'
                + \'<form name="form2" action="javascript:findDir()">\'
                + \'<fieldset><legend>Municipio</legend><input type="text" SIZE=30 MAXLENGTH=100 name="municipio" id="municipio" value=""/></fieldset>\'
                + \'<fieldset><legend>Calle</legend><input type="text" SIZE=30 MAXLENGTH=100 name="calle" id="calle" value=""/></fieldset>\'
                + \'<fieldset><legend>N&uacute;mero</legend><input type="text" SIZE=30 MAXLENGTH=100 name="numero" id="numero" value=""/></fieldset>\'
                + \'<input type="submit" value="Buscar">\'
                + \'</form>\';
                document.getElementById("acciones").innerHTML = cadena;
                initMenu();
                break;

                case 9: //Nos indica la ruta entre dos puntos dados
                ruta = true;
                cadena += \'<b>Escoja un color...</b>\'
                + \'<select id="colors" tabindex="3" MAXLENGTH=100 name="colors">\'
                + \'<option value="FF0000" style="color:#FF0000">Rojo\'
                + \'<option value="00FF00" style="color:#00FF00">Verde\'
                + \'<option value="0000FF" style="color:#0000FF">Azul\'
                + \'<option value="00FFFF" style="color:#00FFFF">Turquesa\'
                + \'<option value="FF00FF" style="color:#FF00FF">Magenta\'
                + \'<option value="FFFF00" style="color:#FFFF00">Amarillo\'
                + \'</select><br><br>\';
                cadena += \'<b>Escoja el punto de inicio...</b>\';
                document.getElementById("acciones").innerHTML = cadena;
                initMenu();
                break;



                default:
                cadena += \'<br>Opci�n no disponible</br>\';
                document.getElementById("acciones").innerHTML = cadena;
                initMenu();
                }
                }

                //]]>
                initMenu();
                var gdir = new GDirections();
                var gdir2 = new GDirections(map, document.getElementById("directions"));
                GEvent.addListener(gdir2, "load", onGDirectionsLoad);

                GEvent.addListener(gdir, "load", onGDirectionsLoad3);



                route = new GDirections();
                GEvent.addListener(route, "load", onGDirectionsLoad2);
                reversegeocoder2 = new GReverseGeocoder(map);
                GEvent.addListener(reversegeocoder2, "load",
                function(placemark) {
                var marker = new createInfoMarker(manualpoint, placemark.address, "", [], 3);
                map.addOverlay(marker);
                document.getElementById("info").innerHTML = updateInfo(i - 1);
                }
                );
                i=0;
                function setDirections(fromAddress, toAddress, locale) {
                gdir.load("from: " + fromAddress + " to: " + toAddress,
                { "locale": \'es\' });
                }

                ';
            return $salida;
        }
}
?>
