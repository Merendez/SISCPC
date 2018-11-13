<?php
/*
Este archivo controla el acesso a la base de datos 
  */
$link=mysqli_connect("localhost", "root", "" );
mysql_select_db($link,"conagua");
/*
Verificando si existe usuario
  */

$myusuario=mysqli_query($link, "select idtrabajador from usuarios where idtrabajador = '".htmlentities($_POST{"usuario"})."' ");
$num_myusuario=mysqli_num_rows($myusuario);
if($num_myusuario != 0){
$sql="select idtrabajador from usuarios where estado=1 and contrasena=' ".htmlentities($_POST{"contrasena"})." 'and idtrabajador = ' " .htmlentities($_POST{"usuario"})."'";

$myclave=mysqli_query($link,$sql);
$nmyclave=mysql_num_rows($myclave);

if($nmyclave != 0 ){ seccion_start ();
$_SESSION ["validado"] = "ok";
$_SESSION ["usuario"]= $myclave;


$result= mysqli_query($link, "select * from trabajador where idtrabajador='" .htmlentities($_POST{"usuario"})."'" );
if ($row=mysqli_fetch_array($result, MYSQLI_BOTH)) // si la variable tiene una sola fila entonces seguimos con el codigo
 {
do{
$nombre=$row['nombre'];
$apellidoPaterno=$row['apellidoPaterno'];
$apellidoMaterno=$row['apellidoMaterno'];
$sexo=$row['sexo'];
$direccion=$row['direccion'];
$telefono=$row['telefono'];
$correo=$row['correo'];
$Puesto=$row['Puesto'];
$_SESSION ["nombre"]= $nombre.$apellidoPaterno.$apellidoMaterno;


} 
while($row=mysqli_fetch_array($result, MYSQLI_BOTH));
}else{echo"<script>alert('No se afectuo la consulta');
</script>";}

//Guardamos el idtrabajador para enviarlo a la pagina principal
$idtrabjador=$_POST{"usuario"};
header ("Location:../principal.php?idtrabajador=$idtrabajador");

}else{
	echo"<script>alert('La contrase\u00f1a del usuario no es correcta.');
</script>";
}


}else{
echo"<script>alert('El usuario no existe.');
window.location.href=\"../index.html\"
</script>";

}
mysqli_close()
?>