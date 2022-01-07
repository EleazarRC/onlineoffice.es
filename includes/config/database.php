<?php 

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'root', 'onlineoffice');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}
