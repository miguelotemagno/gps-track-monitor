<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript" src="js/add.js"></script>
        <script>




        </script>
    <style type="text/css">
<!--
.ss {
	font-family: "Courier New", Courier, monospace;
	font-size: large;
}
.s {
	font-family: "Courier New", Courier, monospace;
}
-->
    </style>
    </head>
    <body>
        
<?php /*require('mysql.php');

$query = "SELECT *  FROM conf ";
$result = mysql_query($query);

while ($row = @mysql_fetch_assoc($result))
{*/
    ?>
        <table border="0" align="center">
            <thead>
                <tr>
                    <th width="728" height="54" class="ss">Panel de Control IP, MySQL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <form name="form3" onSubmit="cargarPagina('controlador/grabarIP.php?ipp='+document.form3.ipsocket.value+'&pass='+document.form3.pass.value+'&ipsql='+document.form3.ipsql.value,'capa2'); return false;">
                        <center>
                          <p><span class="s">IP Servidor</span>:
                          <input name="ipsocket" type="text" class="s" value="" size="40">
                          <br><br>
                          <span class="s">IP Servidor MySQL:</span>
                          <input name="ipsql" type="text" class="s" value="" size="40" />
                          </p>
                          <p><span class="s">Password MySql</span>
<label>                <input type="text" name="pass" id="pass">
                </label>
                          </p>
                          <p>&nbsp;</p>
                          <p><br>
                            <input name="Modi"  type="submit" class="s"  value="Modificar" />
                          </p>
                        </center>

                        </form>
                        <div id="capa2"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                             <form name="form1" onSubmit="cargarPagina('divdata.php?data='+document.form1.Data.value,'capa'); return false;">
                            <center>
                             </center>

                            </form>
                    </td>
                </tr>
                <tr>
                    <td><center><div id="capa"></div></center></td>
                </tr>
            </tbody>
        </table>


<br><br><br>


        
        <?php
//}
        // put your code here
        ?>
    </body>
</html>
