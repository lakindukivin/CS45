<?php

class Customer
{
    use Model;

    protected $table = 'customer'; // Ensure this matches the table name
    protected $allowedColumns = ['user_id', 'address', 'phone_number'];

    // Fetch customer by user ID
    public function getCustomerByUserId($userId)
    {
        return $this->first(['user_id' => $userId]);
    }

    // Update customer profile
    public function updateCustomer($userId, $data)
    {
        return $this->update($userId, $data, 'user_id');
    }

    // Add new customer profile
    public function addCustomer($data)
    {
        return $this->insert($data);
    }

    // Delete customer profile by user ID
    public function deleteCustomerByUserId($userId)
    {
        // Ensure the customer record is deleted from the Customers table
        return $this->delete($userId, 'user_id');
    }
}
