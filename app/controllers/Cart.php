<?php

class Cart
{
    use Controller;

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
            exit();
        }

        $cartModel = new CartModel();
        $customerModel = new Customer();

        // Get customer_id from user_id
        $customer = $customerModel->getCustomerByUserId($_SESSION['user_id']);
        if (!$customer) {
            $_SESSION['error'] = "Please complete your customer profile first";
            redirect('profile');
            exit();
        }

        // Get cart items with product details
        $cartItems = $cartModel->getCartWithProducts($customer->customer_id);
        $total = $cartModel->getCartTotal($customer->customer_id);

        $this->view('cart/index', [
            'cartItems' => $cartItems,
            'total' => $total,
            'customer_id' => $customer->customer_id
        ]);
    }

    public function add()
    {
        if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('login');
            exit();
        }

        $cartModel = new CartModel();
        $customerModel = new Customer();

        $customer = $customerModel->getCustomerByUserId($_SESSION['user_id']);
        if (!$customer) {
            $_SESSION['error'] = "Please complete your customer profile first";
            redirect('profile');
            exit();
        }

        try {
            $data = [
                'customer_id' => $customer->customer_id,  // Changed from user_id to customer_id
                'product_id' => (int)$_POST['product_id'],
                'quantity' => (int)$_POST['quantity'],
                'pack_size' => htmlspecialchars(trim($_POST['pack_size'])),
                'bag_size' => htmlspecialchars(trim($_POST['bag_size']))
            ];

            $cartModel->addToCart($data);
            $_SESSION['success'] = "Item added to cart successfully!";
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        redirect('store');
    }

    public function update($cart_id)
    {
        if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('login');
            exit();
        }

        $cartModel = new CartModel();
        $customerModel = new Customer();

        $customer = $customerModel->getCustomerByUserId($_SESSION['user_id']);
        if (!$customer) {
            $_SESSION['error'] = "Please complete your customer profile first";
            redirect('profile');
            exit();
        }

        try {
            $quantity = (int)$_POST['quantity'];
            $cartModel->updateCartItem($cart_id, $customer->customer_id, $quantity);
            $_SESSION['success'] = "Cart updated successfully!";
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        redirect('cart');
    }

    public function remove($cart_id)
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
            exit();
        }

        $cartModel = new CartModel();
        $customerModel = new Customer();

        $customer = $customerModel->getCustomerByUserId($_SESSION['user_id']);
        if (!$customer) {
            $_SESSION['error'] = "Please complete your customer profile first";
            redirect('profile');
            exit();
        }

        try {
            $cartModel->removeFromCart($cart_id, $customer->customer_id);
            $_SESSION['success'] = "Item removed from cart successfully!";
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        redirect('cart');
    }
}
