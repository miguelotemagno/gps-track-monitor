<?php ob_start();
session_start();
if (isset($_SESSION["nombre"])){
require_once('mysql.php');
$dialog=$_GET['dialogo'];
$op=$_GET['op'];
$op2=$_GET['op2'];
if ($op=="crearH"){
//           <p><a href="#" id="dialog_link" class="ui-state-default ui-corner-all" onclick="cargarPagina(\'controlador/nada.php\',\'verificar\');"><span class="ui-icon ui-icon-circle-check"></span>OK</a></p>
  //          <p><a href="#" id="dialog_link" class="ui-state-default ui-corner-all" onclick="cargarPagina(\'controlador/nada.php\',\'verificar\');"><span class="ui-icon ui-icon-circle-close"></span>Cancelar/Cerrar</a></p>
$sql="";
switch ($op2){
case 0:$sql="select alertas.patente,alert_hora.hora_inicio, alert_hora.hora_termino from alertas, alert_hora where alertas.cod_tip=alert_hora.idAlerH and tipo_alerta=0 and alertas.iduser=".$_SESSION["cod"];
$boton1='<input type="button" value="Nueva Alerta" name="nuevo" onclick="cargarPagina(\'controlador/verificar.php?dialogo=hola&op=hora\',\'verificar\');" /> ';
$boton2='<input type="button" value="Editar" name="nuevo" onclick="cargarPagina(\'controlador/verificar.php?dialogo=hola&op=hora\',\'verificar\');"/><input type="button" value="eliminar" name="nuevo" onclick="cargarPagina(\'controlador/verificar.php?dialogo=hola&op=hora\',\'verificar\');"/>';
$table="usersH";
break;
case 1:$sql="select alertas.patente,alert_vel.velmax as velocidad_Maxima from alertas, alert_vel where alertas.cod_tip=alert_vel.idalerv and alertas.tipo_alerta=1 and alertas.iduser=".$_SESSION["cod"];
$boton1='<a href="#" id="dialog_link2" class="ui-state-default ui-corner-all" title="Crear Nuevo" onclick="cargarPagina(\'controlador/verificar.php?dialogo=hola&op=vel\',\'verificar\');"><span class="ui-icon ui-icon-plusthick"></span></a>';
$boton2='<a href="#" id="dialog_link2" class="ui-state-default ui-corner-all" title="Editar"><span class="ui-icon ui-icon-pencil" onclick="cargarPagina(\'controlador/verificar.php?dialogo=hola&op=vel\',\'verificar\');"></span></a>';
$table="usersV";
break;
default: break;
}

$result = mysql_query($sql);
//echo" <textarea name=\"pa\" id=\"pa\" cols=\"8\" rows=\"5\">";
$i=1;
echo '
<div id="users-contain" class="ui-widget">

		
             
             ';$r=1;
 echo $boton1.'<form id="form1" />
<table id="'.$table.'" class="ui-widget ui-widget-content" aling="center">';

		while ($row = @mysql_fetch_row($result)){
                    if ($r==1){
			echo'<thead><tr>
				
			<tr class="ui-widget-header ">';
                        echo	'<th></th>';
                        for ($x=0;$x<mysql_num_fields($result);$x++){
			echo	'<th>'.mysql_field_name($result, $x).'</th>';}


			echo '</tr>
		</thead>';}$r++;echo'
		<tbody>';
                                
    
        //echo "<input type=\"radio\" name=\"radio".$i."id=\"patentess\"".$i." value=\"".$row['patente']." />".$row['patente']."\n";
 echo '<td>'.$boton2.'</td>';
  for ($x=0;$x<mysql_num_fields($result);$x++){
            echo "<td>".$row[$x]."</td>";}
            

            $i++;echo 	'</tr>';
    }
    echo'		
		</tbody>
	</table></form>';


    echo '</div>
			
';
}else if ($op=="hora"){

$sql="select * from user_autos where coduser=".$_SESSION["cod"];


$result = mysql_query($sql);
//echo" <textarea name=\"pa\" id=\"pa\" cols=\"8\" rows=\"5\">";
$i=1;
echo'<div class="ui-overlay"><div class="ui-widget-overlay"></div><div class="ui-widget-shadow ui-corner-all" style="width: 302px; height: 182px; position: absolute; left: 450px; top: 130px;"></div></div>
			<div style="position: absolute; width: 280px; height: 160px;left: 450px; top: 130px; padding: 10px;" class="ui-widget ui-widget-content ui-corner-all">
				<div class="ui-dialog-content ui-widget-content" style="background: none; border: 0;">';

    echo'
<form name="formAlertas" onSubmit="cargarPagina(\'controlador/GrabarAlertas.php?OP=H&patente=\'+document.formAlertas.example1.value+\'&Horai=\'+document.formAlertas.HoraI.value+\'&HoraF=\'+document.formAlertas.HoraF.value,\'grabar\');return false;">
  <table id="alertas">

    <!-- Beginning of generated code by <?php echo $form ?>
 -->
    <tr>
      <th><label for="name">Patente</label></th>
      <td>';
    echo "<select id=\"selPatente\" name=\"example1\" class=\"multiselect\" title=\"Click to select an option\">";
while ($row = @mysql_fetch_assoc($result))
    {
        //echo "<input type=\"radio\" name=\"radio".$i."id=\"patentess\"".$i." value=\"".$row['patente']." />".$row['patente']."\n";

            echo "<option value=".$row['patente'].">".$row['patente']."</option>";

            $i++;
    }
    echo '</select>';echo'</td>
    </tr>
    <tr>
      <th><label for="email">Hora Inicio</label></th>
      <td><input type="text" name="HoraI" id="HoraI" /></td>
    </tr>
    <tr>
      <th><label for="message">Hora Final</label></th>
      <td><input type="text" name="HoraF" id="HoraF" /></td>
    </tr>
    <!-- End of generated code by <?php echo $form ?>
 -->

    <tr>
      <td colspan="2">
        <input type="submit" value="Grabar"/>
        <input type="button" value="Cancelar" onclick="cargarPagina(\'controlador/nada.php\',\'verificar\');"/>
        
      </td>
    </tr>
  </table>
</form>
<div id="grabar"></div>
				</div>
			</div>';
}else if ($op=="vel"){
$sql="select * from user_autos where coduser=".$_SESSION["cod"];


$result = mysql_query($sql);
//echo" <textarea name=\"pa\" id=\"pa\" cols=\"8\" rows=\"5\">";
$i=1;
echo'<div class="ui-overlay"><div class="ui-widget-overlay"></div><div class="ui-widget-shadow ui-corner-all" style="width: 302px; height: 182px; position: absolute; left: 250px; top: 30px;"></div></div>
			<div style="position: absolute; width: 280px; height: 160px;left: 250px; top: 30px; padding: 10px;" class="ui-widget ui-widget-content ui-corner-all">
				<div class="ui-dialog-content ui-widget-content" style="background: none; border: 0;">';

    echo'
<form name="formAlertas" onSubmit="cargarPagina(\'controlador/GrabarAlertas.php?OP=v&patente=\'+document.formAlertas.example1.value+\'&vel=\'+document.formAlertas.vel.value,\'grabar\');return false;">
  <table>

    <!-- Beginning of generated code by <?php echo $form ?>
 -->
    <tr>
      <th><label for="name">Patente</label></th>
      <td>';
    echo "<select name=\"example1\" class=\"multiselect\" title=\"Click to select an option\">";
while ($row = @mysql_fetch_assoc($result))
    {
        //echo "<input type=\"radio\" name=\"radio".$i."id=\"patentess\"".$i." value=\"".$row['patente']." />".$row['patente']."\n";

            echo "<option value=".$row['patente'].">".$row['patente']."</option>";

            $i++;
    }
    echo '</select>';echo'</td>
    </tr>
    <tr>
      <th><label for="email">Velocidad Maxima (KM)</label></th>
      <td><input type="text" name="vel" id="vel" /></td>
    </tr>
    
    <tr>
      <td colspan="2">
        <input type="submit" value="Grabar"/>
        <input type="button" value="Cancelar" onclick="cargarPagina(\'controlador/nada.php\',\'verificar\');"/>

      </td>
    </tr>
  </table>
</form>
<div id="grabar"></div>
				</div>
			</div>';
}
}
else
    { 
    echo '<img src="img/blank.gif" onload="login();"/>';
    }
?>