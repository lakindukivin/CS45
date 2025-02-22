<?php

/**
 * completed order class
 */

class CompletedOrders
{
    use Controller;
    public function index()
    {
        $this->view('customerServiceManager/completed_orders');
    }
}
