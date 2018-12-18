<?php

function mostrar_menu(){
include '../lib/seguridad.php';

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
    
<li><a href="../principal.php">INICIO</a>   </li>


 <li><a href="#">Usuarios</a> 
      
      <ul>
        <li><a href="./registro_usuarios.php?idTrabajador=">Nuevo</a></li>
        <li><a href="./modificar_usuarios.php?idTrabajador=">Modificar</a></li>
        <li><a href="./eliminar_usuarios.php?idTrabajador=">Eliminar</a></li>
       </ul>
    </li>




 <li><a href="#">Trabajador</a> 
      
      <ul>
        <li><a href="./registro_trabajador.php">Nuevo</a></li>
        <li><a href="./modificar_trabajador.php?idtrabajador=">Modificar</a></li>
        <li><a href="./eliminar_trabajador.php?idtrabajador=">Eliminar</a></li>
         <li><a href="./visualizar_trabajador.php">Visualizar</a></li>
       </ul>
    </li>
   <li><a href="#">Compras</a> 
      <ul>
        <li><a href="./registro_compras.php">Nuevo</a></li>
         <li><a href="./modificar_compras.php?idcompras=">Modificar</a></li>
        <li><a href="./eliminar_compras.php?idcompras=">Eliminar Compra</a></li>
         <li><a href="./visualizar_compras.php">Visualizar</a></li>
        
       </ul>
    </li>
  
    <li><a href="#">Bienes</a> 
      <ul>
     <li><a href="./registro_bienes.php">Nuevo</a></li>
      <li><a href="./modificar_bienes.php?camb=">Modificar</a></li>
        <li><a href="./eliminar_bienes.php?camb="">Eliminar</a></li>
        <li><a href="./visualizar_bienes.php">Visualizar</a></li>
       </ul>
    </li>
    
    
    
    <li><a href="#">Salidas</a> 
      <ul>

        <li><a href="./registro_salidas.php">Nuevo</a></li>
        <li><a href="./modificar_salidas.php">Modificar</a></li>
        <li><a href="./eliminar_salidas.php?idsalidas=">Eliminar</a></li>
        <li><a href="./visualizar_salidas.php">Visualizar</a></li>

      </ul>
    </li>
    <li><a href="../lib/cerrar_sesion.php">Salir</a> 
      
    </li>
</ul>

TEXTO;
echo "".$menu;
}

function mostrar_menu_supervisor(){
$menu=<<<TEXTO
<ul>
    
<li><a href="../principal.php">INICIO</a>   </li>



   <li><a href="#">Compras</a> 
      <ul>
        <li><a href="./registro_compras.php">Nuevo</a></li>
         <li><a href="./modificar_compras.php?idcompras=">Modificar</a></li>
        <li><a href="./eliminar_compras.php?idcompras=">Eliminar Compra</a></li>
         <

   <li><a href="#">Compras</a> 
      <ul>
        <li><a href="./registro_compras.php">Nuevo</a></li>
         <li><a href="./modificar_compras.php?idcompras=">Modificar</a></li>
        <li><a href="./eliminar_compras.php?idcompras=">Eliminar Compra</a></li>
         <li><a href="./visualizar_compras.php">Visualizar</a></li>
        
       </ul>
    </li>
  
    <li><a href="#">Bienes</a> 
      <ul>
     <li><a href="./registro_bienes.php">Nuevo</a></li>
      <li><a href="./modificar_bienes.php?camb=">Modificar</a></li>
        <li><a href="./eliminar_bienes.php?camb="">Eliminar</a></li>
        <li><a href="./visualizar_bienes.php">Visualizar</a></li>
       </ul>
    </li>
    
    
    
    <li><a href="#">Salidas</a> 
      <ul>

        <li><a href="./registro_salidas.php">Nuevo</a></li>
        <li><a href="./modificar_salidas.php">Modificar</a></li>
        <li><a href="./eliminar_salidas.php?idsalidas=">Eliminar</a></li>
        <li><a href="./visualizar_salidas.php">Visualizar</a></li>

      </ul>
    </li>
    <li><a href="../lib/cerrar_sesion.php">Salir</a> 
      
    </li>
</ul>

TEXTO;
echo "".$menu;
}

function mostrar_menu_invitado(){
$menu=<<<TEXTO
<ul>
    
<li><a href="../principal.php">INICIO</a>   </li>




   <li><a href="#">Compras</a> 
      <ul>
      
         <li><a href="./visualizar_compras.php">Visualizar</a></li>
        
       </ul>
    </li>
  
    <li><a href="#">Bienes</a> 
      <ul>
   
        <li><a href="./visualizar_bienes.php">Visualizar</a></li>
       </ul>
    </li>
    
    
    
    <li><a href="#">Salidas</a> 
      <ul>

   
        <li><a href="./visualizar_salidas.php">Visualizar</a></li>

      </ul>
    </li>
    <li><a href="../lib/cerrar_sesion.php">Salir</a> 
      
    </li>
</ul>

TEXTO;
echo "".$menu;
}
?>