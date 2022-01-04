    <div class="video">
        <div class="overlay">
        
        <div class="menu-login">
            
            <div class="contenedor contenido-video">
                <div class='izquierda'>
                <img class="dark-mode-boton" src="./build/img/dark-mode.svg">
                </div>
                <h2>OnlineOffice</h2>
                <p>Todas tus herramientas en un solo lugar</p>

                <?php
                    foreach($alertas as $key => $mensajes):
                        foreach($mensajes as $mensaje):
                ?>
                    <div class="alerta <?php echo $key; ?>">
                        <?php echo $mensaje; ?>
                    </div>
                <?php
                        endforeach;
                    endforeach;
                ?>
 
            </div>
            <div class="contenedor formulario-video">
                
            <form class="formulario" action="./" method="post">
                <label for="email">Correo</label>
                <input type="email" name="email" id="email" value="<?php echo $correo ?? ''; ?>">       

                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password">
                
                <div class="center"> 
                <input class="boton-login" type="submit" value="Entrar">
                </div>

            </form>
            </div>
        </div>



        </div>
        <video autoplay muted loop>
            <source src="./build/video/video.mp4" type="video/mp4">
            <source src="./build/video/video.ogg" type="video/ogg">
            <source src="./build/video/video.webm" type="video/webm">
        </video>
    </div>

