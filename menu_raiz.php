<?php
include './lib/seguridad.php';

function mostrar_menu(){
include './lib/seguridad.php';

if($credenciales=="Administrador"){
  $mimenu=mostrar_menu_administrador();
echo ($mimenu);
}
if($credenciales=="Supervisor"){
  $mimenu=mostrar_menu_supervisor();
echo ($mimenu);
}
if($credenciales=="Invitado"){
  $mimenu=mostrar_menu_invitado();
echo ($mimenu);
}
}

function mostrar_menu_administrador(){
$menu=<<<TEXTO
<ul>

 <li><a href="#">&nbsp;&nbsp;Usuarios&nbsp;&nbsp;</a> 
      
      <ul>
        <li><a href="./resources/registro_usuarios.php?idTrabajador=">Nuevo</a></li>
        <li><a href="./resources/modificar_usuarios.php?idTrabajador=">Modificar</a></li>
        <li><a href="./resources/eliminar_usuarios.php?idTrabajador=">Eliminar</a></li>
       </ul>
    </li>


    
    
 <li><a href="#">&nbsp;&nbsp;Trabajador&nbsp;&nbsp;</a> 
      <ul>
        <li><a href="./resources/registro_trabajador.php">Nuevo</a></li>
        <li><a href="./resources/modificar_trabajador.php?idtrabajador=">Modificar</a></li>
        <li><a href="./resources/eliminar_trabajador.php?idtrabajador=">Eliminar</a></li>
        <li><a href="./resources/visualizar_trabajador.php">Visualizar</a></li>
       </ul>
    </li>
   <li><a href="#">&nbsp;&nbsp;Compras&nbsp;&nbsp;</a> 
      <ul>
        <li><a href="./resources/registro_compras.php">Nuevo</a></li>
        <li><a href="./resources/modificar_compras.php?idcompras=">Modificar</a></li>
        <li><a href="./resources/eliminar_compras.php?idcompras=">Eliminar Compra</a></li>
           <li><a href="./resources/Visualizar_compras.php">visualizar</a></li>
        
       </ul>
    </li>
  
    <li><a href="#">&nbsp;&nbsp;Bienes&nbsp;&nbsp;</a> 
      <ul>
     <li><a href="./resources/registro_bienes.php">Nuevo</a></li>
        <li><a href="./resources/modificar_bienes.php?camb=">Modificar</a></li>
        <li><a href="./resources/eliminar_bienes.php?camb="">Eliminar</a></li>
        <li><a href="./resources/visualizar_bienes.php">visualizar</a></li>
       </ul>
    </li>
    
    
    
    <li><a href="#">&nbsp;&nbsp;Salidas&nbsp;&nbsp;</a> 
      <ul>

        <li><a href="./resources/registro_salidas.php">Nuevo</a></li>
        <li><a href="./resources/modificar_salidas.php">Modificar</a></li>
        <li><a href="./resources/eliminar_salidas.php?idsalidas=">Eliminar</a></li>
            <li><a href="./resources/visualizar_salidas.php">Visualizar</a></li>

      </ul>
    </li>
    <li><a href="./lib/cerrar_sesion.php">&nbsp;&nbsp;Salir&nbsp;&nbsp;</a> 
      
    </li>
</ul>

TEXTO;
echo "".$menu;
}
function mostrar_menu_supervisor(){
$menu=<<<TEXTO
<ul>

   <li><a href="#">Compras</a> 
      <ul>
        <li><a href="./resources/registro_compras.php">Nuevo</a></li>
        <li><a href="./resources/modificar_compras.php?idcompras=">Modificar</a></li>
        <li><a href="./resources/eliminar_compras.php?idcompras=">Eliminar Compra</a></li>
           <li><a href="./resources/Visualizar_compras.php">visualizar</a></li>
        
       </ul>
    </li>
  
    <li><a href="#">Bienes</a> 
      <ul>
     <li><a href="./resources/registro_bienes.php">Nuevo</a></li>
        <li><a href="./resources/modificar_bienes.php?camb=">Modificar</a></li>
        <li><a href="./resources/eliminar_bienes.php?camb="">Eliminar</a></li>
        <li><a href="./resources/visualizar_bienes.php">visualizar</a></li>
       </ul>
    </li>
    
    
    
    <li><a href="#">Salidas</a> 
      <ul>

        <li><a href="./resources/registro_salidas.php">Nuevo</a></li>
        <li><a href="./resources/modificar_salidas.php">Modificar</a></li>
        <li><a href="./resources/eliminar_salidas.php?idsalidas=">Eliminar</a></li>
            <li><a href="./resources/visualizar_salidas.php">Visualizar</a></li>

      </ul>
    </li>
    <li><a href="./lib/cerrar_sesion.php">Salir</a> 
      
    </li>
</ul>

TEXTO;
echo "".$menu;
}


function mostrar_menu_invitado(){
$menu=<<<TEXTO
<ul>

   <li><a href="#">Compras</a> 
      <ul>
        
           <li><a href="./resources/Visualizar_compras.php">visualizar</a></li>
        
       </ul>
    </li>
  
    <li><a href="#">Bienes</a> 
      <ul>
    
        <li><a href="./resources/visualizar_bienes.php">visualizar</a></li>
       </ul>
    </li>
    
    
    
    <li><a href="#">Salidas</a> 
      <ul>

      
            <li><a href="./resources/visualizar_salidas.php">Visualizar</a></li>

      </ul>
    </li>
    <li><a href="./lib/cerrar_sesion.php">Salir</a> 
      
    </li>
</ul>

TEXTO;
echo "".$menu;
}
