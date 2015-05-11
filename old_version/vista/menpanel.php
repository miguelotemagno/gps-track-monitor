<?php
session_start();

Class MenuMap{
protected $nombreJS;
protected $nombreDiaglogo;
protected $altura=0;
protected $ancho =0;
protected $modal='false';
protected $show;
protected $hide;
protected $tamañoVariable='true';
protected $arrastrable='true';
protected $NomBoton1;
protected $NomBoton2;
protected $func1;
protected $func2;
protected $posicion="center";
 public function Panel($panel){
            $Mpanel=' <div id="container3" >

            <div id="default">
			<a class="ui-notify-close ui-notify-cross" href="#">x</a>
			<div style="float:left;margin:0 10px 0 0"><img src="#{icon}" alt="warning" /></div>

			<h1>#{title}</h1>
			<p>#{text}</p>
		</div>


</div>
<div id="movimiento">
<input type="text" id="amount" title="Intervalo de Refresco" value="10 seg" style="border:0; color:#f6931f; background-color:transparent;font-weight:bold;font-size: 18px;" />
<div id="slider"></div><div id="segu"></div>
</div>
        <div id="consultarF"><img src="img/search.png" title="Buscar Recorrido" class="vtip"></img><input type="text" id="datepicker2" title="buscar Recorrido" class="vtip"></div>
<div id="button">
<img src="img/back.png" onclick="document.location=\'index.php\'" title="Volver a Home" class="vtip"></img>
<img src="img/refresh.png" onclick="document.location=\'Mapa.php\'" title="Refrescar" class="vtip"></img>
    
   		


<img src="img/page_process.png" onclick="panel();" title="Opciones del Sitema" class="vtip"></img>
<img src="img/search_page.png" onclick="Busqueda();" title="Buscar una direccion" class="vtip"></img>

<img src="img/unlock.png" onclick="document.location=\'controlador/cerrarsesion.php\'" title="Opciones del Sitema" class="vtip"></img>
<img src="img/user.png"  title="'.$_SESSION["nombre"].'" class="vtip"></img>
    <img src="img/autook.png"  onclick="SelecPatente();" title="Vehiculos" class="vtip"></img>
    <img src="img/rss.png"  onclick="detener();" title="Iniciar/Detener Alertas" class="vtip"></img>
    <img src="img/calendar.png"  onclick="velmaxRepo();cargarPagina(\'reportes/reportDiario.php?patente=\'+vehiculosElegidos+\'&fecha=\'+fechElegida,\'pageContent2\');" title="Ver Registro de Hoy" class="vtip"></img>




        
    </div>';
/*<img src="img/chart.png" onclick="reporte();" title="Ver Reportes" class="vtip"></img>
 *<img src="img/movi/mov (2).png" onclick="cambiartiempo(2);" title="Aumentar Velocidad recorrido" class="vtip"></img><img src="img/movi/mov (3).png" onclick="cambiartiempo(3);" title="Disminuir Tiempo Recorrido." class="vtip"></img>
 * <img src="img/movi/mov.png" onclick="cambiartiempo(0);" title="Reiniciar" class="vtip"></img><img src="img/movi/mov (1).png " onclick="cambiartiempo(1);" title="Detener Recorrido." class="vtip"></img><div id="jQueryUICssSwitch"></div>
             <button class="ui-button ui-state-default ui-corner-all" onclick="crearRuta(true);">Crear Ruta</button>
    <button class="ui-button ui-state-default ui-corner-all" onclick="AlertaH();crearRuta(false);" >Cancelar</button>
    <button class="ui-button ui-state-default ui-corner-all"  onclick="reset();" >Limpiar Pantalla</button>
    <button class="ui-button ui-state-default ui-corner-all"  onclick="plot();" >Ver Panel de Control</button>*/
            return $Mpanel;
    }
 public function SinRegistro($dato,$datoHTML){
     $DialoSinReg=$this->DefauldDialogo('dialogoSinregistro', $dato, $datoHTML.'<br><br><button id="create-user" class="ui-button ui-state-default ui-corner-all" onclick="velmaxRepo();cargarPagina(\'reportes/reportDiario.php?patente=\'+vehiculosElegidos+\'&fecha=\'+fechElegida,\'pageContent2\');$(\'#dialogoSinregistro\').dialog(\'close\');" >Ver Registros por hora de este dia</button>');
     
     $DialoSinReg.=$this->GetJSScript('sinreg','dialogoSinregistro', '150', '150', 'false', $show, $hide, 'false', 'true', $NomBoton1, $NomBoton2, $func1, $func2, $posicion);
     
     return $DialoSinReg;
 }
 Public function PanelBusqueda(){
     $MbusquedaHTML='
         <button class="ui-button ui-state-default ui-corner-all" onclick="tema();" >Cambiar Tema</button>
         	<form action="post.php" method="POST">
		<div class="rowElem"><label>Input Text:</label><input type="text" name="inputtext"/></div>
		<div class="rowElem"><label>Input Password:</label><input type="password" /></div>
		<div class="rowElem"><label>Checkbox: </label><input type="checkbox" name="chbox" id=""></div>
		<div class="rowElem"><label>Radio :</label>
			<input type="radio" id="" name="question" value="oui" checked ><label>oui</label>
			<input type="radio" id="" name="question" value="non" ><label>non</label></div>
		<div class="rowElem"><label>Textarea :</label> <textarea cols="40" rows="12" name="mytext"></textarea></div>

		<div class="rowElem">
			<label>Select :</label>
			<select name="select">
				<option value="">1&nbsp;</option>
				<option value="opt1">2&nbsp;</option>
			</select>
		</div>
		<div class="rowElem">
			<label>Select RedimentionnÃ© :</label>
			<select name="select2" >
				<option value="opt1">Big Option test line with more wordssss</option>
				<option value="opt2">Option 2</option>
				<option value="opt3">Option 3</option>
				<option value="opt4">Option 4</option>
				<option value="opt5">Option 5</option>
				<option value="opt6">Option 6</option>
				<option value="opt7">Option 7</option>
				<option value="opt8">Option 8</option>
			</select>
		</div>

		<div class="rowElem"><label>Submit button:</label><input type="submit" value="Envoyer" /></div>
		<div class="rowElem"><label>Reset button:</label><input type="reset" value="Annuler" /></div>
		<div class="rowElem"><label>Input button:</label><input type="button" value="bouton" /></div>

	</form>

';
     $MBusqueda=$this->DefauldDialogo('busqueda', 'consulta', $MbusquedaHTML);
     $MBusqueda.=$this->GetJSScript('panel', 'busqueda', 400, 350, 'false', '', '', 'true', 'true', 'Buscar_por_Direccion', 'Buscar_Rutas_Optimas', 'Busqueda();', 'initMapDirs();', 'center');
     
     
     $r= ' <div id="busqueda" title="Consulta" style="visibility:hidden">


         <br></br> <input type="button" onclick="Busqueda()" value="Buscar por Direccion"/>
        <br></br><input type="button" onclick="initMapDirs();" value="Buscar Rutas Optimas"/>

</div>';
     
     return $MBusqueda;
 }
public function DefauldDialogo($nombre,$titulo,$datoHTML){
     $return='      <div id="'.$nombre.'" title="'.$titulo.'" style="visibility:hidden">
   '.$datoHTML.'
  	</div>
';
     return $return;
 }
 public function GetJSScript($nombreJS,$nombreDiaglogo,$altura,$ancho,$modal,$show,$hide,$tamañoVariable,$arrastrable,$NomBoton1,$NomBoton2,$func1,$func2,$posicion){
     if ($show==""){$show="puff";}
     if ($hide==""){$show="blind";}
     $JS='<script>';
     $JS.='function '.$nombreJS.' (){
      
      var div=document.getElementById(\''.$nombreDiaglogo.'\');
        div.style.visibility=\'visible\'
        

     	$(function() {
		$("#'.$nombreDiaglogo.'").dialog({
			bgiframe: true,
			height: '.$altura.',
                         width:'.$ancho.',
			modal: '.$modal.',
                        show: \''.$show.'\',
                        hide: \''.$hide.'\',
                        resizable : '.$tamañoVariable.',
                        draggable: '.$arrastrable.' ,
                       position: \''.$posicion.'\',';
                    if ($NomBoton1!=""){$JS.='
                        buttons: {
				'.$NomBoton1.': function() {

                        $(this).dialog(\'close\');
                                        '.$func1.'


					

				}';}if ($NomBoton2!=""){$JS.=',
				'.$NomBoton2.': function() {
                            $(this).dialog(\'close\');

                                        '.$func2.'
					
				}
			},';}else if ($NomBoton1!="") $JS.='},';
                        $JS.='
                        Close: function() {

				$(this).dialog(\'destroy\');}

		});
	});
}';
$JS.="</script>";
     return $JS;
 }
 public function BuscarDir(){
     $BuscDirHTML= '
	<p id="validateTips">Ingrese la Direccion a Buscar</p>

	<fieldset>
		<label for="name">Direccion:</label>
		<input type="text" name="name" id="address" class="text ui-widget-content ui-corner-all" />
		</fieldset>
	</div>';

  $Buscar=$this->DefauldDialogo('BuscarDireccion', 'Ingrese Direccion', $BuscDirHTML);
  $Buscar.=$this->GetJSScript('Busqueda', 'BuscarDireccion', 300, 400, 'false', '', '', 'true', 'true', 'Buscar', $NomBoton2,'BuscarDireccion(document.getElementById("address").value);', $func2,'center');
  return $Buscar;
 }
 public function login($tipo,$msnIngreso){
  $return='<div id="container2">';
     if ($tipo=="1"){
  $return.='
  <div id="topnav" class="topnav">
        '.$msnIngreso.'
   <a href="login" class="signin" id="loggg"><span>Ingresar Sistema</span></a> </div>
    <fieldset id="signin_menu">
    <form name="signin" method="post" id="signin" action="controlador/login.php">
      <label for="username"  >Usuario</label>
      <input id="username" name="username" value=""  tabindex="4" type="text" class="vtip" Title="Ingrese su Nick" >
      </p>
      <p>
        <label for="password">Password</label>
        <input id="password" name="password" value="" title="Ingrese su password" class="vtip" tabindex="5" type="password">
      </p>
      <p class="remember">
        <input id="signin_submit" value="Ingresar" tabindex="6" type="submit">
        
      </p>

    </form>
  </fieldset>';
     }else
     {
  $return.='<div id="topnav" class="topnav"> '.$msnIngreso.' <a href="#" onclick="document.location=\'controlador/cerrarsesion.php\'" class="signin" ><span>Cerrar Session</span></a> </div>';
     }
$return.="</div>";

return $return;

 }

 public function MenuAlertasHora($nombreTabla,$titulo,$datos,$opciones){
     $dato='<table id="'.$nombreTabla.'" class="ui-widget ui-widget-content" aling="center">';
     $dato.='<thead><tr>';
 }

public function GridDinamica($jsNom,$tabla,$menu,$div,$data,$hide,$wr,$ancho,$largo,$load){
   if ($load==""){$load="cagando datos...";
   }else{}
    $re= "function ".$jsNom."(){
        var div=document.getElementById('".$div."');
        div.style.visibility='visible'
	 jQuery().ready(function(){

var ".$jsNom." = jQuery(\"#".$tabla."\").jqGrid({";



        $rr= new Consultas();
        $re.= $rr->Consultar($data,$wr);



   	$re.="rowNum:10,";$re.="loadtext:'".$load."',
        mtype: \"GET\",
        height:'auto',
	autowidth: true,
        
   	rowList:[10,20,30],
        viewsortcols: true ,
   	pager: '#".$menu."',
";if ($hide!=""){$re.="hiddengrid: true ,";}
  $re.="viewrecords: true,

    sortorder: \"asc\",
	gridview : true,
        gridComplete : function() {
 var tm = jQuery(\"#".$tabla."\").jqGrid('getGridParam','totaltime');
$(\"#speed_div\").html(\"Tiempo Carga: \"+ tm+\" ms \"); }";
if ($data=='usuarios'){
    $re.=",onSelectRow: function(ids) {
		if(ids == null) {
			ids=0;
			if(jQuery(\"#UsuarioPC\").jqGrid('getGridParam','records') >0 )
			{
				jQuery(\"#UsuarioPC\").jqGrid('setGridParam',{url:\"Controladores/example.php?q=1&id=\"+ids+\"&dataOP=idComputadores-estado_estado-tipopc_tipopc-procesador-GHZ-ram-tv-unidad-teclado-mause-chipserial-sistema_operativo-programas-marca_marca&table=computadores&wr=idcomputadores=usuarios.Computadores_idComputadores and idcomputadores=\"+ids,page:1});
				jQuery(\"#UsuarioPC\").jqGrid('setCaption',\"Computador usuario: \"+ids)
				.trigger('reloadGrid');
			}
		} else {
			jQuery(\"#UsuarioPC\").jqGrid('setGridParam',{url:\"Controladores/example.php?q=1&id=\"+ids+\"&dataOP=idComputadores-estado_estado-tipopc_tipopc-procesador-GHZ-ram-tv-unidad-teclado-mause-chipserial-sistema_operativo-programas-marca_marca&table=computadores&wr=idcomputadores=usuarios.Computadores_idComputadores and usuarios.usuarios=\"+ids,page:1});
			jQuery(\"#UsuarioPC\").jqGrid('setCaption',\"Computador(es) usuario: \"+ids)
			.trigger('reloadGrid');
                        jQuery(\"#UsuarioMonitor\").jqGrid('setGridParam',{url:\"Controladores/example.php?q=1&id=\"+ids+\"&table=monitor&dataOP=monitor-pulgada-tipo-estado_estado-marca_marca&wr=monitor=usuarios.monitor_monitor and usuarios.usuarios=\"+ids,page:1});
			jQuery(\"#UsuarioMonitor\").jqGrid('setCaption',\"Monitor(es) usuario: \"+ids)
			.trigger('reloadGrid');
                        jQuery(\"#UsuarioImpresora\").jqGrid('setGridParam',{url:\"Controladores/example.php?q=1&id=\"+ids+\"&table=impresora&wr=idimpresora=usuarios.impresora_idimpresora and usuarios.usuarios=\"+ids,page:1});
			jQuery(\"#UsuarioImpresora\").jqGrid('setCaption',\"Impresora (es) usuario: \"+ids)
			.trigger('reloadGrid');
                        jQuery(\"#UsuarioInternet\").jqGrid('setGridParam',{url:\"Controladores/example.php?q=1&id=\"+ids+\"&table=internet&wr=idinternet=usuarios.internet_idinternet and usuarios.usuarios=\"+ids,page:1});
			jQuery(\"#UsuarioInternet\").jqGrid('setCaption',\"Internet (es) usuario: \"+ids)
			.trigger('reloadGrid');
		}
	}


";
}


$re.="});
    var addprm = {
    width: 450,
    height: 800,
    top: 125,

    left: 50,
    exportURL: 'controladores/export_php/testList.php?export=true',
    reloadAfterSubmit:true,
    closeAfterAdd:true  };

jQuery(\"#".$tabla."\").jqGrid('navGrid','#".$menu."',{
";
if($_SESSION["tipo"]>=10){$re.="view:true,
search:true,
refresh:true,searchtext:\"Buscar_Filtrar\"
";}else{$re.="view:false,
search:true,
refresh:true,add:true,del:true,searchtext:\"Buscar\"
";}


$re.="}

);

jQuery(\"#".$tabla."\").jqGrid('navButtonAdd',\"#".$menu."\",{caption:\"Columnas\",title:\"Agregar/Quitar\",buttonicon :'',
	onClickButton:function(){

             jQuery(\"#".$tabla."\").jqGrid('columnChooser');

    }  });
jQuery(\"#".$tabla."\").jqGrid('navButtonAdd',\"#".$menu."\",{caption:\"Edit\",title:\"Agregar/Quitar\",buttonicon :'',
	onClickButton:function(){
        var id = jQuery(\"#".$tabla."\").jqGrid('getGridParam','selrow');
         if (id) {
         
         jQuery(\"#".$tabla."\").jqGrid('editRow',id);
      }
      else
      { alert(\"Seleccione una Fila\");}
             

    }  });

";


$re.="  jQuery(\"#".$tabla."\").jqGrid('navButtonAdd',\"#".$menu."\",{caption:\"Add\",title:\"Agregar/Quitar\",buttonicon :'',
	onClickButton:function(){

             ".$data."jsadd"."();

    }  });


jQuery(\"#".$tabla."\").jqGrid('sortableRows');
jQuery(\"#".$tabla."\").jqGrid('gridResize',{minWidth:300,maxWidth:1000,minHeight:80, maxHeight:1000});
";
if ($tabla=='geocodes'){
    $re.="
        

jQuery(\"#".$tabla."\").jqGrid('navButtonAdd',\"#".$menu."\",{caption:\"Ver_Mapa\",title:\"Ver seleccionados en Mapa\",
	onClickButton:function(){
	var id = jQuery(\"#".$tabla."\").jqGrid('getGridParam','selrow');
      if (id) {
      var ret = jQuery(\"#".$tabla."\").jqGrid('getRowData',id);
      lat=ret.Latitud;
      lon=ret.Longitud;
      dir=ret.Direccion;
      mapa();
      }
      else
      { alert(\"Seleccione una Fila\");}

    }  });
jQuery(\"#".$tabla."\").jqGrid('navButtonAdd',\"#".$menu."\",{caption:\"Cerrar_MiniMapa\",title:\"Cerrar MiniMapa\",buttonicon :'',
	onClickButton:function(){
	var id = jQuery(\"#".$tabla."\").jqGrid('getGridParam','selrow');
      if (id) {
     
      cerrarmapa();
      }
      else
      { cerrarmapa();}

    }  });
    

";
}

$re.="});


}";/*
 * jQuery(\"#".$tabla."\").jqGrid('navButtonAdd',\"#".$menu."\",{caption:\"Toggle\",title:\"Toggle Search Toolbar\", buttonicon :'ui-icon-pin-s',
	onClickButton:function(){
		jQuery(\"#".$tabla."\").jqGrid('setGridParam',{width:\"100%\"}).trigger(\"reloadGrid\");
                jQuery(\"#".$tabla."\").jqGrid('setGridParam',{height:\"100%\"}).trigger(\"reloadGrid\");
	}
});

 */
return $re;
}
function CrearBoton($idBoton,$titulo,$js){
    $r='<input value="'.$titulo.'" type="submit" onclick="'.$js.'" id="'.$idBoton.'">';
return $r;
}
public function Combo2($div,$data,$width,$height){
    $r=' $(\'#'.$div.'\').combobox({
               listWidth:'.$width.',
            listHeight:'.$height.',

            list: [
                  ';
                   $r.=$data;
                    $r.=']
                , changed: function(e, ui) {

                }
        });
        function jQueryUICss_Changed(ddl, i) {

        }';
       return $r;
}

function MenuNew($id,$title,$opciones,$js){
    $ret=' <a tabindex="0" href="#search-engines" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="'.$id.'"><span class="ui-icon ui-icon-triangle-1-s"></span>'.$title.'</a>
<div id="search-engines" class="hidden">
<ul>';
    $d=explode("-", $opciones);
    $js=explode("-", $js);
$dd="";
         for ($r=0;$r<sizeof($d);$r++){
             $dd.='<li><a href="#" onclick="'.$js[$r].'">'.$d[$r].'</a> </li>';
             
         }

$ret.=$dd;
$ret.='</ul>
</div>';
    return $ret;
}

}



?>
