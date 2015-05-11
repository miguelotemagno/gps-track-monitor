<?php ob_start();
session_start();

require('controlador/ConfiguracionApp.php');
class Consultas{
protected $pager=array ();
protected $headings=array ();
protected $rows=array ();
protected $editar=",editable:true,";
public function Ejec(){

}
public function Consultar($tabla,$wr){
    $config= new ConfiguracionApp();
    $datanormal=$config->getNormal($tabla);
    $datanormal=str_replace('-',',',$datanormal);
    
    $dataFull=$config->getFull($tabla);
    
    $dataFull=str_replace('all','*',$dataFull);
    $relacion=$config->getRelacion($tabla);
    $opciones=$config->getOpciones($tabla);
    $tab=$config->getTablas($tabla);
    $tab=str_replace('-',',',$tab);
    if ($_SESSION["tipo"]>=10){$sql="select ".$dataFull." from ".$tab." where 1 ".$opciones;//$sql="SELECT ".$dataFull." FROM ".$tabla." ".$tab." where ".$opciones;
    }else
        {$sql="SELECT ".$datanormal." FROM  ".$tab." where 1 ".$opciones;}
     //echo $sql;
    
    //$sql="select * from ".$tabla;
   //echo $sql;
     $r="
	datatype: \"xml\",
        caption:\"Consultas en: ".$tabla."\" , colNames:["
		;



     $resultado=mysql_query($sql);
          for ($x=0;$x<@mysql_num_fields($resultado);$x++){
                                    if ($x<1){if ($wr!=''){}}
                                    $r.="'".@mysql_field_name($resultado, $x)."'";
                                    if ($x+1<@mysql_num_fields($resultado)){
                                        $r.=",";
                                    }
        }
	$r.="],";
        $d="?wr=".$wrd."&table=".$tabla."&dataOP=";
        $t=" colModel:[";
        $id;
for ($x=0;$x<@mysql_num_fields($resultado);$x++){
if ($x==0){
    $id=@mysql_field_name($resultado, $x);
}     $ruler="";
      $regla=explode(" ",@mysql_field_type($resultado, $x));
        if ($regla[0]=='int'){
            $ruler=",editrules:{number:true},sorttype:'number',formatter:'number'";
            if (@mysql_field_len($resultado, $x)==4){
                    $ruler=",edittype:\"select\",editoptions:{value:";
                    $ruler.="\"";
                    $nomdb=explode("_",@mysql_field_name($resultado, $x));
                    $opse=$config->getSelect($nomdb[0]);
                    $optionSel=$config->getOpSelect($nomdb[0]);
                    $opse=str_replace('-',',',$opse);
                    
                    $sql2="select ".$opse." from ".$nomdb[0]." where 1 ".$optionSel;
                    //echo $sql2;
                    $resultado2=mysql_query($sql2);
                    $selecc="";
                    while ($row2 = @mysql_fetch_row($resultado2)) {
                        $datoSelect="";
                        $selecc.=$row2[0].":".$row2[0];
                        for ($x2=1;$x2<@mysql_num_fields($resultado2);$x2++){
                         $datoSelect.=@mysql_field_name($resultado2, $x2)." ".$row2[$x2]."-";
                        }
                        $selecc.=$datoSelect.";";
                        
                    }
                    $ruler.=$selecc."\"}";
                    
            }
         }
         if ($regla[0]=='string'){
             $ruler="";
         }
           if (@mysql_field_name($resultado, $x)=="Patente"){
             $ruler=",editrules:{number:true}";
             $ruler=",edittype:\"select\",editoptions:{value:";
             $ruler.="\"";
              $sql2="select patente from userAutos";
                    //echo $sql2;
                    $resultado2=mysql_query($sql2);
                    $selecc="";
                    while ($row2 = @mysql_fetch_row($resultado2)) {
                        $selecc.=$row2[0].":".$row2[0];
                         for ($x2=1;$x2<@mysql_num_fields($resultado2);$x2++){
                         $datoSelect.=@mysql_field_name($resultado2, $x2)." ".$row2[$x2]."-";
                        }
                        $selecc.=$datoSelect.";";

                     }
                     $ruler.=$selecc."\"}";
         }
           if (@mysql_field_name($resultado, $x)=="Direccion")
        {$ruler=',hidde:true';
         }
         if (@mysql_field_name($resultado, $x)=="fecha")
        {$ruler=',editoptions:{size:12, dataInit:function(el){ $(el).datepicker({dateFormat:\'yy-mm-dd\'}); }, defaultValue: function(){ var currentTime = new Date(); var month = parseInt(currentTime.getMonth() + 1); month = month <= 9 ? "0"+month : month; var day = currentTime.getDate(); day = day <= 9 ? "0"+day : day; var year = currentTime.getFullYear(); return year+"-"+month + "-"+day; } }, formoptions:{ }, editrules:{required:true}  ';
         }
          if (@mysql_field_name($resultado, $x)=="FECHA")
        {$ruler=',editoptions:{size:12, dataInit:function(el){ $(el).datepicker({dateFormat:\'yy-mm-dd\'}); }, defaultValue: function(){ var currentTime = new Date(); var month = parseInt(currentTime.getMonth() + 1); month = month <= 9 ? "0"+month : month; var day = currentTime.getDate(); day = day <= 9 ? "0"+day : day; var year = currentTime.getFullYear(); return year+"-"+month + "-"+day; } }, formoptions:{ }, editrules:{required:true}  ';
         }
            if (@mysql_field_name($resultado, $x)=="Hora_inicio")
        {$ruler=',editoptions:{size:12, dataInit:function(el){ $(el).ptTimeSelect({ containerClass: "timeCntr", containerWidth: "350px", setButtonLabel: "Select", minutesLabel: "min", hoursLabel: "Hrs"});  }} ';
         }
     if ($x>0) {
     $t.="{name:'".@mysql_field_name($resultado, $x)."' ,index: '".@mysql_field_name($resultado, $x)."'".$this->editar."width :60 ".$ruler." }";}
     else
     { if ($tabla!="userautos"){    $t.="{name:'".@mysql_field_name($resultado, $x)."' ,index: '".@mysql_field_name($resultado, $x)."',width :60 ".$ruler." }";}
     
    else{ $t.="{name:'".@mysql_field_name($resultado, $x)."' ,index: '".@mysql_field_name($resultado, $x)."'".$this->editar."width :60 ".$ruler." }";}
     }
     $d.=@mysql_field_name($resultado, $x);
       if ($x+1<@mysql_num_fields($resultado)){
                                        $d.="-";
                                        $t.=",";
                                    }
     
}
$t.="],sortname: '".$id."',";
$url="url:'controlador/example.php".$d."',editurl: 'controlador/server.php".$d."',";
return $url." ".$r." ".$t;
     
     
}
}




?>