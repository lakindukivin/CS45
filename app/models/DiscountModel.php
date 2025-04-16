<?php

class DiscountModel
{
    use Model;

    protected $table = 'discount';
    protected $allowedColumns = ['Discount_id', 'ProductName', 'discountPercentage', 'start_date', 'end_date'];

    public function getDiscountWithProduct()
    {
        // Fixed SQL query with proper table aliases and selected columns
        $query = "SELECT d.Discount_id, p.productName, d.discountPercentage, d.start_date, d.end_date 
                 FROM discount d 
                 JOIN product p ON d.Product_id = p.Product_id";
        return $this->query($query);
    }
    //get single product

    public function findById($Discount_id)
    {
        return $this->first(['discount_id' => $Discount_id]);

    }

    // // Get discounts by product ID
    // public function getDiscountsByProductId($productId)
    // {
    //     $query = "SELECT * FROM discount  WHERE product_id = :product_id";
    //     $params = ['product_id' => $productId];
    //     return $this->query($query, $params);
    // }

     

    // add new discount

    public function addDiscount($data)
    {
       try {  
        $this->insert($data);
        return true;}
        catch (Exception $e){
            error_log("Error adding ad/banner: " . $e->getMessage());
            return false;
        }
    }

   

    // // edit existing discount
    // public function editDiscount($id, $data, $id_column = 'discount_id')
    // {
    //     // Ensure only allowed columns are updated
    //     if (!empty($this->allowedColumns)) {
    //         $data = array_intersect_key($data, array_flip($this->allowedColumns));
    //     }
    //     //save the edited data
    //     return $this->update($id, $data, $id_column);
    // }

    // //delete exisiting discount
    // public function deleteDiscount($id, $id_column = 'discount_id')
    // {
    //     return $this->delete($id, $id_column);

    // }
}

