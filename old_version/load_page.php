<?php

if(!$_POST['page']) die("0");

$page = $_POST['page'];

if(file_exists('controlador/'.$page.'.php'))
echo file_get_contents('controlador/'.$page.'.php');

else echo $page.'Pagina No Existe!';
?>
