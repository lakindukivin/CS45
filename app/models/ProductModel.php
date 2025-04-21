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


    public function getProductsPaginated($limit, $offset)
    {
        try {
            $this->limit = $limit;
            $this->offset = $offset;
            return $this->findAll('product_id');
        } catch (Exception $e) {
            error_log("Error fetching paginated products: " . $e->getMessage());
            return false;
        }
    }

    public function getProductsCount()
    {
        try {
            $query = "SELECT COUNT(*) as count FROM $this->table";
            $result = $this->query($query);
            return $result ? $result[0]->count : 0;
        } catch (Exception $e) {
            error_log("Error counting products: " . $e->getMessage());
            return 0;
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

    public function searchProducts($search, $limit, $offset)
    {
        $search = '%' . $search . '%';
        $limit = (int) $limit;
        $offset = (int) $offset;
        $query = "SELECT * FROM $this->table WHERE productName LIKE :search OR productDescription LIKE :search ORDER BY product_id DESC LIMIT $limit OFFSET $offset";
        $params = [
            'search' => $search
        ];
        return $this->query($query, $params);
    }

    public function searchProductsCount($search)
    {
        $search = '%' . $search . '%';
        $query = "SELECT COUNT(*) as count FROM $this->table WHERE productName LIKE :search OR productDescription LIKE :search";
        $params = ['search' => $search];
        $result = $this->query($query, $params);
        return $result ? $result[0]->count : 0;
    }

}
?>