<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehiculos
 *
 * @author Administrador
 */
class Vehiculos {
    public function Getvehiculos($user,$campos,$tablas,$wr,$opciones,$index,$desde,$hasta,$orden){
      $SQL="SELECT ".$campos." FROM  ".$tablas." where ".$wr." ".$opciones." ORDER BY $index $orden LIMIT $desde , $hasta";
            $result = mysql_query( $SQL ) or die($SQL."Couldn t execute query.".mysql_error());

       return $result;

    }
    public function SetVehiculo($usuario,$id,$patente,$marca,$modelo,$descr,$fecha){

        $sql="insert into userautos values('".$id."','".$patente."','".$marca."','".$modelo."','".$descr."','".$fecha."','".$userario."')";
        mysql_query( $sql ) or die($sql."Couldn t execute query.".mysql_error());
        return true;
    }
    public function DelVehiculo($usuario,$id){
        $sql="delete from userautos where cod_id='".$id."' and coduser='".$usuario."'";
        mysql_query( $sql ) or die($sql."Couldn t execute query.".mysql_error());
    }
    public function editVehiculo($usuario,$id,$patente,$marca,$modelo,$descr,$fecha,$lm){
        $sql="update userautos set patente='".$patente."',MARCA='".$marca."',MODELO='".$modelo."',DESCR='".$descr."',LxKM='".$lm."',FECHA='".$fecha."' where cod_id='".$id."'";
        mysql_query( $sql ) or die($sql."Couldn t execute query.".mysql_error());
        return true;
    }
}
?>
