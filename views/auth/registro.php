<section id="registro">
<div class="registro-header">
    <h1>OnlineOffice</h1>
    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="Cambiar la vista a modo oscuro o claro">
</div>
<h2>Bienvenid@</h2>
<?php
                    include_once __DIR__ . '../../templates/alertas.php';
?>
    <form
        class="formulario" 
        action="/index.php/registro" 
        method="POST" 
        enctype="multipart/form">

        <label for="nombre"> Nombre: </label>
            <input 
                id="nombre"
                name="usuario[nombre]" 
                type="text"
                value="<?php echo $usuario->nombre ?? ''; ?>"
            >
        <label for="apellido"> Apellido: </label>
        <input 
            id="apellido"
            name="usuario[apellido]"  
            type="text"
            value="<?php echo $usuario->apellido ?? ''; ?>"
        >
        <label for="email"> Email: </label>
        <input 
            id="email"
            name="usuario[email]" 
            type="email"
            value="<?php echo $usuario->email ?? ''; ?>"
        >

        <label for="password"> Contraseña:</label>
        <input 
            id="password"
            name="usuario[password]" 
            type="password"
            value="<?php echo $usuario->password ?? ''; ?>"
        >
        

        <div class="botones">
            <a class="btn btn-lg mt-0 boton-rojo" href="/index.php"> Salir </a>
            <button type="submit" class="btn btn-lg mt-0 boton-verde"> Registár</button>
        </div>
    </form>
</section>