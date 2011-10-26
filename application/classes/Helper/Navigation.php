<?php
/**
 *
 * @author      Max Kamashev <max.kamashev@gmail.com>
 * @copyright   Копирайт: © Zarium, 2011
 */
class Helper_Navigation
{

    public static function goBack( Controller_Base $controller, $defaultAction = null, $defaultParams = array() )
    {
        $back = filter_input( INPUT_GET, 'back', FILTER_SANITIZE_STRING );

        if ( $back )
        {
            $args = explode(' ', $back);
            $action = array_shift( $args );

            if ( method_exists( $controller, $action ) )
            {
                Request::factory()->setCmd( $back );

                $cmd = explode(' ', Request::factory()->getCmd());

                $method     = array_shift( $cmd );

                if ( method_exists( $controller, $method ) )
                {
                    return call_user_func_array( array( $controller,  $method ) , $cmd );
                }
                else
                {
                    return View::factory('tables/404');
                }
            }
        }

        if ( ! $defaultAction || ! method_exists($controller, $defaultAction) )
        {
            return call_user_func_array(array( $controller, $defaultAction ), (array) $defaultParams);
        }
        else
        {
            return $controller->info();
        }
    }
}
