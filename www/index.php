<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
error_reporting(E_ALL);
define('APPPATH', dirname(__DIR__) . '/application');

require_once APPPATH . '/classes/Exceptions.php';

/**
 * @TODO SPL::__autoload
 * @param $className
 */
function __autoload($className)
{
    $path = str_replace('_', '/', $className) . '.php';

    if ( file_exists(APPPATH . '/classes/' . $path) )
    {
        require_once APPPATH . '/classes/' . $path;
    }
}

if ( ! R::factory()->ping() )
{
    throw new RedisException('Redis has not connect ' . Config::get('host') . ':' . Config::get('port'));
}

$uri = parse_url( Request::factory()->getUrl(), PHP_URL_PATH );
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
