<?php

/**
 * sales manager home class
 */

class SalesManagerHome
{
    use Controller;
    public function index()
    {
        $this->view('salesManager/salesManagerHome');
    }
}
