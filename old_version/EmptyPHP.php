<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>yensdesign.com - Create a professional interface for your web applications using jQuery</title>
	<link rel="stylesheet" type="text/css" media="screen" href="css/base.css" />
	<!--scripts-->
	<script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>
	<script src="js/interface.js" type="text/javascript"></script>
	<!--/scripts-->
</head>
<body>
    <div id="menu">
        <ul>
            <li id="file"><span>File</span></li>
            <li id="tools"><span>Tools</span></li>
            <li id="help"><span>Help</span></li>
        </ul>
    </div>
    <div id="fileContainer">
        <ul>
            <li id="new"><div class="img"><img src="images/new.gif" /></div><div class="text">New Document</div><div class="clear" /></li>
            <li id="open"><div class="img"><img src="images/open.gif" /></div><div class="text">Open</div><div class="clear" /></li>
            <li id="save"><div class="img"><img src="images/save.gif" /></div><div class="text">Save as...</div><div class="clear" /></li>
            <li id="refresh"><div class="img"><img src="images/refresh.gif" /></div><div class="text">Refresh</div><div class="clear" /></li>
        </ul>
    </div>
    <div id="toolsContainer">
        <ul>
            <li id="fc"><div class="img"><img src="images/print.png" /></div><div id="print" class="text">Print...</div><div class="clear" /></li>
        </ul>
    </div>
    <div id="helpContainer">
        <ul>
            <li id="help"><div class="img"><img src="images/help.gif" /></div><div class="text"><a href="http://yensdesign.com/about/">About the author...</a></div><div class="clear" /></li>
        </ul>
    </div>

    <div id="lateralPanel">
		<div id="favSection" class="section">Configuracion</div>
		<ul>
			<li class="active">Index</li>
		
		</ul>
		<div id="genSection" class="section">Mapa</div>
		<ul>
			<li>Mapa</li>
                </ul>
	</div>
	<a><div id="lateralClick"><img id="lateralClickImg" src="images/toggleRight.gif" /></div></a>
	<div id="mainContent">
		<iframe id="iframe" width="100%" height="100%" src="index.php" frameborder="0">
	</div>
</html>
</body>