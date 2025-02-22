<?php

/**
 * sales manager home class
 */

class Product
{
    use Controller;
    public function index()
    {
        $this->view('salesManager/product');
    }
}
