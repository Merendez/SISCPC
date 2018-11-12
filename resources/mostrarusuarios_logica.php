<?php 
include '../lib/seguridad.php';
include("../conexion.php");
function mostrarusuarios(){
/* ----Conexion con Base de Datos---- */

$server= servidor();

$base = basedatos();

$usuario=usuario();

$contrasena=contrasena();



$link = mysqli_connect($server,$usuario,$contrasena);

mysqli_select_db($link,$base);



if($result=mysqli_query( $link,"SELECT * FROM usuarios")){ 

echo "<table> \n"; 

echo "<tr> <td><strong>Consecutivo</strong></td>

		   <td><strong>Id trabajador</strong></td>

          <td><strong>Contraseña</strong></td>

		  <td><strong>Tipo</strong></td>

		  <td><strong>Estado</strong></td>



		  

		  

		  </tr>\n"; 

$contador=1;

//Variable para guardar todo lo que se imprimira

$todo="";



$row=mysqli_fetch_array($result, MYSQLI_BOTH);

do { 

//Guardadndo en variables resultado de consulta sql

$idtrabajador=$row["idTrabajador"];

$contrasena=$row["contrasena"];

$tipo=$row["tipo"];

$estado=$row["estado"];





$todo.="<tr><td>".$contador."</td>          

		  <td>".$row["idTrabajador"]."</td>		 

		  <td>".$row["contrasena"]."</td>

		  <td>".$row["tipo"]."</td>

		  <td>".$row["estado"]."</td>";

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
