<?php
/**
 * Entry point
 */
error_reporting(E_ALL);
define('APPPATH', dirname(__DIR__) . '/application');

require_once APPPATH . '/classes/Exceptions.php';

$uri = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$uri = substr($uri, 1);

$controller = ucfirst(strstr($uri, '/', true));
$controller = 'Controller_' . ($controller ? $controller : 'Index');
$method     = str_replace('/', '', substr(strstr($uri, '/', false), 1));
$method     = 'action_' . ($method ? $method : 'index');

if ( method_exists( $controller, $method ) )
{
    call_user_func_array( array( new $controller, $method ), array() );
}
else
{
    throw new ExceptionRouter('Not a valid URL : ' . $uri);
}

function __autoload($className)
{
    $path = str_replace('_', '/', $className) . '.php';

    if ( file_exists(APPPATH . '/classes/' . $path) )
    {
        require_once APPPATH . '/classes/' . $path;
    }
}

