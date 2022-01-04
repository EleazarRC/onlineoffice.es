<?php
include_once __DIR__ . '/../templates/alertas.php';
?>

<div class="container contenedor administracion">

    <h2>Administración</h2>

    <h3>Usuarios:</h3>

    <div class="herramientas-Usuarios mb-3 ms-2 me-2">
        <div>
            <a class="btn btn-lg mt-0 boton-verde" href="/index.php/admin/crearNuevoUsuario">Añadir Nuevo Usuario</a>
        </div>

        <div class="input-group mt-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input id="buscador" type="text" class="form-control" placeholder="Buscar por Nombre" aria-label="Username" aria-describedby="basic-addon1">
        </div>

        <div id="marcadorPagina">
        </div>
    </div>

    <div id="no-more-tables" class="table-responsive mb-1">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th class="numeric">#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th class="numeric">Puntos</th>
                </tr>    
            </thead>
            <tbody id="infoUsuarios"> <!-- <tbody id="tbody-insert">-->
                    
           
            </tbody>
        </table>
        <div id="tfoot-paging" class="espaciado"></div>
    </div>
</div>
<script src="/build/js/administracion.js"></script>