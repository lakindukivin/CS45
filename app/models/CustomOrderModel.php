<?php

class CustomOrderModel
{
    use Model;

    protected $table = 'custom_order';
    protected $allowedColumns = [
        'customOrder_id',
        'customer_id',
        'company_name',
        'quantity',
        'email',
        'phone',
        'type',
        'specifications',
        'customOrder_status',
        'created_at'
    ];

    public function createOrder($data)
    {
        try {
            // Verify customer exists
            $customerModel = new Customer();
            $customer = $customerModel->getCustomerByUserId($_SESSION['user_id']);

            if (!$customer) {
                throw new Exception('Please complete your customer profile before placing an order.');
            }

            $orderData = [
                'customer_id' => $customer->customer_id,
                'company_name' => $data['company_name'],
                'quantity' => $data['quantity'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'type' => $data['type'] ?? 'regular',
                'specifications' => $data['specifications'] ?? null,
                'customOrder_status' => 'pending',
            ];

            // Debug output
            error_log("Attempting to insert order: " . print_r($orderData, true));

            // Perform insert
            $success = $this->insert($orderData);

            if (!$success) {
                error_log("Failed to insert order. Database error: ");
                return false;
            }

            error_log("Order inserted successfully with ID: ");
            return true;
        } catch (Exception $e) {
            error_log("Model Error in createOrder: " . $e->getMessage());
            throw $e;
        }
    }
}
