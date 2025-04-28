<?php

class DiscountModel
{
    use Model;

    protected $table = 'discount';
    protected $allowedColumns = ['discount_id', 'product_id', 'discount_percentage', 'start_date', 'end_date', 'status'];

    public function getDiscountWithProduct($limit, $offset)
    {
        // Fixed SQL query with proper table aliases and selected columns
        $query = "SELECT d.discount_id, p.product_id, p.productName, d.discount_percentage, d.start_date, d.end_date, d.status 
                 FROM discount d 
                 JOIN product p ON d.product_id = p.product_id order by discount_id DESC limit $limit offset $offset";
        return $this->query($query);
    }

    public function getDiscountsPaginated($limit, $offset)
    {
        try {
            $this->limit = $limit;
            $this->offset = $offset;
            return $this->getDiscountWithProduct($limit, $offset);
        } catch (Exception $e) {
            error_log("Error fetching paginated discounts: " . $e->getMessage());
            return false;
        }
    }



    public function getDiscountsCount()
    {
        try {
            $query = "SELECT COUNT(*) as count FROM $this->table";
            $result = $this->query($query);
            return $result ? $result[0]->count : 0;
        } catch (Exception $e) {
            error_log("Error counting discounts: " . $e->getMessage());
            return 0;
        }
    }



    public function searchDiscount($search, $limit, $offset)
    {
        $search = '%' . $search . '%';
        $limit = (int) $limit;
        $offset = (int) $offset;
        $query = "SELECT * FROM discount d 
                 JOIN product p ON d.product_id = p.product_id WHERE p.productName LIKE :search OR d.start_date LIKE :search OR d.end_date LIKE :search ORDER BY discount_id DESC LIMIT $limit OFFSET $offset";
        $params = [
            'search' => $search
        ];
        return $this->query($query, $params);
    }

    public function searchDiscountCount($search)
    {
        $search = '%' . $search . '%';
        $query = "SELECT COUNT(*) as count FROM discount d 
                 JOIN product p ON d.product_id = p.product_id WHERE p.productName LIKE :search OR d.start_date LIKE :search OR d.end_date LIKE :search";
        $params = ['search' => $search];
        $result = $this->query($query, $params);
        return $result ? $result[0]->count : 0;
    }

    //get single product

    public function findById($discount_id)
    {
        return $this->first(['discount_id' => $discount_id]);

    }
    // add new discount

    public function addDiscount($data)
    {
        try {
            $this->insert($data);
            return true;
        } catch (Exception $e) {
            error_log("Error adding ad/banner: " . $e->getMessage());
            return false;
        }
    }

    // update discount
    public function updateDiscount($discount_id, $data)
    {
        try {
            $this->update($discount_id, $data, 'discount_id');
            return true;
        } catch (Exception $e) {
            error_log("Error updating discount: " . $e->getMessage());
            return false;
        }
    }

    //Delete customer (soft delete)
    public function delete($id)
    {
        try {
            $query = 'UPDATE discount SET status = 0 WHERE discount_id = :id;';
            $params = ['id' => $id];
            $this->query($query, $params);
            return true;
        } catch (Exception $e) {
            error_log("Error deleting customer: " . $e->getMessage());
            return false;
        }
    }

    //Restore customer
    public function restore($id)
    {
        try {
            $query = 'UPDATE discount SET status = 1 WHERE discount_id = :id;';
            $params = ['id' => $id];
            $this->query($query, $params);
            return true;
        } catch (Exception $e) {
            error_log("Error restoring customer: " . $e->getMessage());
            return false;
        }
    }


    //toggle status 
    public function setActive($id)
    {
        try {
            $query = 'UPDATE discount SET status =1 WHERE discount_id = :id;';
            $params = ['id' => $id];
            $this->query($query, $params);
            return true;

        } catch (Exception $e) {
            error_log("Error changing status: " . $e->getMessage());
            return false;
        }


    }

    public function setInactive($id)
    {
        try {
            $query = 'UPDATE discount SET status =0 WHERE discount_id = :id;';
            $params = ['id' => $id];
            $this->query($query, $params);
            return true;

        } catch (Exception $e) {
            error_log("Error changing status: " . $e->getMessage());
            return false;
        }

    }

    // New method to automatically update expired discounts
    public function updateExpiredDiscounts()
    {
        try {
            $query = 'UPDATE discount SET status = 0 WHERE end_date < CURDATE() AND status = 1';
            $this->query($query);
            return true;
        } catch (Exception $e) {
            error_log("Error updating expired discounts: " . $e->getMessage());
            return false;
        }
    }

}

