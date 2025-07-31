<?php
require_once '../app/core/autoload.php';

// Obtener y sanitizar la URL
$url = isset($_GET['url']) ? $_GET['url'] : '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$urlParts = explode('/', $url);

// Determinar controlador y método
$controllerName = !empty($urlParts[0]) ? ucfirst($urlParts[0]) . 'Controller' : 'MenuController';
$method = $urlParts[1] ?? 'index';
$params = array_slice($urlParts, 2);

$controllerPath = "../app/controllers/$controllerName.php";

// Cargar controlador y método, o mostrar vista 404
if (file_exists($controllerPath)) {
    require_once $controllerPath;
    $controller = new $controllerName();

    if (method_exists($controller, $method)) {
        call_user_func_array([$controller, $method], $params);
    } else {
        require_once '../app/views/404.php';
    }
} else {
    require_once '../app/views/404.php';
}
