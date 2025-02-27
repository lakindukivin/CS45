<?php

/**
 * sales manager home class
 */

class Products
{
    use Controller;

    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }



    public function index()
    {
        $products = $this->productModel->getAllProducts();

        $this->view('salesManager/products',[
            'products' => $products,]);
    }
}
