<?php 
include("../conexion.php");
function mostrarcompras(){
/* ----Conexion con Base de Datos---- */

$server= servidor();

$base = basedatos();

$usuario=usuario();

$contrasena=contrasena();



$link = mysqli_connect($server,$usuario,$contrasena);

mysqli_select_db($link,$base);



if($result=mysqli_query( $link,"SELECT * FROM salidas")){ 

echo "<table> \n"; 

echo "<tr> <td><strong>Consecutivo</strong></td>

		   <td><strong>Id Salidas</strong></td>

          <td><strong>Fecha</strong></td>

		  <td><strong>Cantidad</strong></td>

		  <td><strong>Precio</strong></td>

		  <td><strong>idtrabajador</strong></td>

		  <td><strong>camb</strong></td>
		  

		  </tr>\n"; 

$contador=1;

//Variable para guardar todo lo que se imprimira

$todo="";



$row=mysqli_fetch_array($result, MYSQLI_BOTH);

do { 

//Guardadndo en variables resultado de consulta sql

$idcomras=$row["idsalidas"];

$fecha=$row["fecha"];

$cantidad=$row["cantidad"];

$precio=$row["precio"];

$idtrabajador=$row["idTRABAJADOR"];

$camb=$row["CAMB"];



$todo.="<tr><td>".$contador."</td>          

		  <td>".$row["idsalidas"]."</td>		 

		  <td>".$row["fecha"]."</td>

		  <td>".$row["cantidad"]."</td>

		  <td>".$row["precio"]."</td>

		  <td>".$row["idTRABAJADOR"]."</td>

		  <td>".$row["CAMB"]."</td>";



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
