<?php

class NormalOrder
{
    use Controller;
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            redirect('login');
        }

        $userId = $_SESSION['user_id'];

        $customer = new Customer();
        $profileData = $customer->first(['user_id' => $userId]);

        if (!$profileData) {
            echo "Customer not found.";
            exit;
        }

        $customerId = $profileData->customer_id;

        $normalOrderModel = new NormalOrderModel();
        $completedOrders = $normalOrderModel->getCompletedOrdersByCustomerId($customerId);

        $this->view('customer/normalOrder', ['completedOrders' => $completedOrders]);
    }
}
