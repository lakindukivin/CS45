<?php

/**
 * production Manager home class
 */

class ProductionManagerHome
{
    use Controller;
    public function index()
    {
        $this->view('productionManager/productionManagerHome');
    }
}
