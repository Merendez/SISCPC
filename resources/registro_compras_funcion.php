<?php 
include("../conexion.php");
//obteniendo valores de las cajas de texto

$fecha= htmlentities($_POST["fecha"] );
$cantidad= htmlentities($_POST["cantidad"] );
$precio= htmlentities($_POST["precio"] );
$idTRABAJADOR= htmlentities($_POST["idtrabajador"] );
$CAMB= htmlentities($_POST["camb"] );




//VISUALIZANDO VALORES
echo("valores de las variables <br>");
echo ("idcompras: ".$idcompras."<br>");
echo ("fecha: ".$fecha."<br>");
echo ("cantidad: ".$cantidad."<br>");
echo ("precio: ".$precio."<br>");
echo ("idTRABAJADOR: ".$idTRABAJADOR."<br>");

echo ("CAMB: ".$CAMB."<br>");


//Conectando con Base de Datos
$server= servidor();

$base = basedatos();

$usuario=usuario();

$contrasena=contrasena();

$link = mysqli_connect($server,$usuario,$contrasena);
mysqli_select_db($link,$base);

//Revisando Consulta (query)
$sql="INSERT INTO COMPRAS(idcompras, fecha, cantidad, precio, idTRABAJADOR, CAMB)VALUES('$idcompras', '$fecha', '$cantidad', '$precio',         '$idTRABAJADOR','$CAMB')";

if(mysqli_query($link,$sql)){
	echo'<script type="text/javascript">
    alert("Registro Guardado");
    window.location.href="registro_compras.php";
    </script>';
} else {

	echo ("Resgistro Fallido <br>");
	echo "Error: " . $sql . "<br>" . mysqli_error($link);
	
}
mysqli_close($link); //se cierra la conexion


?>
