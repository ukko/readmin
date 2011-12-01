<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Helper_Navigation
{

    public static function goBack( Controller_Base $controller, $defaultAction = null, $defaultParams = array() )
    {
        $back = Request::factory()->getBack();
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

        if ( method_exists($controller, $defaultAction) )
        {
            return call_user_func_array(array( $controller, $defaultAction ), (array) $defaultParams);
        }
        else
        {
            return $controller->info();
        }
    }
}
