<?php 
include '../lib/seguridad.php';
include("../conexion.php");
function mostrarbienes(){
/* ----Conexion con Base de Datos---- */

$server= servidor();

$base = basedatos();

$usuario=usuario();

$contrasena=contrasena();



$link = mysqli_connect($server,$usuario,$contrasena);

mysqli_select_db($link,$base);



if($result=mysqli_query( $link,"SELECT * FROM bienes")){ 

echo "<table> \n"; 

echo "<tr> <td><strong>Consecutivo</strong></td>

		   <td><strong>CAMB</strong></td>

          <td><strong>DESCRIPCION</strong></td>

		  <td><strong>EXISTO</strong></td>

		  

		  </tr>\n"; 

$contador=1;

//Variable para guardar todo lo que se imprimira

$todo="";



$row=mysqli_fetch_array($result, MYSQLI_BOTH);

do { 

//Guardadndo en variables resultado de consulta sql

$camb=$row["camb"];

$descripcion=$row["descripcion"];

$existencia=$row["existencia"];






$todo.="<tr><td>".$contador."</td>          

		  <td>".$row["camb"]."</td>		 

		  <td>".$row["descripcion"]."</td>

		  <td>".$row["existencia"]."</td>";

		 

		 $todo.="</tr> \n";

		   

$contador=$contador+1;

} while($row=mysqli_fetch_array($result, MYSQLI_BOTH));



echo ($todo); 

echo "</table>\n"; 

} 

else{ 

echo "<center>No se ha encontrado ningun Registro...</center>"; 

} 

	

mysqli_close($link); //Ce
}
?>
