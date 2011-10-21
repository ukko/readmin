<?php
class Controller_Base
{
    /**
     * @var Request
     */
    protected $request = null;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function getRequest( $param = null )
    {
        return $this->request;
    }
}
