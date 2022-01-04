<?php
include_once __DIR__ . '/../templates/alertas.php';
?>



<div class="container contenedor administracion">

   <h2>Administración</h2>
    <h3>Crear Nuevo Usuario</h3>

    <?php 
    
    $password = 'PASSWORD:';
    $action = '/index.php/admin/crearNuevoUsuario';
    $editar = null;

   include_once __DIR__ . '/../templates/formUsuarios.php'; ?>


</div>