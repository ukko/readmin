<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class ExceptionView extends Exception {}
class ExceptionRouter extends Exception {}

function exception_handler( Exception $e )
{
    echo View::factory('exception', array('exception' => $e));
}
