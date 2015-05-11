<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Geocodes
 *
 * @author Administrador
 */
class Geocodes {
    Public function GetData($user,$campos,$tablas,$wr,$opciones,$index,$desde,$hasta,$orden){
        $SQL="SELECT ".$campos." FROM  ".$tablas." where ".$wr." ".$opciones." ORDER BY $index $orden LIMIT $desde , $hasta";
            $result = mysql_query( $SQL ) or die($SQL."Couldn t execute query.".mysql_error());

       return $result;
     }
     public function GetCantidadPorPatente($id,$ve,$fechaF,$fechaI,$h1,$h2){
         $arr=Array();$idx=0;
         $SQL="Select patente,count(*) FROM geocodes,userautos where address=cod_id and geocodes.fecha>='".$fechaI."' and geocodes.fecha<='".$fechaF."' and geocodes.hora>='".$h1."' and geocodes.hora<='".$h2."'  and coduser=".$id." ";
         $e=explode(" /", $ve);//$SQL.=" and (";
         for ($r=0;$r<sizeof($e)-1;$r++){
             $SQL.=" patente='".trim($e[$r])."'";
             if ($r+1<sizeof($e)-1){$SQL.=" or ";}
         }
         
         $SQL.=" group by patente  order by count(*) desc";
         //echo $SQL;
          $result = mysql_query( $SQL ) or die($SQL."Couldn t execute query.".mysql_error());
          while ($row=@mysql_fetch_row($result)){
             $arr[$idx] = array(
                    
                    'patente'    => $row[0],
                    'cantidad'    => $row[1]

                 );
             $idx++;
          }
          return $arr;

     }
     public function GetDatosGPS($patente,$fechaI,$fechaF,$horaI,$horaF,$id,$star,$limit){
         $arr=Array();$idx=0;
         $SQL="SELECT * FROM geocodes,userautos where address=cod_id and geocodes.fecha>='".$fechaF."' and geocodes.fecha<='".$fechaI."'  and geocodes.hora>='".$horaI."' and geocodes.hora<='".$horaF."' and patente='".$patente."' and coduser=".$id." order by address,geocodes.fecha,geocodes.hora LIMIT ".$star.",".$limit;
         $result = mysql_query( $SQL ) or die($SQL."Couldn t execute query.".mysql_error());
         //echo $SQL;
          while ($row=@mysql_fetch_assoc($result)){
             $arr[$idx] = array(

                    'patente'    => $row['patente'],
                    'lat'    => $row['lat'],
                    'lon'    => $row['lon'],
                    'id'         => $row['address'],
                    'hora'       => $row['hora'],
                    'MODELO'     => $row['MODELO'],
                    'MARCA'      => $row['MARCA'],
                    'fecha'      => $row['fecha'],
                    'otro1'  => $row['otro1']
                 );
             $idx++;
          }
          return $arr;
     }
     function getPorDia($id,$patente,$fecha){
             $arr=Array();$idx=0;
         $SQL="SELECT patente,geocodes.fecha as FechaC,hour(hora) as horas,count(*) as Cantidad FROM geocodes,userautos where address=cod_id and patente='".$patente."' and geocodes.fecha='".$fecha."'  group by address,geocodes.fecha,hour(hora)";
         $result = mysql_query( $SQL ) or die($SQL."Couldn t execute query.".mysql_error());
         //echo $SQL;
          while ($row=@mysql_fetch_assoc($result)){
             $arr[$idx] = array(

                    'address'    => $row['patente'],
                    'fecha'    => $row['FechaC'],
                    'hora'    => $row['horas'],
                    'cantidad'         => $row['Cantidad']
                 );
             $idx++;
          }
          return $arr;

     }

}


?>
