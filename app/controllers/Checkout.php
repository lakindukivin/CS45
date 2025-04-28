<?php

class Checkout
{
    use Controller;

    // Declare checkoutModel at the class level so it can be accessed across methods
    private $checkoutModel;

    public function __construct()
    {
        // Initialize the CheckoutModel
        $this->checkoutModel = new CheckoutModel();
    }

    private function getCustomerId()
    {
        $user_id = $_SESSION['user_id'];
        $customerModel = new Customer();
        $customer = $customerModel->first(['user_id' => $user_id]);

        if (!$customer) {
            throw new Exception("Customer not found for the logged user.");
        }

        return $customer->customer_id;
    }

    // Render checkout page
    public function index()
    {
        try {
            $customer_id = $this->getCustomerId();
            $cartModel = new CartModel();
            $cartItems = $cartModel->getCartWithProducts($customer_id);
            $total = $cartModel->getCartTotal($customer_id);

            $this->view('checkout', [
                'cartItems' => $cartItems,
                'total' => $total
            ]);
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header("Location: " . ROOT . "/store");
            exit();
        }
    }

    // Process checkout
    public function processCheckout()
    {
        try {
            $customer_id = $this->getCustomerId();
            $deliveryAddress = $_POST['deliveryAddress'];
            $billingAddress = $_POST['billingAddress'];
            $orderDate = date('Y-m-d H:i:s');
            $orderStatus = 'Pending';

            // Get cart items and total
            $cartModel = new CartModel();
            $cartItems = $cartModel->getCartWithProducts($customer_id);
            $total = $_POST['total_amount']; // Use the total passed from the form

            // Use the $this->checkoutModel to call createOrder method
            $order_id = $this->checkoutModel->createOrder($customer_id, $deliveryAddress, $billingAddress, $cartItems, $orderDate, $orderStatus, $total);

            if ($order_id) {
                // Order has been created successfully
                $_SESSION['success'] = 'Order placed successfully. Order ID: ' . $order_id;
                header('Location: ' . ROOT . '/order/confirmation/' . $order_id);
                exit;
            } else {
                throw new Exception('There was an issue placing your order.');
            }
        } catch (Exception $e) {
            // Handle failure
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . ROOT . '/checkout');
            exit;
        }
    }
}
