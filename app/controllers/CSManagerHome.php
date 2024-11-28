<?php

/**
 * custom service manager home class
 */

class CSManagerHome
{
    use Controller;
    public function index()
    {
        $this->view('customerServiceManager/cSManagerHome');
    }
}
