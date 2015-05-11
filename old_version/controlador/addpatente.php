<?php  ob_start();
session_start();
require_once('mysql.php');
class PatenteV{
    public function getpatentes(){
  


        $sql="select * from userautos where coduser=".$_SESSION["cod"];


        $result = mysql_query($sql);
        
        $i=1;
        $r.= '<select name="example5" id="example5" class="multiselect"  size="5" title="Click to select an option">
';
        while ($row = @mysql_fetch_assoc($result))
            {


                    $r.= "<option value=".$row['patente'].">".$row['patente']."</option>";

                    $i++;
            }
            $r.= '</select>';

    return $r;
    }
}
?>
