<?php

//Reanudamos la sesión

@session_start();
$id=$_SESSION["user"];
$nombredeusuario=$_SESSION["nombre"];



//Validamos si existe realmente una sesión activa o no

if($_SESSION["loggedin"] != true){

//Si no hay sesión activa, lo direccionamos al index.html (inicio de sesión)

header("Location: index.html");

exit();

}

?>