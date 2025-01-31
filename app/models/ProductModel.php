<?php
class ProductModel
{
    use Model;

    protected $table = "product";
    protected $allowedColumns = ['product_id', 'productName', 'producrImage', 'productPrice', 'productDescription', 'productPackSize', 'productBagSize', 'productStatus'];

    public function getAllProducts()
    {
        try {
            return $this->findAll();
        } catch (Exception $e) {
            error_log("Error fetching products: " . $e->getMessage());
            return false;
        }


    }
}
?>