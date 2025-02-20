<?php

/**
 * completed order class
 */

class CompletedOrders
{
    use Controller;
    public function index()
    {
        $this->view('productionManager/completed_orders');
    }
}
