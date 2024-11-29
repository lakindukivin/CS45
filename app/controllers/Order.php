<?php

/**
 * order class
 */

class Order
{
    use Controller;
    public function index()
    {
        $this->view('customer/order');
    }
}
