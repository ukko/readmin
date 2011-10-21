<?php
/**
 *
 */
class Controller_Index extends Controller_Base
{

    public function action_index()
    {
        $data = array(
            'content'   => $this->request->getCmd() ? $this->executeCommand()  : $this->action_info(),
            'currentdb' => $this->request->getDb(),
            'cmd'       => $this->request->getCmd(),
            'dbkeys'    => Helper_Info::getCountKeysInDb(),
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
