<?php
/**
 *
 */
class Controller_Index extends Controller_Base
{

    public function action_index()
    {
        $data = array(
            'content'   => isset( $_GET['cmd'] ) ? $this->executeCommand()  : $this->action_info(),
            'currentdb' => isset( $_GET['db']  ) ? (int) $_GET['db']        : Config::get('re_db'),
            'cmd'       => isset( $_GET['cmd'] ) ? $_GET['cmd']             : '',
        );
        echo View::factory('layout', $data);
    }

    private function executeCommand()
    {
        $cmd = new Controller_Command();
        return $cmd->action_index();
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
