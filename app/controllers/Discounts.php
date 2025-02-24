<?php

/**
 * sales manager home class
 */

class Discounts
{
    use Controller;
    public function index()
    {
        $this->view('salesManager/discounts');
    }
}
