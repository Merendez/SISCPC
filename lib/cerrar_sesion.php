<?php

//Reanudamos la sesión

@session_start();

//$_SESSION["validando"] = "NO";

@session_destroy();



header("Location: ../index.html");

exit();



?>