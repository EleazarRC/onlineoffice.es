<?php 

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'root', 'onlineoffice');
    //$db = new mysqli('db5006137245.hosting-data.io', 'dbu1143391', 'Office-2021-Admin', 'dbs5134450');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}