<?php
class ManageCustomerAccountsModel
{
    use Model;

    protected $table = "customer";
    protected $allowedColumns = ['customer_id', 'name', 'address', 'phone', 'email', 'status'];

    //get all customer accounts
    public function getAllCustomer()
    {
        $query = "SELECT s.customer_id,s.name,s.address,s.phone,r.role,u.email,s.status
                  FROM customer s JOIN user u ON  s.user_id=u.user_id";
        return $this->query($query);
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
            error_log("Error adding the person: " . $e->getMessage());
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

    //Delete customer
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
}
?>