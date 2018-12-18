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
//------------------------------

$result= mysqli_query($link, "select * from trabajador,usuarios where trabajador.idtrabajador='".$_POST["usuario"]."' and usuarios.idtrabajador='".$_POST["usuario"]."'" );

if ($row=mysqli_fetch_array($result, MYSQLI_BOTH)) // si la variable tiene una sola fila entonces seguimos con el codigo

 {echo"<script>alert('si if');

</script>";

do{

$nombre=$row['nombre'];

$apellidoPaterno=$row['apellidoPaterno'];

$apellidoMaterno=$row['apellidoMaterno'];

$Tipo=$row['tipo'];

$_SESSION["nombrecompleto"]=$nombre." ".$apellidoPaterno." ".$apellidoMaterno;

$_SESSION["credenciales"]=$Tipo;

echo"<script>alert('si do');

</script>";

} 

while($row=mysqli_fetch_array($result, MYSQLI_BOTH));

}

else { echo"<script>alert('no buscado');

</script>";}

//------------------------------
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