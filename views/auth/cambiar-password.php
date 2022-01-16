<section id="registro">
<div class="registro-header">
    <h1>OnlineOffice</h1>
    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="Cambiar la vista a modo oscuro o claro">
</div>
<h2>Cambiar Contraseña</h2>

<?php
    include_once __DIR__ . '../../templates/alertas.php';
?>

<form class="formulario" method="POST" enctype="multipart/form">

<label for="password"> Nueva Contraseña:</label>
        <input 
            id="password"
            name="usuario[password]" 
            type="password"
            value="<?php echo $usuario->password ?? ''; ?>"
        >

    <div class="botones">
        <a class="btn btn-lg mt-0 boton-rojo" href="/index.php/admin"> Salir </a>
        <button type="submit" class="btn btn-lg mt-0 boton-verde"> Guardar </button>
    </div>
</form>