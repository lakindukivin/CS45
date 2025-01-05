<?php

/**
 * order class
 */

class PendingCustomOrder
{
    use Controller;
    public function index()
    {
        $this->view('productionManager/pending_custom_orders');
    }
}
