<?php
    if (!isset($_SESSION)) {
            session_start();
    }

    $auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/build/css/app.css">
    <title>OnlineOffice.es</title>
</head>
<body>

<div id="modal" class="modal">
    <div id="menuPrincipal" class="modal-content">
        <nav>
            <ul>
            <li><a href="/index.php/panelprincipal">Panel Principal</a></li>
                <li><a href="/index.php/notas">Notas</a></li>
                <li><a href="/index.php/agenda">Agenda</a></li>
                <li><a href="/index.php/equipo">Mi equipo</a></li>
                <?php echo $_SESSION['administrador'] === "1" ? '<li><a href="/index.php/admin">Administración</a></li>': ''; ?> 
                <li><a href="/index.php/configuracion">Configuración</a></li>
            </ul>
            <div id="btnSalir" class="btnSalir center">
                <!--<a href="/index.php/logout">SALIR</a>-->
                    <img class="" src="/build/img/cancel_black_24dp.svg">
            </div>
           
        </nav>
    </div>

</div>



<header <?php echo "class='{$header}'" ?>>
<div id="logo">
    <h1>OnlineOffice</h1>
</div>

<div class="informacion">

    <p> <?php echo 'Hola, <span>' . $_SESSION['usuario'] .'</span>' ?></p>

    <img id="abrirMenu" class="menu" src="/build/img/widgets_black_18dp.svg" alt="abrir el menú">

    <a href="/index.php/logout"> Salir</a>

    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="Cambiar la vista a modo oscuro o claro">
   
</div>
    
</header>


<?php
 echo $contenido;
 ?>

<footer class="container-fluid">
    <div>
        <h2>Sixen25@gmail.com</h2>
    </div>
    <div>
        <a class="boton-rojo" href="mailto:sixen25@gmail.com">¿Problemas de accesibilidad?</a>
    </div>
</footer>

<!--<script src="./build/js/bundle.min.js"></script>-->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 --><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script type="text/javascript" src="/build/js/bundle.min.js"></script>

<!--Framework alguna notificación/alerta https://sweetalert2.github.io/#examples-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>