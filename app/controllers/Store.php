<?php

/**
 * store class
 */

class Store
{
    use Controller;
    public function index()
    {
        $this->view('customer/store');
    }
}
