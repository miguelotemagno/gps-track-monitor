<?php
require('mysql.php');
class ConfiguracionApp {
    public function GetDat() {
     $sql = "select * from configuracion";
     $rs = mysql_query($sql);

    return $rs;

    }
  public  function getNormal($tabla) {
        $sql = "select camposNormal from configuracion where NombreTabla='".$tabla."'";
        $normal;
        $rs = mysql_query($sql);
        while ($row = @mysql_fetch_row($rs)) {
            $normal.=$row[0];
           }
            return $normal;
}
public function getFull($tabla){
$sql = "select CamposFull from configuracion where NombreTabla='".$tabla."'";
$full;
$rs = mysql_query($sql);
while ($row = @mysql_fetch_row($rs)) {
    $full.=$row[0];
   }
return $full;
}
public function getRelacion($tabla){
$sql = "select Relacion from configuracion where NombreTabla='".$tabla."'";
$rel;
$rs = mysql_query($sql);
while ($row = @mysql_fetch_row($rs)) {
    $rel.=$row[0];
   }
return $rel;
}
public function getOpciones($tabla){
$sql = "select opciones from configuracion where NombreTabla='".$tabla."'";
$rel;
$rs = mysql_query($sql);
while ($row = @mysql_fetch_row($rs)) {
    $rel.=$row[0];
   }
return $rel;
}
public function getTablas($tabla){
$sql = "select tablas from configuracion where NombreTabla='".$tabla."'";
$rel;
$rs = mysql_query($sql);
while ($row = @mysql_fetch_row($rs)) {
    $rel.=$row[0];
   }
return $rel;
}
public function getSelect($tabla){
$sql = "select opselect from configuracion where NombreTabla='".$tabla."'";
$rel;
$rs = mysql_query($sql);
while ($row = @mysql_fetch_row($rs)) {
    $rel.=$row[0];
   }
return $rel;
}
public function setConfig($user,$tabla,$normal,$full,$relacion,$opcion,$tablas,$opsel,$OptionSelect){
        $sql="select max(idConfiguracion) from configuracion";
        $rs = mysql_query($sql);
        $id=0;
        while ($row = @mysql_fetch_row($rs)) {
            $id=$row[0]+1;
           }
        $sql="insert into configuracion values(".$id.",'".$tabla."','".$normal."','".$full."','".$relacion."','".$opcion."','".$tablas."','".$opsel."','".$OptionSelect."')";
        mysql_query($sql) or die($sql."Couldn t execute query.".mysql_error());
}
public function delConfig($user,$id){
    $sql="delete from configuracion where idConfiguracion=".$id;
    mysql_query($sql) or die($sql."Couldn t execute query.".mysql_error());
}
public function getOpSelect($tabla){
    $sql = "select OptionSelect from configuracion where NombreTabla='".$tabla."'";
        $normal;
        $rs = mysql_query($sql);
        while ($row = @mysql_fetch_row($rs)) {
            $normal.=$row[0];
           }
            return $normal;
}
public function updateCong($user,$tabla,$normal,$full,$relacion,$opcion,$tablas,$opsel,$OptionSelect){
    $sql="update configuracion set nombretabla='".$tabla."',camposNormal='".$normal."',CamposFull='".$full."',relacion='".$relacion."',opciones='".$opcion."',tablas='".$tablas."',opselect='".$opsel."',OptionSelect='".$OptionSelect."' where NombreTabla='".$tabla."'";
    mysql_query($sql) or die($sql."Couldn t execute query.".mysql_error());
}

}
?>
