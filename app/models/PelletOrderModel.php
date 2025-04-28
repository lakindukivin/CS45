<?php

class PelletOrderModel
{
    use Model;

    protected $table = 'pellet';

    protected $allowedColumns = [
        'customer_id',
        'company_name',
        'email',
        'amount',
        'contact',
        'dateRequired',
        'pelletOrderStatus'
    ];

    protected $defaultStatus = 'pending';

    public function createOrder($data)
    {
        // Add default status if not provided
        if (!isset($data['pelletOrderStatus'])) {
            $data['pelletOrderStatus'] = $this->defaultStatus;
        }

        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            throw new Exception('You must be logged in to place an order');
        }

        // Get the customer_id associated with this user_id
        $customerModel = new Customer();
        $customer = $customerModel->getCustomerByUserId($_SESSION['user_id']);

        if (!$customer) {
            throw new Exception('Customer profile not found. Please complete your customer profile first.');
        }

        // Set the customer_id from the customer record
        $data['customer_id'] = $customer->customer_id;

        return $this->insert($data);
    }
}
