<?php
ob_start(); 
session_start();

  if (isset($_POST["username"]) && isset($_POST["password"])){

     include "mysql.php";

     $sql="SELECT * FROM usuarios WHERE  usuario='".$_POST["username"]."' AND pass='".$_POST["password"]."'";
     $resultado=mysql_query($sql);

     if (mysql_affected_rows()>0){
         $registro=mysql_fetch_array($resultado);

       $_SESSION["nombre"]=$registro["usuario"];
       $_SESSION["cod"]=$registro["cod_user"];
       $_SESSION["tipo"]=$registro["rango"];

       session_register("SESSION");

       header('location: ../index.php');
        exit;
         
     }

     else{
          header('location: ../index.php?login=0');
                 }
//datos user

  }
?>
