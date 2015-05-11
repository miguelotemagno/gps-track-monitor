var ds=""
    var pps=new Array();
    var cccs="";
    var ss="";
    var tiemd;
function MapaJSClass(tip,date2w,Vehiculos){
     this.tip=tip;
     var date2=date2w;
     this.Vehiculo=Vehiculos;
     var inicio=0;
     var patenter=new Array();
     var cantidad=new Array();
     this.BuscarMain=BuscarMain;
     
     
     function BuscarMain() {
            
                        //delay=null;
                        clearInterval(tiemd);
                        var urlstr='controlador/run.php?consult=1&date2='+date2+'&Patente='+vehiculosElegidos;
                            var PatenteV = new Array();
                            var CantidadV = new Array();
                            var searchUrl = urlstr;
                        this.downloadUrl(searchUrl, function(data) {
                                var xml = parseXml(data);
                                var locations = xml.documentElement.getElementsByTagName("marker");
                                if (locations[0].getAttribute('cantidad')=="0"){sinreg();clearLocations2();return null;}
                                
                             clearLocations2();

                                

                                for (var io = 0; io < locations.length; io++) {
                                patenter[io]=locations[io].getAttribute('patente');
                                
                                cantidad[io]=locations[io].getAttribute('cantidad');
                                
                                  }
                             
                                
                                var limit=inicio+2;



                              
                                for (var io2 = 0; io2 <patenter.length; io2++) {
                                    var urlstr='controlador/run.php?consult=2&date2='+date2+'&idv='+patenter[io2]+'&star='+inicio+'&limit='+limit;
                                    var latV=new Array();
                                var lonV=new Array();
                                var pointV=new Array();
                                var fechV=new Array();
                                var horaV=new Array();
                                var modV=new Array();
                                var marV=new Array();
                                var velV=new Array();
                                var disV=new Array();
                                    downloadUrl(urlstr, function(data) {
                                            var xml = parseXml(data);
                                            var locations = xml.documentElement.getElementsByTagName("marker");
                                            if (locations.length==0){initd();clearLocations2();return null;}

                                            

                                            for (var io2 = 0; io2 < locations.length; io2++) {
                                            latV[io2]=locations[io2].getAttribute('lat');
                                            lonV[io2]=locations[io2].getAttribute('lng');
                                            pointV[io2]=new google.maps.LatLng(parseFloat(locations[io2].getAttribute('lat')),parseFloat(locations[io2].getAttribute('lng')));
                                            fechV[io2]=' <b>Fecha: </b>'+locations[io2].getAttribute('fecha')+'<br>';
                                            horaV[io2]=' <b>Hora: </b>'+locations[io2].getAttribute('hora')+'<br>';
                                            modV[io2]=' <b>Modelo </b>'+locations[io2].getAttribute('modelo')+'<br>';
                                            marV[io2]=' <b>Marca: </b>'+locations[io2].getAttribute('marca')+'<br>';
                                            velV[io2]=' <b>Velocidad: </b>'+locations[io2].getAttribute('velocidad')+' km/h<br>';
                                            disV[io2]=' <b>Distancia recorrida: </b>'+locations[io2].getAttribute('dist')+' KM<br>';
                                            

                                             }

                                           var s=Concurrent.Thread.create(mostrar,latV,lonV,pointV,fechV,horaV,modV,marV,patenter,velV,disV,locations.length);



                                            




                                   });
                                }
                                rungps(date2,patenter,cantidad,2);aler();








                       });
                       
                      
                  

                      }
    
   


 }
 function downloadUrl(url,callback) {
                 var request = window.ActiveXObject ?
                     new ActiveXObject('Microsoft.XMLHTTP') :
                     new XMLHttpRequest;

                 request.onreadystatechange = function() {
                   if (request.readyState == 4) {
                     request.onreadystatechange = doNothing;
                     callback(request.responseText, request.status);
                   }
                 };

                 request.open('GET', url, true);
                 request.send(null);
                }
function mostrar(lat,lng,point,fech,hora,mod,mar,pat,vel,dis,total){
    c2=0;
            for (x=0;x<total;x++){
                        
                        cargarPagina('controlador/Alert.php?fecha='+fech[c2]+'&hora='+hora[c2]+'&patente='+pat[c2],'none');
                        infoWindow.close();
                        var html='<div>'+pat[c2]+mar[c2]+mod[c2]+hora[c2]+fech[c2]+vel[c2]+dis[c2]+'</div>';
                        if (c2>0){
                            var lati=lat[c2-1];var longg=lng[c2-1];var lati2=lat[c2];var long2=lng[c2];
                            
                            codeLatLng(point[c2],lat[c2-1],lng[c2-1],html);
                        }
                        else codeLatLng(point[c2],lat[c2],lng[c2],html);
                              c2++;
                  
            }

}

              function xloadA(pag) { //Asíncrono
    if (typeof window.ActiveXObject != 'undefined' ) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
        req.onreadystatechange = xres ;
    } else {
        req = new XMLHttpRequest();
        req.onload = xres ;
    }
    req.open("GET", pag, true );
    req.send( null );
}

function xloadS(pag) { //Síncrono
    if (typeof window.ActiveXObject != 'undefined' ) req = new ActiveXObject("Microsoft.XMLHTTP");
    else req = new XMLHttpRequest();
    req.open("GET", pag, false);
    req.send(null);
    return req.responseText;
}

function xres() {
    if (req.readyState != 4) return ;
    alert(req.responseText);
}

function DataGPS(date,patentess,total,star){
                    try {

                                
                                var patentes=patentess;
                                




                                for (var io2 = 0; io2 <patentes.length; io2++) {
                                var limit=2;
                                var latV=new Array();
                                var lonV=new Array();
                                var pointV=new Array();
                                var fechV=new Array();
                                var horaV=new Array();
                                var modV=new Array();
                                var marV=new Array();
                                var velV=new Array();
                                var disV=new Array();

                                    var urlstr='controlador/run.php?consult=2&date2='+date+'&idv='+patentes[io2]+'&star='+star+'&limit='+limit;

                                    downloadUrl(urlstr, function(data) {
                                            var xml = parseXml(data);
                                            var locations = xml.documentElement.getElementsByTagName("marker");
                                            if (locations.length==0){initd();clearLocations2();return null;}

                                          

                                            for (var io2 = 0; io2 < locations.length; io2++) {
                                            latV[io2]=locations[io2].getAttribute('lat');
                                            lonV[io2]=locations[io2].getAttribute('lng');
                                            pointV[io2]=new google.maps.LatLng(parseFloat(locations[io2].getAttribute('lat')),parseFloat(locations[io2].getAttribute('lng')));
                                            fechV[io2]=' <b>Fecha: </b>'+locations[io2].getAttribute('fecha')+'<br>';
                                            horaV[io2]=' <b>Hora: </b>'+locations[io2].getAttribute('hora')+'<br>';
                                            modV[io2]=' <b>Modelo </b>'+locations[io2].getAttribute('modelo')+'<br>';
                                            marV[io2]=' <b>Marca: </b>'+locations[io2].getAttribute('marca')+'<br>';
                                            velV[io2]=' <b>Velocidad: </b>'+locations[io2].getAttribute('velocidad')+' km/h<br>';
                                            disV[io2]=' <b>Distancia recorrida: </b>'+locations[io2].getAttribute('dist')+' KM<br>';


                                             }

                                           Concurrent.Thread.create(mostrar,latV,lonV,pointV,fechV,horaV,modV,marV,patentes,velV,disV,locations.length);








                                   });


                        }var star2=star+1;rungps(date,patentes,total,star2);aler();
                    } catch(e) {
					alert(e.name + " - " + e.message);
				}
                            }


function rungps(date2,patenter,cantidad,s){
    if (s<=cantidad-2){
    ds=date2;
    pps=patenter;
    cccs=cantidad;
    ss=s;
    tiemd=setTimeout("DataGPS(ds,pps,cccs,ss)",delay);}

}
function clearLocations2() {
     infoWindow.close();
        if (flightPath) {
      flightPath.setMap(null);
    }
    flightPath=null;
     for (var i = 0; i < markers.length; i++) {
       markers[i].setMap(null);
     }
     markers.length = 0;

   }
       function parseXml(str) {
      if (window.ActiveXObject) {
        var doc = new ActiveXObject('Microsoft.XMLDOM');
        doc.loadXML(str);
        return doc;
      } else if (window.DOMParser) {
        return (new DOMParser).parseFromString(str, 'text/xml');
      }
    }