<?php
require_once 'database.php';

class Product
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function getAllProducts()
    {
        $query = "SELECT * FROM product WHERE is_deleted = 0";
        $result = $this->db->query($query);

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }

    public function addProduct($data)
    {
        $query = "INSERT INTO product (product_name, product_img, product_price, product_description, product_pack_size, product_bag_size)
              VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "ssisss",
            $data['productName'],
            $data['productImg'], // Use the resolved image name
            $data['productPrice'],
            $data['description'],
            $data['packSize'],
            $data['bagSize']
        );

        return $stmt->execute();
    }


    public function deleteProduct($id)
    {
        $query = "UPDATE product SET is_deleted = 1 WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function updateProduct($data)
    {
        $query = "UPDATE product SET 
          product_name = ?, 
          product_img = ?, 
          product_price = ?, 
          product_description = ?, 
          product_pack_size = ?, 
          product_bag_size = ?
          WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "ssisssi",
            $data['product_name'],
            $data['product_img'], // Use the resolved image name
            $data['product_price'],
            $data['description'],
            $data['pack_size'],
            $data['bag_size'],
            $data['product_id']
        );

        return $stmt->execute();
    }

    public function getProductById($product_id)
    {
        // Query to fetch the product details by product_id
        $query = "SELECT * FROM product WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $product_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null;
            }
        }
        return null;
    }
}
?>