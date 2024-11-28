<?php

/**
 * service class
 */

class Service
{
    use Controller;
    public function index()
    {
        $this->view('customer/service');
    }
}
