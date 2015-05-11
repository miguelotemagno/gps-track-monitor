
var parat

function $2(id){return document.getElementById(id);}
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
   $('#loading').css('visibility','visible');
var H=http();$('#'+contenedorId).fadeTo('show', 0);

H.open('get',url,true);
H.onreadystatechange=function(){
    if(H.readyState==4){
        
        //SetContainerHTML(contenedorId,H.responseText);
        H.onreadystatechange=null;
        $('#loading').css('visibility','hidden');
        
        setTimeout("finishAjax('"+contenedorId+"', '"+escape(H.responseText)+"')", 400);

    }else{
   
    }
}
H.send(null);
}
function finishAjax(id, response){
	  $('#'+id).html(unescape(response));
	  $('#'+id).fadeTo('show', 1);
	}
 function makeArray(n) {
       this.length = n;
     }
  

