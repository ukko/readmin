<?php
/**
 *
 */
class Controller_Index extends Controller_Base
{

    public function action_index()
    {
        $data = array(
            'content'   => Request::factory()->getCmd() ? $this->executeCommand()  : $this->action_info(),
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
        $cmd = explode(' ', Request::factory()->getCmd());

        $command    = new Controller_Command();
        $method     = array_shift( $cmd );

        if ( method_exists( $command, $method ) )
        {
            History::write( 'admin', Request::factory()->getCmd() );
            return call_user_func_array( array( $command,  $method ) , $cmd );
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

    /**
     * @FIXME
     * @return void
     */
    public function action_info()
    {
        $info = R::factory()->info();
        return View::factory('tables/info', array('items' => $info));
    }

    public function action_bookmark_add( $key )
    {

    }

    public function action_bookmark_del( $key )
    {

    }
}
