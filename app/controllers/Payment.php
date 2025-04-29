<?php

class Payment
{
    use Controller;

    private $paymentModel;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel();
    }

    // Show payment page
    public function index()
    {
        // Get the logged-in user's customer_id
        try {
            $customer_id = $this->getCustomerId();

            // Fetch the most recent order for the customer
            $order = $this->paymentModel->getMostRecentOrder($customer_id);

            if (!$order) {
                $_SESSION['error'] = "No order found for the current session.";
                header("Location: " . ROOT . "/store");
                exit();
            }

            // Pass the order details to the view
            $this->view('customer/payment', [
                'order' => $order
            ]);
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header("Location: " . ROOT . "/store");
            exit();
        }
    }

    // Process payment
    public function processPayment()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $order_id = $_POST['order_id'];

            if (!$order_id) {
                $_SESSION['error'] = "Invalid payment.";
                header("Location: " . ROOT . "/store");
                exit();
            }

            try {
                // Mark the order as 'Paid'
                $this->paymentModel->markOrderAsPaid($order_id);
                $_SESSION['success'] = "Payment successful!";
                header("Location: " . ROOT . "/order/confirmation/" . $order_id);
                exit();
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                header("Location: " . ROOT . "/payment");
                exit();
            }
        }
    }
}
