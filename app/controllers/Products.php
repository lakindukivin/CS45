<?php

/**
 * sales manager home class
 */

class Products
{
    use Controller;
    public function index()
    {
        $this->view('salesManager/products');
    }
}
