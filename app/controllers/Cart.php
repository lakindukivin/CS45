<?php

class Cart
{
    use Controller;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . ROOT . "/login");
            exit();
        }
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

    // Display the cart page with all items
    public function index()
    {
        try {
            $customer_id = $this->getCustomerId();

            $cartModel = new CartModel();
            $cartItems = $cartModel->getCartWithProducts($customer_id);
            $total = $cartModel->getCartTotal($customer_id);

            $this->view('customer/cart', [
                'cartItems' => $cartItems,
                'total' => $total
            ]);
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header("Location: " . ROOT . "/store");
            exit();
        }
    }

    // Add item to cart (already implemented as 'add')
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Get customer ID
                $customer_id = $this->getCustomerId();

                // Prepare data
                $data = [
                    'customer_id' => $customer_id,
                    'product_id' => $_POST['product_id'],
                    'bag_id' => $_POST['bag_id'],
                    'quantity' => $_POST['quantity'],
                    'pack_size' => $_POST['pack_size'],
                    'bag_size' => $_POST['bag_size']
                ];

                // Add to cart
                $cartModel = new CartModel();
                $cartModel->addToCart($data);

                // Return JSON response indicating success
                echo json_encode(['success' => true, 'message' => 'Item added to cart successfully!']);
            } catch (Exception $e) {
                // Return JSON response indicating error
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    // Handle update cart item quantity
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $customer_id = $this->getCustomerId();
                $cart_id = $_POST['cart_id']; // Get the cart item ID from the form
                $quantity = $_POST['quantity']; // Get the updated quantity

                $cartModel = new CartModel();
                $cartModel->updateCartItem($cart_id, $customer_id, $quantity); // Update the item

                $_SESSION['success'] = 'Cart updated successfully!';
                header("Location: " . ROOT . "/cart");
                exit();
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                header("Location: " . ROOT . "/cart");
                exit();
            }
        }
    }

    // Handle removing an item from the cart
    public function removeFromCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $customer_id = $this->getCustomerId();

                if (!isset($_POST['cart_id'])) {
                    throw new Exception("Cart ID is missing.");
                }

                $cart_id = $_POST['cart_id'];

                $cartModel = new CartModel();

                $item = $cartModel->first(['cart_id' => $cart_id, 'customer_id' => $customer_id]);
                if (!$item) {
                    throw new Exception("Cart item not found or you don't have permission to remove it.");
                }

                $cartModel->removeFromCart($cart_id);

                $_SESSION['success'] = 'Item removed from cart successfully!';
                header("Location: " . ROOT . "/cart");
                exit();
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                header("Location: " . ROOT . "/cart");
                exit();
            }
        }
    }
}
