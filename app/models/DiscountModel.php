<?php

class DiscountModel
{
    use Model;

    protected $table = 'discount';
    protected $allowedColumns = ['Discount_id', 'productName', 'productPrice', 'discount_percentage', 'start_date', 'end_date'];

    public function getDiscountWithProduct()
    {
        // Fixed SQL query with proper table aliases and selected columns
        $query = "SELECT d.Discount_id, p.productName, p.productPrice, d.discount_percentage, d.start_date, d.end_date 
                 FROM discount d 
                 JOIN product p ON d.Product_id = p.Product_id";
        return $this->query($query);
    }
    //get single product

    public function getSingleDiscountedProduct($Discount_id)
    {
        return $this->first(['Discount_id' => $Discount_id]);

    }

// add new discount

    public function addDiscount($data)
    {
        return $this->insert($data);
    }

// edit existing discount
    public function editDiscount($id, $data, $id_column = 'Discount_id')
    {
        // Ensure only allowed columns are updated
        if (!empty($this->allowedColumns)) {
            $data = array_intersect_key($data, array_flip($this->allowedColumns));
        }
        //save the edited data
        return $this->update($id, $data, $id_column);
    }

//delete exisiting discount
    public function deleteDiscount($id, $id_column = 'Discount_id')
    {
        return $this->delete($id, $id_column);

    }
}

