<?php

//Reanudamos la sesi�n

@session_start();
$id=$_SESSION["user"];
$nombredeusuario=$_SESSION["nombre"];



//Validamos si existe realmente una sesi�n activa o no

if($_SESSION["loggedin"] != true){

//Si no hay sesi�n activa, lo direccionamos al index.html (inicio de sesi�n)

header("Location: index.html");

exit();

}

?>