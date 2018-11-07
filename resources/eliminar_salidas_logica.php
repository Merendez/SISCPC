<?php
include './lib/seguridad.php';
include("../conexion.php"); 
$idsalidas= htmlentities($_GET["idsalidas"] );
$fecha= htmlentities($_POST["fecha"] );
$cantidad= htmlentities($_POST["cantidad"] );
$idTRABAJADOR= htmlentities($_POST["idtrabajador"] );
$CAMB= htmlentities($_POST["camb"] );




//VISUALIZANDO VALORES
echo("valores de las variables <br>");
echo ("idsalidas: ".$idsalidas."<br>");
echo ("fecha: ".$fecha."<br>");
echo ("cantidad: ".$cantidad."<br>");
echo ("idTRABAJADOR: ".$idTRABAJADOR."<br>");
echo ("CAMB: ".$CAMB."<br>");


$server= servidor();

$base = basedatos();

$usuario=usuario();

$contrasena=contrasena();

$link = mysqli_connect($server,$usuario,$contrasena);
mysqli_select_db($link,$base);

//Revisando Consulta (query)
$sql="delete from salidas where idsalidas='".$idsalidas."'" ;

if(mysqli_query($link,$sql)){
  echo'<script type="text/javascript">
    alert("Salida Eliminada Con exito");
    window.location.href="eliminar_salidas.php?idcompras=";
    </script>';
} else {

  echo ("Eliminacion Fallida   <br>");
  echo "Error: " . $sql . "<br>" . mysqli_error($link);
  
}
mysqli_close($link); //se cierra la conexion

?>
