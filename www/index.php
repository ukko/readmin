<?php
/**
 *
 */
error_reporting(E_ALL);
define('APPPATH', dirname(__DIR__) . '/application');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = substr($uri, 1);

$controller = ucfirst(strstr($uri, '/', true));
$controller = 'Controller_' . ($controller ? $controller : 'Index');
$method     = str_replace('/', '', substr(strstr($uri, '/', false), 1));
$method     = 'action_' . ($method ? $method : 'index');

if (method_exists($controller, $method)) {
    call_user_func_array(array(new $controller, $method), array());
} else {
    die('uri not valide');
}

function __autoload($className)
{
    $path = str_replace('_', '/', strtolower($className)) . '.php';
    if (file_exists(APPPATH . '/classes/' . $path)) {
        require_once APPPATH . '/classes/' . $path;
    }
}

