        

var opckek=true;
var opckek2=false;

function $(id){return document.getElementById(id);}
function http(){
    if(window.XMLHttpRequest){
        return new XMLHttpRequest();
    }else{
        try{
            return new ActiveXObject('Microsoft.XMLHTTP');
        }catch(e){
            alert('nop');
            return false;
        }
    }
}
function SetContainerHTML(id_contenedor,responseText)
{
mydiv = document.getElementById(id_contenedor);
//reemplazando por code salvamos bug de Explorer 7
responseText=responseText.split('SCRIPT').join('code')
mydiv.innerHTML = responseText;
var elementos = mydiv.getElementsByTagName('code');
for(i=0;i<elementos.length;i++) {
var elemento = elementos[i];
nuevoScript = document.createElement('script');
nuevoScript.text = elemento.innerHTML;
nuevoScript.type = 'text/javascript';
if(elemento.src!=null && elemento.src.length>0)
{nuevoScript.src = elemento.src;}
elemento.parentNode.replaceChild(nuevoScript,elemento);
}
}
function cargarPagina(url,contenedorId){
var H=http();
H.open('get',url,true);
H.onreadystatechange=function(){
    if(H.readyState==4){
        SetContainerHTML(contenedorId,H.responseText);
        H.onreadystatechange=null;
    }else{
        $(contenedorId).innerHTML='<img src="images/loader.gif" width="16" height="16" alt="ajax"/>';
    }
}
H.send(null);
}

	function onGDirectionsLoad(){
      // Use this function to access information about the latest load()
      // results.

      // e.g.
      // document.getElementById("getStatus").innerHTML = gdir.getStatus().code;
	  // and yada yada yada...
	}


function ocultar2(){
document.getElementById("pat").style.visibility="hidden";
document.getElementById("d").index =-1;
opckek2=false;
opckek=true;
}
function ver(){
document.getElementById("pat").style.visibility="visible";
opckek2=true;
opckek=false;
}
function newline() {
        var total = document.getElementById("newline-wrapper").getElementsByTagName("table").length;
        total++;

        // Clone the first div in the series
        var tbl = document.getElementById("newline-wrapper").getElementsByTagName("table")[0].cloneNode(true);

        // DOM inject the wrapper div
        document.getElementById("newline-wrapper").appendChild(tbl);

        var buts = tbl.getElementsByTagName("a");
        if(buts.length) {
                buts[0].parentNode.removeChild(buts[0]);
                buts = null;
        }

        // Reset the cloned label's "for" attributes
        var labels = tbl.getElementsByTagName('label');

        for(var i = 0, lbl; lbl = labels[i]; i++) {
                // Set the new labels "for" attribute
                if(lbl["htmlFor"]) {
                        lbl["htmlFor"] = lbl["htmlFor"].replace(/[0-9]+/g, total);
                } else if(lbl.getAttribute("for")) {
                        lbl.setAttribute("for", lbl.getAttribute("for").replace(/[0-9]+/, total));
                }
        }

        // Reset the input's name and id attributes
        var inputs = tbl.getElementsByTagName('input');
        for(var i = 0, inp; inp = inputs[i]; i++) {
                // Set the new input's id and name attribute
                inp.id = inp.name = inp.id.replace(/[0-9]+/g, total);
                if(inp.type == "text") inp.value = "";
        }

        // Call the create method to create and associate a new date-picker widgit with the new input
        datePickerController.create(document.getElementById("date-" + total));

        var dp = datePickerController.datePickers["dp-normal-1"];

        // No more than 5 inputs
        if(total == 5) document.getElementById("newline").style.display = "none";

        // Stop the event
        return false;
}

function createNewLineButton() {
        var nlw = document.getElementById("newline-wrapper");

        var a = document.createElement("a");
        a.href="#";
        a.id = "newline";
        a.title = "Create New Input";
        a.onclick = newline;
       // nlw.parentNode.appendChild(a);

        a.appendChild(document.createTextNode("+"));
        a = null;
}




function highlightCalendarCell(element) {
		$(element).style.border = '1px solid #999999';
	}

	function resetCalendarCell(element, color) {
		$(element).style.border = '1px solid #000000';
	}

	function startCalendar(month, year) {
		new Ajax.Updater('calendarInternal', 'rpc.php', {method: 'post', postBody: 'action=startCalendar&month='+month+'&year='+year+''});
	}


function cambiartiempo(opcion){
if (opcion==0){
    delay=50;
}
if (opcion==1){
    delay=200;
}
if (opcion==2){
    delay=500;
}
if (opcion==3){
    delay=700;
}
if (opcion==4){
    delay=1000;
}
if (opcion==5){
    delay=1500;
}
if (opcion==6){
    delay=2000;
}
if (opcion==7){
    delay=2500;
}
if (opcion==8){
    delay=3000;
}
if (opcion==9){
    delay=6000;
}
}
function aleatorio(inferior,superior){
   numPosibilidades = superior - inferior
   aleat = Math.random() * numPosibilidades
   aleat = Math.floor(aleat)
   return parseInt(inferior) + aleat
} 
function dame_color_aleatorio(){
   hexadecimal = new Array("0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F")
   color_aleatorio = "#";
   for (i=0;i<6;i++){
      posarray = aleatorio(0,hexadecimal.length)
      color_aleatorio += hexadecimal[posarray]
   }
   return color_aleatorio
}
function comollegar(){
    if (document.getElementById("dirg").style.visibility=="visible")
        document.getElementById("dirg").style.visibility="hidden";
    else
        document.getElementById("dirg").style.visibility="visible";
}
function pause(millisecs) {
  var future = new Future();
  setTimeout(function() {
    future.fulfill()
  },millisecs);
  future.suspend();
}

function setdir(hh){
    dir=hh;
}

function getdir(){
    return dir;
}
  function direccion(add) {
      latlng=add;
      
        geocoder.getLocations(latlng, function(addr) {
          if(addr.Status.code != 200) {
            
          }
          else {
              
            address = addr.Placemark[0];
           dir = address.address;
           setdir(dir);

          }
        });
           
           return getdir();
          }


function pause(numberMillis) {
    var now = new Date();
    var exitTime = now.getTime() + numberMillis;
    while (true) {
        now = new Date();
        if (now.getTime() > exitTime)
            return;
    }
}
