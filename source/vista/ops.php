<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
<!--
.bd {
	text-align: center;
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	font-size: x-large;
}
-->
</style>
</head>

<body>
<form name="form3" onSubmit="cargarPagina('controlador/1sq.php?op='+document.form3.ejemplos.value,'capa2'); return false;">
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="86" height="46">&nbsp;</td>
    <td colspan="2" class="bd">Creando Base datos</td>
    <td width="109">&nbsp;</td>
  </tr>
  <tr>
    <td height="43">&nbsp;</td>
    <td width="207">&nbsp;</td>
    <td width="188">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="50">&nbsp;</td>
    <td>Desea agregar datos ejemplos</td>
    <td><input type="checkbox" name="ejemplos" id="ejemplos" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="70">&nbsp;</td>
    <td>Para iniciar aqui ----&gt;</td>
    <td><input type="submit" name="iniciar" id="iniciar" value="Inicar" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="70">&nbsp;</td>
    <td colspan="2"><div id="sql"></div></td>
    <td>&nbsp;</td>
  </tr>
</table>
    </form>
</body>
</html>