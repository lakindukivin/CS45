<?php


class CustomerProducts
{

    use Model;

    protected $table = 'product';
    protected $allowedColumns = ['product_id', 'productType', 'productName', 'productImage', 'productDescription', 'productStatus'];

    public function getActiveProducts()
    {
        $query = "SELECT * FROM $this->table WHERE productStatus = 1";
        return $this->query($query);
    }
}
