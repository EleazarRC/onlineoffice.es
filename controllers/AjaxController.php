<?php

namespace Controllers;

// Como LA PAGINA NO SE RECARGA AL LLAMAR A AJAX NO HAY
// QUE PASAR EL ROUTE :->
//use MVC\Router;
use Model\Usuarios;
use Controllers\PaginasController;

class AjaxController
{

    public static function paginacion()
    {

        if (PaginasController::comprobarLogin()) {
    
            // Controlamos los datos recibidos para paginar
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            if ($page < 1) {
                $page = 1;
            }

            $records_by_page = isset($_GET['amount_show']) ? (int) $_GET['amount_show'] : 5;
            if ($records_by_page < 5) {
                $records_by_page = 5;
            }

        
            $limit_from = ($page - 1) * $records_by_page;

            // Inicializamos el arreglo de respuesta.
            $response = [
                'records' => [],
                'current_page' => $page,
                'records_by_page' => $records_by_page,
                'total_records' => 0,
            ];

            

            $usuarios = new Usuarios();
            // Obtenemos el total de registros
            $info = $usuarios->obtenerInfoUsuarios();

            $response['total_records'] = count($info);

            // Obtenemos los registros para la "pagina actual"
            if($_GET['email'] != ''){

                $nombre = "'%".$_GET['email']."%'";
         
                //En modo búsqueda lo mostraré todo en la misma página
                $resultado = $usuarios->paginadoByEmail($records_by_page , $limit_from, $nombre);

                $json = array('resultados' => $resultado);

        
                $response['records'] = $json;
                

                // Imprimimos la respuesta
                header('Content-Type: application/json');
                echo json_encode($response);


            } else {
                
                $resultado = $usuarios->paginado($records_by_page , $limit_from);

                $json = array('resultados' => $resultado);

        
                $response['records'] = $json;
                

                // Imprimimos la respuesta
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        }
    }

    /*
    public static function paginacion()
    {

    if (PaginasController::comprobarLogin()) {

    $json = [];

    // Obtenemos la página solicitada, si no se envía es la 1
    if (isset($_GET['pagina'])) {
    $paginaSolicitada = $_GET['pagina'];
    } else {
    $paginaSolicitada = 1;
    }

    if($paginaSolicitada < 0) {
    $paginaSolicitada = 1;
    }

    // Definimos el número usuarios a mostrar por página
    define('USUARIOS_POR_PAGINA', 5);

    // Iniciamos instancia de usuarios
    $usuarios = new Usuarios();

    // Pedimos todos los usuarios
    $resultado = $usuarios->all();

    // Los contamos
    $count = count($resultado);

    // Dividimos para obtener el número de páginas
    $paginas = ceil($count / USUARIOS_POR_PAGINA);

    // Esto es el offset, que se usa para saltar X páginas
    // dependiendo de en la página que estemos y los
    // usuarios por página y se obtiene por esta formula
    $offset = ($paginaSolicitada - 1) * USUARIOS_POR_PAGINA;

    $resultado = $usuarios->paginado(USUARIOS_POR_PAGINA, $offset);

    $json = array('resultados' => $resultado, 'paginasTotales' => $paginas);

    echo json_encode($json);

    }
    }   */

    public static function contactos()
    {
        if (PaginasController::comprobarLogin()) {

        }
    }
}
