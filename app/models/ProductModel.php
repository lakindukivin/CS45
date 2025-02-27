<?php
class ProductModel
{
    use Model;

    protected $table = "product";
    protected $allowedColumns = ['product_id', 'productName', 'productImage', 'productPrice', 'productDescription', 'productPackSize', 'productBagSize', 'productStatus'];

    public function getAllProducts()
    {
        // try {
            // return $this->findAll();
        // } catch (Exception $e) {
        
        //     error_log("Error fetching products: " . $e->getMessage());
        //     return false;
        // }

        $query = "SELECT * FROM product";
        return $this->query($query);


    }

    public function findById($productId)
    {
        // Assuming your model has a 'first' method from a trait
        // that gets a single record matching the criteria
        return $this->first(['product_id' => $productId]);
    }
}
?>