<?php
include_once __DIR__ . '/../templates/alertas.php';
?>



<div class="container contenedor administracion">

   <h2>Administración</h2>
    <h3>Editar Usuario</h3>

   <?php
   
   $password = 'NUEVO PASSWORD:';
   $action = '/index.php/admin/actualizarUsuario';
   $editar = true;
   
   include_once __DIR__ . '/../templates/formUsuarios.php';
   
   
   ?>


</div>