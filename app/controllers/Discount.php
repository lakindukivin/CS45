<?php

/**
 * sales manager home class
 */

class Discount
{
    use Controller;
    public function index()
    {
        $this->view('salesManager/discount');
    }
}
