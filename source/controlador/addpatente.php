<?php  ob_start();
session_start();
  require_once('mysql.php');


$sql="select * from user_autos where coduser=".$_SESSION["cod"];


$result = mysql_query($sql);
//echo" <textarea name=\"pa\" id=\"pa\" cols=\"8\" rows=\"5\">";
$i=1;
echo "<select name=\"example1\" class=\"multiselect\" multiple=\"multiple\" size=\"5\" title=\"Click to select an option\">";
while ($row = @mysql_fetch_assoc($result))
    {
        //echo "<input type=\"radio\" name=\"radio".$i."id=\"patentess\"".$i." value=\"".$row['patente']." />".$row['patente']."\n";

            echo "<option value=".$row['patente'].">".$row['patente']."</option>";

            $i++;
    }
    echo "</select>";
//echo "</textarea>";
?>
