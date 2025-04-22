<?php
class ManageCustomerAccountsModel
{
    use Model;

    protected $table = "customer";
    protected $allowedColumns = ['customer_id', 'name', 'address', 'phone', 'image', 'user_id', 'status'];

    //get all customer accounts
    public function getAllCustomer($limit, $offset)
    {
        $query = "SELECT c.customer_id, c.name, c.address, c.phone,c.image, u.email, c.status
                  FROM customer c 
                  JOIN user u ON c.user_id = u.user_id order by customer_id  limit $limit offset $offset";
        return $this->query($query);
    }
    //customer pagination   
    public function getCustomersPaginated($limit, $offset)
    {
        try {
            $this->limit = $limit;
            $this->offset = $offset;
            return $this->getAllCustomer($limit, $offset);
        } catch (Exception $e) {
            error_log("Error fetching paginated customers: " . $e->getMessage());
            return false;
        }
    }

    public function getCustomersCount()
    {
        try {
            $query = "SELECT COUNT(*) as count FROM $this->table";
            $result = $this->query($query);
            return $result ? $result[0]->count : 0;
        } catch (Exception $e) {
            error_log("Error counting customers: " . $e->getMessage());
            return 0;
        }
    }


    //Getting single customer in the database by customer id
    public function findById($customer_id)
    {
        return $this->first(['customer_id' => $customer_id]);
    }

    //Add new customer
    public function addCustomer($data)
    {
        try {
            $this->insert($data);
            return true;
        } catch (Exception $e) {
            error_log("Error adding the customer: " . $e->getMessage());
            return false;
        }
    }

    //Update Existing customer
    public function updateCustomer($customer_id, $data)
    {
        try {
            $this->update($customer_id, $data, 'customer_id');
            return true;
        } catch (Exception $e) {
            error_log("Error updating customer: " . $e->getMessage());
            return false;
        }
    }

    //Delete customer (soft delete)
    public function DeleteCustomer($customer_id)
    {
        try {
            $query = 'UPDATE customer SET status = 0 WHERE customer_id = :customer_id;';
            $params = ['customer_id' => $customer_id];
            $this->query($query, $params);
            return true;
        } catch (Exception $e) {
            error_log("Error deleting customer: " . $e->getMessage());
            return false;
        }
    }

    //Restore customer
    public function RestoreCustomer($customer_id)
    {
        try {
            $query = 'UPDATE customer SET status = 1 WHERE customer_id = :customer_id;';
            $params = ['customer_id' => $customer_id];
            $this->query($query, $params);
            return true;
        } catch (Exception $e) {
            error_log("Error restoring customer: " . $e->getMessage());
            return false;
        }
    }
    //search customer
    public function searchCustomers($search, $limit, $offset)
    {
        $search = '%' . $search . '%';
        $limit = (int) $limit;
        $offset = (int) $offset;
        $query = "SELECT * FROM customer c 
                  JOIN user u ON c.user_id = u.user_id WHERE c.name LIKE :search OR u.email LIKE :search ORDER BY customer_id DESC LIMIT $limit OFFSET $offset";
        $params = [
            'search' => $search
        ];
        return $this->query($query, $params);
    }

    public function searchCustomersCount($search)
    {
        $search = '%' . $search . '%';
        $query = "SELECT COUNT(*) as count FROM customer c 
                  JOIN user u ON c.user_id = u.user_id WHERE c.name LIKE :search OR u.email LIKE :search";
        $params = ['search' => $search];
        $result = $this->query($query, $params);
        return $result ? $result[0]->count : 0;
    }
}
?>