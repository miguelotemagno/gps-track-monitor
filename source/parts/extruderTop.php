
<?php  ob_start();session_start();?>

<div class="voice {}"><a class="label" href="app.php">home</a></div>
<div id="top2" class="voice {panel:'parts/extr.components.html'}"><span class="label"><?php echo ucwords($_SESSION["nombre"]); ?></span></div>
<div class="voice {panel:'parts/extr.creativity.html'}"><span class="label">Opciones de Busqueda</span></div>
<div class="voice {panel:'parts/extruReportes.html'}"><span class="label">Reportes</span> </div>
<div class="voice {panel:'parts/extr.network.html'}"><span class="label">Alarmas</span></div>