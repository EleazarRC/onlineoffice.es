<div class="video">

    <div class="overlay">
        
        <div class="menu-login">

            <div class="contenedor contenido-video">
                
                <div class='izquierda'>
                    <img class="dark-mode-boton" src="./build/img/dark-mode.svg" alt="Cambiar la vista a modo oscuro o claro">
                </div>

                <h2>OnlineOffice</h2>
                <p>Optimiza el trabajo de tu oficina solo o en equipo.</p>

                <?php
                include_once __DIR__ . '../../templates/alertas.php';
                ?>

            </div>


            <!-- Zona de registro -->
            <div class="contenedor formulario-video">
                <form class="formulario" action="./" method="post">
                    <label for="email">Correo</label>
                    <input type="email" name="email" id="email" value="<?php echo $correo ?? ''; ?>">

                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password">

                    <div id="btns-login">
                    <input  class="boton-login" type="submit" value="Entrar">
                    <input formaction="./registro" class="boton-login" type="submit" value="Regístrate">                    </div>
                        
                </form>
                    <p id="recuperar"><a href="./recuperar">¿Has olvidado  tu contraseña?</a></p>

            </div>
            <!-- Fin Zona Registro -->



        </div>

        </div>
        <video autoplay muted loop>
            <source src="./build/video/video.mp4" type="video/mp4">
            <source src="./build/video/video.ogg" type="video/ogg">
            <source src="./build/video/video.webm" type="video/webm">
        </video>
    </div>

