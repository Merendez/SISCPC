<?php 
include '../lib/seguridad.php';
include("../conexion.php");
//obteniendo valores de las cajas de texto
$idsalidas= htmlentities($_POST["idsalidas"] );
$fecha= htmlentities($_POST["fecha"] );
$cantidad= htmlentities($_POST["cantidad"] );
$idTRABAJADOR= htmlentities($_POST["idTRABAJADOR"] );
$CAMB= htmlentities($_POST["CAMB"] );




//VISUALIZANDO VALORES
echo("valores de las variables <br>");
echo ("idsalidas: ".$idsalidas."<br>");
echo ("fecha: ".$fecha."<br>");
echo ("cantidad: ".$cantidad."<br>");
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
$sql="INSERT INTO salidas(idsalidas, fecha, cantidad, idTRABAJADOR, CAMB)VALUES('$idsalidas', '$fecha', '$cantidad', '$idTRABAJADOR','$CAMB')";

if(mysqli_query($link,$sql)){
	$sql2 ="update bienes set existencia=existencia-'".$cantidad."' where camb='".$CAMB."'";
	if(mysqli_query($link,$sql2)){
		echo'<script type="text/javascript">
    alert("Disminuyeron las existencias");
   
    </script>';
}else{
	echo'<script type="text/javascript">
    alert("no se afecto inventario");
  
    </script>';
}
	echo'<script type="text/javascript">
    alert("Compra efectuada");
    window.location.href="registro_salidas.php";
    </script>';
} else {

	echo ("Resgistro Fallido <br>");
	echo "Error: " . $sql . "<br>" . mysqli_error($link);



	
}
mysqli_close($link); //se cierra la conexion


?>
