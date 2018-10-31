<?php
/*
Este archivo controla el acesso a la base de datos 
  */
$link=mysqli_connect("localhost", "root", "" );
mysqli_select_db($link,"conagua");
/*
Verificando si existe usuario
  */

$myusuario=mysqli_query($link, "select idtrabajador from usuarios where idtrabajador = '".htmlentities($_POST{"usuario"})."' ");
$num_myusuario=mysqli_num_rows($myusuario);
if($num_myusuario != 0){
$sql="select idtrabajador from usuarios where estado=1 and contrasena=' ".htmlentities($_POST{"contrasena"})." 'and idtrabajador = ' " .htmlentities($_POST{"usuario"})."'";

$myclave=mysqli_query($link,$sql);
$nmyclave=mysqli_num_rows($myclave);

if($nmyclave != 0 ){
 seccion_start ();
$_SESSION ["validado"] = "ok";
$_SESSION ["usuario"]= $myclave;

header ("Location:../principal.php");

}else{
	echo"<script>alert('La contrase\u00f1a del usuario no es correcta.');
</script>";
}


}else{
echo"<script>alert('El usuario no existe.');
window.location.href=\"../index.html\"
</script>";

}
mysql_close()
?>