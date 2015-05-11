<?php
$archivo = "tem.php";
$id = fopen($archivo, 'w');
fwrite($id, "<?php \n");
fwrite($id, "\$tablas='".$tabla."';\n");
fwrite($id, "\$campos='".$campos."';\n");
fwrite($id, "?> \n");
fclose($id);;
?>
