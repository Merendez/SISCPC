<?php
include '../lib/seguridad.php'; 
include("../conexion.php");
//obteniendo valores de las cajas de texto
$idTrabajador= htmlentities($_POST["idTrabajador"] );
$contrasena= htmlentities($_POST["contrasena"] );
$tipo= htmlentities($_POST["tipo"] );
$estado= htmlentities($_POST["estado"] );




//VISUALIZANDO VALORES
echo("valores de las variables <br>");
echo ("idTrabajador: ".$idTrabajador."<br>");
echo ("contrasena: ".$contrasena."<br>");
echo ("tipo: ".$tipo."<br>");
echo ("estado: ".$estado."<br>");


//Conectando con Base de Datos
$server= servidor();

$base = basedatos();

$usuario=usuario();

$contrasena=contrasena();

$link = mysqli_connect($server,$usuario,$contrasena);
mysqli_select_db($link,$base);

//Revisando Consulta (query)
$sql="INSERT INTO USUARIOS(idTrabajador, contrasena, tipo, estado) VALUES ('$idTrabajador', '$contrasena', '$tipo','$estado')";

if(mysqli_query($link,$sql)){
	echo'<script type="text/javascript">
    alert("Registro Guardado");
    window.location.href="registro_usuarios.php";
    </script>';
} else {

	echo ("Resgistro Fallido <br>");
	echo "Error: " . $sql . "<br>" . mysqli_error($link);
	
}
mysqli_close($link); //se cierra la conexion


?>
