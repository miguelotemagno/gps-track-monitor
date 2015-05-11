<?php


class AddControlador {
   public function getData($table){
       $r='<form method="post" name="order" id="order" action="" title="" style="width:350px;margin:0px;">  <fieldset>  <legend>Invoice Data</legend>
<table class="ui-widget ui-widget-content">
<tbody>';

       $sql="select * from ".$table;


        $result = mysql_query($sql);
         while ($row = @mysql_fetch_assoc($result))
            {for ($x=0;$x<@mysql_num_fields($result);$x++){
             $r.='<tr class="ui-widget-header "><td> '.@mysql_field_name($result, $x).':</td><td><input type="text" name="'.@mysql_field_name($result, $x).'" class="text ui-widget-content ui-corner-all" id="'.@mysql_field_name($result, $x).'"/></td>
            </tr>';}
            }
$r.='


</tbody>
</table>



</fieldset> </form> <button id="create-user" class="ui-button ui-state-default ui-corner-all"  onclick="jQuery(\'#'.$table.'\').jqGrid().trigger(\'reloadGrid\');">Grabar</button>';
       return $r;
   }
}
?>
