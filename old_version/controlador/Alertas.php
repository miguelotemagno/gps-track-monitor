<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Alertas
 *
 * @author Administrador
 */

class Alertas {
    public function verificarAlerta($patente,$fecha,$hora){
        $sql="select * from alert_hora,userautos,alertas where alert_hora.idAlerH=alertas.cod_tip and alertas.Tipo_Alerta=0 and userautos.cod_id=alertas.userautos_patente and userautos.patente='".$patente."' and Hora_inicio<='".$hora."' and Hora_termino>='".$hora."'" ;
         $result = mysql_query( $sql ) or die($sql."Couldn t execute query.".mysql_error());
         $op="";
         //echo $sql;
            while ($row = @mysql_fetch_row($result)){
             $op=$row[0];
            }
         return $op;

    }
    public function GetAlertasVel($user,$campos,$tablas,$wr,$opciones,$index,$desde,$hasta,$orden){
        $SQL="SELECT ".$campos." FROM  ".$tablas." where ".$wr." ".$opciones." ORDER BY $index $orden LIMIT $desde , $hasta";
            $result = mysql_query( $SQL ) or die($SQL."Couldn t execute query.".mysql_error());
            
       return $result;
    }
    public function GetAlertasHora($user,$campos,$tablas,$wr,$opciones,$index,$desde,$hasta,$orden){
      $SQL="SELECT ".$campos." FROM  ".$tablas." where ".$wr." ".$opciones." ORDER BY $index $orden LIMIT $desde , $hasta";
            $result = mysql_query( $SQL ) or die($SQL."Couldn t execute query.".mysql_error());

       return $result;
    }
    public function SetAlertaHora($user,$patente,$horaInicio,$horaTermino){
            $idalerta=0;
            $idalertaH=0;
            $idalertaT=0;
            $sql="select max(idalerta) from alertas";
            $result = mysql_query($sql);
            while ($row = @mysql_fetch_row($result)){
            $idalerta=$row[0]+1;
            }
            echo $sql;
            echo mysql_affected_rows();
            if ($idalerta<1){
                $idalerta=1;
            }
            $codpa;
            $sql="select cod_id from userAutos where patente='".$patente."'";
            $result = mysql_query($sql);
            while ($row = @mysql_fetch_row($result)){
            $codpa=$row[0];
            }
            $sql="select max(IdAlerH) from alert_hora";
            $result = mysql_query($sql);
            while ($row = @mysql_fetch_row($result)){
            $idalertaH=$row[0]+1;
            }
            //echo $sql;
            echo mysql_affected_rows();
            if ($idalertaH<1){
                $idalertaH=1;
            }

            $sql="insert into alertas values(".$idalerta.",'".$codpa."','0','".$user."',".$idalertaH.")";
            mysql_query($sql);
            echo $sql;
            $sql="insert into alert_hora values(".$idalertaH.",'".$horaInicio."','".$horaTermino."')";
            mysql_query($sql);
            return true;
    }
    public function serAlertaVel($user,$patente,$vel){
             
            $idalerta=0;
            $idalertaH=0;
            $idalertaT=0;
            $sql="select max(idalerta) from alertas";
            $result = mysql_query($sql);
            while ($row = @mysql_fetch_row($result)){
            $idalerta=$row[0]+1;
            }
            echo $sql;
            echo mysql_affected_rows();
            if ($idalerta<1){
                $idalerta=1;
            }
            $sql="select max(IdAlerV) from alert_vel";
            $result = mysql_query($sql);
            while ($row = @mysql_fetch_row($result)){
            $idalertaH=$row[0]+1;
            }
            echo $sql;
            echo mysql_affected_rows();
            if ($idalertaH<1){
                $idalertaH=1;
            }
            $codpa;
            $sql="select cod_id from userautos where patente='".$patente."'";
            $result = mysql_query($sql);
            while ($row = @mysql_fetch_row($result)){
            $codpa=$row[0];
            }
            $sql="insert into alertas values(".$idalerta.",'".$codpa."','1','".$user."',".$idalertaH.")";
            mysql_query($sql);
            echo $sql;

            $sql="insert into alert_vel values(".$idalertaH.",'".$vel."')";
            mysql_query($sql);
            return true;
    }
    public function delAlertasHora($user,$id){
        $sql="delete from alertas where Tipo_Alerta=0 and cod_tip=".$id;
        mysql_query($sql);
        $sql="delete from alert_hora where idAlerH=".$id;
        mysql_query($sql);
        return true;
    }
    public function delAlertasVel($user,$id){
        $sql="delete from alertas where Tipo_Alerta=1 and cod_tip=".$id;
        mysql_query($sql);
        $sql="delete from alert_vel where idAlerV=".$id;
        mysql_query($sql)  or die($sql."Couldn t execute query.".mysql_error());
        return true;
    }
    Public function UpdateAlertaHora($user,$idalertaH,$patente,$horaInicio,$horaTermino){
            
            $sql="update  alert_hora set Hora_inicio='".$horaInicio."',Hora_termino='".$horaTermino."' where idalerH=".$idalertaH;
            mysql_query($sql);
            return true;
    }
     Public function UpdateAlertaVel($user,$idalertaV,$vel){

            $sql="update  alert_vel set VelMax=".$vel." where idAlerV=".$idalertaV;
            echo $sql;
            mysql_query($sql)  or die($sql."Couldn t execute query.".mysql_error());;;
            return true;
    }
    
}
?>
