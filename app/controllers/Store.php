<?php

/**
 * store class
 */

class Store
{
    use Controller;
    public function index()
    {
        $productModel = new CustomerProducts();


        $products = $productModel->getActiveProducts();

        // Prepare data for the view
        $data = [
            'products' => $products
        ];

        $this->view('customer/store', $data);
    }
}
