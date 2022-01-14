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
    
    <!-- Características-->
    <section>

        <h2> Disfruta de todas estas características</h2>

        <div id="caracteristicas">        
            <div>
                <h3>Notas</h3>
                <img src="build/img/notas.jpg" alt="Imagen de una nota">
                <p>Crea notas y si quieres compártelas entre los miembros de tu equipo de trabajo para una comunicación más efectiva.</p>
                <button class="boton-login">Registro</button>
            </div>
            <div>
                <h3>Tareas</h3>
                <img src="build/img/tareas.jpg" alt="Imagen con una lista de tareas">
                <p>Organízate las tareas o organiza las de tu equipo para llevar a  tu empresa a otro nivel optimizando el tiempo.</p>
                <button class="boton-login"> Registro</button>
            </div>
            <div>
                <h3>GitHub</h3>
                <img src="build/img/github.png" alt="Logo de github">
                <p> Siéntete libre de participar el en proyecto, aportando nuevas funcionalidades, corrigiendo errores o participando en el foro. </p>
                <button class="boton-login"> repositorio</button>
            </div>
            <div>
                <h3>GPLv3</h3>
                <img src="build/img/GPLv3_Logo.svg.png" alt="Logo de la licencia GPLv3">
                <p>¿Quieres instalarlo en tu propio servidor? ¿Hacer las modificaciones que necesite tu empresa? Descarga el proyecto </p>
                <button class="boton-login"> Descarga</button>
            </div>


        </div>
    </section>