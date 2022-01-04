<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

/**
 * Debugear variable
 */
function d($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

/**
 * Escapa / Sanitizar el HTML
 */
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}