<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Controller_Index extends Controller_Base
{

    public function action_index()
    {
        if ( ! Request::factory()->getCmd() )
        {
            Request::factory()->setCmd('INFO');
        }

        $data = array(
            'content'   => $this->executeCommand(),
            'currentdb' => Request::factory()->getDb(),
            'cmd'       => Request::factory()->getCmd(),
            'dbkeys'    => Helper_Info::getCountKeysInDb(),
        );

        if ( Request::factory()->getAjax() )
        {
            header('Content-Type: application/json');
            echo json_encode( $data );
        }
        else
        {
            echo View::factory('layout', $data);
        }
    }

    private function executeCommand()
    {
        if ( $pos = strpos( Request::factory()->getCmd(), ' ') )
        {
            $method = substr( Request::factory()->getCmd(), 0, $pos );
            $args   = substr( Request::factory()->getCmd(), $pos + 1 );
        }
        else
        {
            $method = Request::factory()->getCmd();
            $args   = array();
        }

        $command    = new Controller_Command();

        if ( method_exists( $command, $method ) )
        {
            History::write( 'admin', Request::factory()->getCmd() );
            return call_user_func( array( $command,  $method ) , $args );
        }
        else
        {
            return View::factory('tables/404');
        }
    }

    /**
     * @FIXME
     * @return void
     */
    public function action_help()
    {
        $data = array(
            'content'   => View::factory('help'),
            'currentdb' => 0,
        );
        echo View::factory('layout', $data);
    }

    public function action_logout()
    {
        Helper_Auth::logout();
    }

    public function action_bookmark_add( $key )
    {

    }

    public function action_bookmark_del( $key )
    {

    }
}
