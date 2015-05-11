 <html>
<body>
      <table align="center">
           <form name="ingresar" method="post" action="login.php" onSubmit="return validar();">
                 <tr>
                     <td align="center" colspan="2"><font color="orange"><h2>Identificate</h2></font></td>
                 </tr>
                 <tr>
                     <td>Usuario:</td><td><input type='text' name='usuario' size=15></td>
                 </tr>
                 <tr>
                     <td>Clave:</td><td><input type='password' name='password' size=15></td>
                 </tr>
                 <tr>
                     <td align="center" colspan="2"><br><input type='submit' value='Ingresar'></td>
                 </tr>
                 <script language="javascript">
                         function validar(){
                                var usuario=document.ingresar.user.value;
                                var password=document.ingresar.pass.value;
                                if(usuario==''){alert("Introduce el campo usuario");return false;}
                                if(password==''){alert("Introduce el campo clave");return false;}
                                return true;
                         }
                 </script>
            </form>
      </table>
</body>
</html> 