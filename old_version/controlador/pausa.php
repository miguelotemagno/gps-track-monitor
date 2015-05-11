<?php
$seconds=$_GET['delay'];
$seconds=$seconds/1000;
pause($seconds);
function pause($seconds){

  sleep($seconds);

}

?>
