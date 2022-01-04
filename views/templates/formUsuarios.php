


<form class="formulario" action="<?php echo $action ?>" method="POST" enctype="multipart/form">

<?php 
    if($editar == true){
        echo '<input hidden ';
        echo 'id="id"';
        echo 'name="usuario[id]"';
        echo 'type="number"';
        echo "value=" . $usuario->id ?? null;"";
        echo '>';
    }

?>
   
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

    <label for="password"> <?php echo $password; ?></label>
    <input 
        id="password"
        name="usuario[password]" 
        type="password"
        value="<?php echo $usuario->password ?? ''; ?>"
    >

    <label for="puntos"> Puntos: </label>
    <input 
        id="puntos"
        name="usuario[puntos]" 
        type="number"
        min='1'
        max='999999999'
        value="<?php echo $usuario->puntos ?? ''; ?>"
    >

    <div class="botones">
        <a class="btn btn-lg mt-0 boton-rojo" href="/index.php/admin"> Salir </a>
        <button type="submit" class="btn btn-lg mt-0 boton-verde"> Guardar </button>
    </div>
</form>