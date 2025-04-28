<?php

/**
 * order class
 */

class PelletOrderList
{
    use Controller;
    public function index()
    {
        $this->view('customer/pelletOrderList');
    }
}
