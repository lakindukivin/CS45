<?php

class PaymentModel
{
    use Database;

    // Declare paymentModel at the class level so it can be accessed across methods
    private $paymentModel;

    public function __construct()
    {
        // Initialize the PaymentModel
        $this->paymentModel = new PaymentModel();
    }

    // Fetch order by ID
    public function getOrder($order_id)
    {
        $query = "SELECT * FROM orders WHERE order_id = :order_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Mark order as paid
    public function markOrderAsPaid($order_id)
    {
        $query = "UPDATE orders SET order_status = 'Paid' WHERE order_id = :order_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(':order_id', $order_id);

        if (!$stmt->execute()) {
            throw new Exception("Failed to update payment status.");
        }
    }

    // Record payment details
    public function recordPayment($order_id, $amount)
    {
        $query = "INSERT INTO payments (order_id, amount, paymentDate, paymentStatus) 
              VALUES (:order_id, :amount, NOW(), 'Paid')";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->bindParam(':amount', $amount);

        if (!$stmt->execute()) {
            throw new Exception("Failed to record payment.");
        }
    }

    // Process payment for an order
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
                $order = $this->paymentModel->getOrder($order_id);

                if (!$order) {
                    $_SESSION['error'] = "Order not found.";
                    header("Location: " . ROOT . "/store");
                    exit();
                }

                // Mark order as paid
                $this->paymentModel->markOrderAsPaid($order_id);

                // Record payment in the payments table
                $this->paymentModel->recordPayment($order_id, $order->total_amount);

                $_SESSION['success'] = "Payment successful!";
                header("Location: " . ROOT . "/payment/success/" . $order_id);  // Redirect to a success page after payment
                exit();
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                header("Location: " . ROOT . "/payment/" . $order_id);
                exit();
            }
        }
    }

    // Get the most recent order for a customer
    public function getMostRecentOrder($customer_id)
    {
        // Query the database to get the most recent order for the customer
        $query = "SELECT * FROM orders WHERE customer_id = :customer_id ORDER BY order_date DESC LIMIT 1";
        $stmt = $this->connect()->prepare($query);  // Use $this->connect() to get the database connection
        $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchObject(); // Return the order object
    }
}
