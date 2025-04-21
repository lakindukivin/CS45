<?php
class ProductModel
{
    use Model;

    protected $table = "product";
    protected $allowedColumns = ['product_id', 'productName', 'productImage', 'productDescription', 'productStatus'];

    //Getting all the products in the database
    public function getAllProducts()
    {
        try {
            return $this->findAll('product_id');
        } catch (Exception $e) {
            error_log("Error fetching products: " . $e->getMessage());
            return false;
        }
    }

    //Getting single product in the database by category id
    public function findById($productId)
    {
        return $this->first(['product_id' => $productId]);
    }

    //Add new product 
    public function addNewProduct($data)
    {
        try {
            $this->insert($data);
            return true;


        } catch (Exception $e) {
            error_log("Error adding products: " . $e->getMessage());
            return false;
        }
    }

    //Update Existing product
    public function updateProduct($id, $data)
    {
        try {
            $this->update($id, $data, 'product_id');
            return true;
        } catch (Exception $e) {
            error_log("Error adding products: " . $e->getMessage());
            return false;
        }
    }

    //Delete product
    public function DeleteProduct($product_id)
    {

        try {
            $query = 'UPDATE product SET productStatus =0 WHERE product_id = :product_id;';
            $params = ['product_id' => $product_id];
         $this->query($query, $params);
         return true;

        } catch (Exception $e) {
            error_log("Error adding products: " . $e->getMessage());
            return false;
        }
    }


    public function RestoreProduct($product_id)
    {

        try {
            $query = 'UPDATE product SET productStatus =1 WHERE product_id = :product_id;';
            $params = ['product_id' => $product_id];
            $this->query($query, $params);
            return true;

        } catch (Exception $e) {
            error_log("Error adding products: " . $e->getMessage());
            return false;
        }
    }

}
?>