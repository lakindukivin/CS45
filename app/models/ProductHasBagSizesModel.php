<?php
class ProductHasBagSizesModel
{
    use Model;

    protected $table = "product_has_bag_sizes";
    protected $allowedColumns = ['product_id', 'bag_id', 'weight', 'price'];


    public function getAllProductHasBagSizes()
    {
        try {
            $query = "SELECT p.productName, b.bag_size,pb.product_id,pb.bag_id, pb.weight, pb.price FROM product_has_bag_sizes pb JOIN bag_size b ON b.bag_id=pb.bag_id JOIN product p ON p.product_id=pb.product_id ORDER BY pb.product_id,pb.bag_id";
            return $this->query($query);
        } catch (Exception $e) {
            error_log("Error fetching all product bag sizes: " . $e->getMessage());
            return [];
        }
    }

    public function addSize($data)
    {
        try {
            $this->insert($data);
            return true;
        } catch (Exception $e) {
            error_log("Error adding price and weight: " . $e->getMessage());
            return false;
        }
    }

    public function updateSize($product_id, $bag_id, $weight, $price)
    {
        try {
            $query = "UPDATE $this->table SET price = $price, weight = $weight WHERE (product_id = $product_id AND bag_id = $bag_id)";
            $params = [
                'product_id' => $product_id,
                'bag_id' => $bag_id,
                'price' => $price,
                'weight' => $weight
            ];
            $this->query($query, $params);
            return true;
        } catch (Exception $e) {
            error_log("Error updating price and weight: " . $e->getMessage());
            return false;
        }
    }

    public function deleteSize($product_id, $bag_id)
    {
        try {
            $query = "DELETE FROM $this->table WHERE (product_id = :product_id AND bag_id = :bag_id)";
            $params = [
                'product_id' => $product_id,
                'bag_id' => $bag_id
            ];
            $this->query($query, $params);
            return true;
        } catch (Exception $e) {
            error_log("Error deleting size: " . $e->getMessage());
            return false;
        }
    }

    public function getAllBagSizes()
    {
        try {
            $query = "SELECT * FROM $this->table ORDER BY product_id, bag_id";
            return $this->query($query);
        } catch (Exception $e) {
            error_log("Error fetching all bag sizes: " . $e->getMessage());
            return [];
        }
    }


    public function findById($id)
    {
        try {
            $query = 'SELECT * FROM product_has_bag_sizes  WHERE product_id=:id;';
            $params = ['id' => $id];
            return $this->query($query, $params);

        } catch (Exception $e) {
            error_log("Error geting results: " . $e->getMessage());
            return false;
        }
    }

}