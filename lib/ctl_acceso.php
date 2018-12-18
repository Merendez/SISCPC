<?php
include("../conexion.php");



/* A continuaci?, realizamos la conexi? con nuestra base de datos en MySQL */



$server= servidor();

$base = basedatos();

$usuario=usuario();

$contrasena=contrasena();

$link = mysqli_connect($server,$usuario,$contrasena);
mysqli_select_db($link,$base);
                  

/* El query valida si el usuario ingresado existe en la base de datos. 
Se utiliza la funci? htmlentities para evitar inyecciones SQL. */
$myusuario = mysqli_query($link,"select idtrabajador from usuarios where 
             idtrabajador = '".htmlentities($_POST["usuario"])."'");
$nmyusuario = mysqli_num_rows($myusuario);

/*Si existe el usuario, validamos tambi? la contrase? ingresada y 
el estado del usuario?*/
if($nmyusuario != 0){
$sql = "select idtrabajador from usuarios 
where estado = 1 
and idtrabajador = '".htmlentities($_POST["usuario"])."'
and contrasena = '".(htmlentities($_POST["contrasena"]))."'";
$myclave = mysqli_query($link,$sql);
$nmyclave = mysqli_num_rows($myclave);

/*Si el usuario y clave ingresado son correctos (y el usuario est?activo en la BD)
, creamos la sesi? del mismo.*/
if($nmyclave != 0){
session_start();
/*Guardamos dos variables de sesi? que nos auxiliar?para saber si se 
est?o no ?logueado? un usuario*/
//session_register("controlador")

$_SESSION["loggedin"] = true;	
//$_SESSION["user"] = mysqli_result($myclave,0,0);  //Modifique esta linea original
$_SESSION["user"] = $_POST["usuario"];
$_SESSION["nombre"]= $_POST["usuario"];
//------------------------------
$result= mysqli_query($link, "select * from trabajador,usuarios where trabajador.idtrabajador='".$_POST["usuario"]."' and usuarios.idtrabajador='".$_POST["usuario"]."'" );
if ($row=mysqli_fetch_array($result, MYSQLI_BOTH)) // si la variable tiene una sola fila entonces seguimos con el codigo
 {echo"<script>alert('si if');
</script>";
do{
$nombre=$row['nombre'];
$apellidoPaterno=$row['apellidoPaterno'];
$apellidoMaterno=$row['apellidoMaterno'];
$sexo=$row['sexo'];
$direccion=$row['direccion'];
$telefono=$row['telefono'];
$correo=$row['correo'];
$Puesto=$row['Puesto'];
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

//nombre del usuario logueado.
//Direccionamos a nuestra p?ina principal del sistema.
$usuario1=$_POST["usuario"];
header ("Location:../principal.php?usuario=$usuario1");
}
else{
echo"<script>alert('La contrase\u00f1a del usuario no es correcta.');
</script>";
}
}else{
echo"<script>alert('El usuario no existe.');
window.location.href=\"../index.html\"
</script>";
}
mysql_close($link);


?>