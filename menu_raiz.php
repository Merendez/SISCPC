<?php
function mostrar_menu(){
$menu=<<<TEXTO
<ul>

 <li><a href="#">Usuarios</a> 
      
      <ul>
        <li><a href="./resources/registro_usuarios.php">Nuevo</a></li>
        <li><a href="./resources/modificar_usuarios.php?idTrabajador=">Modificar</a></li>
        <li><a href="./resources/eliminar_usuarios.php?idTrabajador=">Eliminar</a></li>
       </ul>
    </li>


    
    
 <li><a href="#">Trabajador</a> 
      <ul>
        <li><a href="./resources/registro_trabajador.php">Nuevo</a></li>
        <li><a href="./resources/mostrarusuarios.php">Buscar</a></li>
        <li><a href="./resources/modificar_trabajador.php?idtrabajador=">Modificar</a></li>
        <li><a href="./resources/eliminar_trabajador.php?idtrabajador=">Eliminar</a></li>
       </ul>
    </li>
   <li><a href="#">Compras</a> 
      <ul>
        <li><a href="./resources/registro_compras.php">Nuevo</a></li>
        <li><a href="./resources/mostrarcompras.php">Buscar</a></li
        <li><a href="./resources/modificar_compras.php?idcompras=">Modificar</a></li>
        <li><a href="./resources/eliminar_compras.php?idcompras=">Eliminar Compra</a></li>
        
       </ul>
    </li>
  
    <li><a href="#">Bienes</a> 
      <ul>
     <li><a href="./resources/registro_bienes.php">Nuevo</a></li>
     <li><a href="./resources/mostrarbienes.php">Buscar</a></li>
        <li><a href="./resources/modificar_bienes.php?camb=">Modificar</a></li>
        <li><a href="./resources/eliminar_bienes.php?camb="">Eliminar</a></li>
       </ul>
    </li>
    
    
    
    <li><a href="#">Salidas</a> 
      <ul>

        <li><a href="./resources/registro_salidas.php">Nuevo</a></li>
        <li><a href="./resources/mostrarbienes.php">Buscar</a></li>
        <li><a href="./resources/modificar_salidas.php">Modificar</a></li>
        <li><a href="./resources/eliminar_salidas.php?idsalidas=">Eliminar</a></li>

      </ul>
    </li>
    <li><a href="./lib/cerrar_sesion.php">Salir</a> 
      
    </li>
</ul>

TEXTO;
echo "".$menu;
}

?>