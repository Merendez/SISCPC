<?php 
include '../lib/seguridad.php';
include("../conexion.php");
$idTrabajador_obtenido=$_POST["idTrabajador"];
$contrasena_obtenido=$_POST["contrasena"];
$tipo_obtenido=$_POST["tipo"];
$estado_obtenido=$_POST["estado"];

echo ("idTrabajador: ".$idTrabajador_obtenido."<br>");
echo ("contrasena: ".$contrasena_obtenido."<br>");
echo ("tipo: ".$tipo_obtenido."<br>");
echo ("estado: ".$estado_obtenido."<br>");

$server= servidor();

$base = basedatos();

$usuario=usuario();

$contrasena=contrasena();

$link = mysqli_connect($server,$usuario,$contrasena);
mysqli_select_db($link,$base);

//Revisando Consulta (query)
$sql="UPDATE usuarios SET idTrabajador='".$idTrabajador_obtenido."', contrasena='".$contrasena_obtenido."',tipo='".$tipo_obtenido."', estado='".$estado_obtenido."' WHERE camb='".$idTrabajador_obtenido."'";

if(mysqli_query($link,$sql)){
  echo'<script type="text/javascript">
    alert("Usuario Modificado Con exito");
    window.location.href="modificar_usuarios.php?camb=";
    </script>';
} else {

  echo ("Modificacion Fallida  <br>");
  echo "Error: " . $sql . "<br>" . mysqli_error($link);
  
}
mysqli_close($link); //se cierra la conexion

?>
