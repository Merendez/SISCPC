<?php 
include './lib/seguridad.php';
include("../conexion.php");

$idTrabajador_obtenido=$_POST["idTrabajador"];
$contrasena_obtenido=$_POST["contrasena"];
$tipo_obtenido=$_POST["tipo"];
$estado_obtenido=$_POST["estado"];

echo ("idTrabajador: ".$idTrabajador_obtenido."<br>");
echo ("contrasena: ".$contrasena_obtenido."<br>");
echo ("tipo: ".$tipo_obtenido."<br>");
echo ("estado: ".$estado_obtenido."<br>");


/* A continuación, realizamos la conexión con nuestra base de datos en MySQL */

$server= servidor();

$base = basedatos();

$usuario=usuario();

$contrasena=contrasena();

$link = mysqli_connect($server,$usuario,$contrasena);
mysqli_select_db($link,$base);



//Revisando Consulta (query)
$sql="delete from usuarios where idTrabajador='".$idTrabajador_obtenido."'" ;

if(mysqli_query($link,$sql)){
  echo'<script type="text/javascript">
    alert("usuario Eliminado Con exito");
    window.location.href="eliminar_usuarios.php?idTrabajador=";
    </script>';
} else {

  echo ("Eliminacion Fallida Fallida  <br>");
  echo "Error: " . $sql . "<br>" . mysqli_error($link);
  
}
mysqli_close($link); //se cierra la conexion

?>
