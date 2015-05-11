<?php
//require('mysql.php');
/* Write the data here. */

$ipp= $_GET['ipp'];
$pass= $_GET['pass'];
$ipsql= $_GET['ipsql'];
$nom= $_GET['nom'];
$archivo = "conf.php";
$id = fopen($archivo, 'w');
fwrite($id, "<?php \n");
fwrite($id, "\$ipp='".$ipp."';\n");
fwrite($id, "\$pass='".$pass."';\n");
fwrite($id, "\$ipsql='".$ipsql."';\n");
fwrite($id, "\$user='".$nom."';\n");
fwrite($id, "\$ini=false;\n");
fwrite($id, "?> \n");
fclose($id);

echo "Datos Guardados Exitosamente!!!";
require('../vista/ops.php');


//by Gabriel Muñoz
?>

