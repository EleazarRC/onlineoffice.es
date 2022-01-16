<section id="registro">
<div class="registro-header">
    <h1>OnlineOffice</h1>
    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="Cambiar la vista a modo oscuro o claro">
</div>
<h2>Recuperar Cuenta</h2>

<?php
    include_once __DIR__ . '../../templates/alertas.php';
?>

<form class="formulario" action="./recuperar" method="POST" enctype="multipart/form">

<label for="email"> Introduce tu email: </label>
    <input 
        id="email"
        name="usuario[email]" 
        type="email"
        value="<?php echo $usuario->email ?? ''; ?>"
    >

    <div class="botones">
        <a class="btn btn-lg mt-0 boton-rojo" href="/index.php/admin"> Salir </a>
        <button type="submit" class="btn btn-lg mt-0 boton-verde"> Enviar </button>
    </div>
</form>