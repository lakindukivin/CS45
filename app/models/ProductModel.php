<?php
class ProductModel
{
    use Model;

    protected $table = "product";
    protected $allowedColumns = ['Product_id', 'productName', 'productImage', 'productPrice', 'productDescription', 'productStatus'];

    //Getting all the products in the database
    public function getAllProducts()
    {
        try {
            return $this->findAll('Product_id');
        } catch (Exception $e) {
            error_log("Error fetching products: " . $e->getMessage());
            return false;
        }
    }

    //Getting single product in the database by category id
    public function findById($productId)
    {
        return $this->first(['Product_id' => $productId]);
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
            $this->update($id, $data, 'Product_id');
            return true;
        } catch (Exception $e) {
            error_log("Error adding products: " . $e->getMessage());
            return false;
        }
    }

    //Delete product
    public function DeleteProduct($Product_id)
    {

        try {
            $query = 'UPDATE product SET productStatus =0 WHERE Product_id = :Product_id;';
            $params = ['Product_id' => $Product_id];
         $this->query($query, $params);
         return true;

        } catch (Exception $e) {
            error_log("Error adding products: " . $e->getMessage());
            return false;
        }
    }


    public function RestoreProduct($Product_id)
    {

        try {
            $query = 'UPDATE product SET productStatus =1 WHERE Product_id = :Product_id;';
            $params = ['Product_id' => $Product_id];
            $this->query($query, $params);
            return true;

        } catch (Exception $e) {
            error_log("Error adding products: " . $e->getMessage());
            return false;
        }
    }

}
?>