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
        $productModel = new ProductModel();

        // Get cart items with product details
        $cartItems = $cartModel->getCartWithProducts($_SESSION['user_id']);
        $total = $cartModel->getCartTotal($_SESSION['user_id']);

        $this->view('cart/index', [
            'cartItems' => $cartItems,
            'total' => $total,
            'user_id' => $_SESSION['user_id']
        ]);
    }

    public function add()
    {
        if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('login');
            exit();
        }

        $cartModel = new CartModel();

        try {
            $data = [
                'user_id' => $_SESSION['user_id'],
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

        try {
            $quantity = (int)$_POST['quantity'];
            $cartModel->updateCartItem($cart_id, $_SESSION['user_id'], $quantity);
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

        try {
            $cartModel->removeFromCart($cart_id, $_SESSION['user_id']);
            $_SESSION['success'] = "Item removed from cart successfully!";
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        redirect('cart');
    }
}