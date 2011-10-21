<?php
/**
 *
 */
class Controller_Index extends Controller_Base
{

    public function action_index()
    {
        $this->getDbKeys();

        $data = array(
            'content'   => isset( $_GET['cmd'] ) ? $this->executeCommand()  : $this->action_info(),
            'currentdb' => isset( $_GET['db']  ) ? (int) $_GET['db']        : Config::get('re_db'),
            'cmd'       => isset( $_GET['cmd'] ) ? $_GET['cmd']             : '',
            'dbkeys'    => $this->getDbKeys(),
        );

        echo View::factory('layout', $data);
    }

    private function executeCommand()
    {
        $cmd = new Controller_Command();
        return $cmd->action_index();
    }

    private function getDbKeys()
    {
        $dbkeys = array();
        foreach (R::factory()->info() as $key => $value )
        {
            if (substr($key, 0, 2) == 'db' && ctype_digit( substr($key, 2) ) )
            {
                $str                            = explode(',', $value );
                $str                            = explode('=', $str[0]);
                $dbkeys[ (int)substr($key, 2) ] = $str[1];
            }

        }
        return $dbkeys;
    }

    public function action_help()
    {
        $data = array(
            'content'   => View::factory('help'),
            'currentdb' => 0,
        );
        echo View::factory('layout', $data);
    }

    public function action_info()
    {
        $info = R::factory()->info();
        return View::factory('tables/info', array('items' => $info));
    }
}
