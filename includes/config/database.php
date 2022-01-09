<?php 

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'root', 'onlineoffice');
    //$db = new mysqli('localhost', 'root', 'root', 'dbs5134450');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}
