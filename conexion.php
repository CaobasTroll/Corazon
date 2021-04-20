<?php 
   
    //AQUI CONECTAMOS A LA BASE DE DATOS DE POSTGRES
$conex = "host=localhost port=5432 user=postgres password=ElPene90 dbname=Adler_Pelzer_Group";
$cnx = pg_connect($conex) or die ("<h1>Error de conexion.</h1> ". pg_last_error());
session_start();

function quitar($mensaje)
{
 $nopermitidos = array("'",'\\','<','>',"\"");
 $mensaje = str_replace($nopermitidos, "", $mensaje);
 return $mensaje;
}
if(trim($_POST["usuario"]) != "" && trim($_POST["password"]) != "")
{
 // Puedes utilizar la funcion para eliminar algun caracter en especifico
 //$usuario = strtolower(quitar($HTTP_POST_VARS["usuario"]));
 //$password = $HTTP_POST_VARS["password"];
 // o puedes convertir los a su entidad HTML aplicable con htmlentities
 $usuario = strtolower(htmlentities($_POST["usuario"], ENT_QUOTES));
 $password = $_POST["password"];
 $result = pg_query('SELECT password, email FROM usuario WHERE email=\''.$usuario.'\'');
 if($row = pg_fetch_array($result)){
  if($row["password"] == $password){
   $_SESSION["k_username"] = $row['usuario'];
   echo 'Has sido logueado correctamente '.$_SESSION['k_username'].' <p>';
   echo '<a href="index.html">Index</a></p>';
   //Elimina el siguiente comentario si quieres que re-dirigir automáticamente a index.php
   <SCRIPT LANGUAGE="javascript"
   location.href = "index.html";
   </SCRIPT>
  }else{
   echo 'Password incorrecto';
  }
 }else{
  echo 'Usuario no existente en la base de datos';
 }
 pg_free_result($result);
}else{
 echo 'Debe especificar un usuario y password';
}
pg_close();
>