<?php

/**
 * CustomOrderList class to display the logged-in user's custom orders.
 */
class CustomOrderList
{
    use Controller;

    public function index()
    {
        // Check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id']; // Get the user ID from the session

            // Initialize the model
            $customOrderModel = new CustomOrderModel();

            // Fetch the custom orders for the logged-in user, ordered by `order_id` (ascending)
            $customOrders = $customOrderModel->where(
                ['user_id' => $user_id], // Condition
                [],                      // No exclusions
                'order_id',              // Custom order column
                'asc'                    // Ascending order
            );

            // Pass the orders to the view
            $this->view('customer/customOrderList', ['customOrders' => $customOrders]);
        } else {
            // Redirect to login if not logged in
            header('Location: ' . ROOT . '/login');
            exit();
        }
    }

    public function editOrder($order_id)
    {
        // Check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id']; // Get the user ID from the session

            // Initialize the model
            $customOrderModel = new CustomOrderModel();

            // Fetch the order details based on order_id and user_id
            $order = $customOrderModel->first(['order_id' => $order_id, 'user_id' => $user_id]);

            if ($order) {
                // If the order exists, display the edit form
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Handle form submission
                    $data = [
                        'company_name' => $_POST['company_name'],
                        'quantity' => $_POST['quantity'],
                        'email' => $_POST['email'],
                        'phone' => $_POST['phone'],
                        'type' => $_POST['type'],
                        'specifications' => $_POST['specifications']
                    ];

                    // Update the order in the database
                    $updateSuccess = $customOrderModel->update($order_id, $data, 'order_id');

                    if ($updateSuccess) {
                        // Redirect to the order list after update
                        header('Location: ' . ROOT . '/customOrderList');
                        exit();
                    }
                }

                // Show the edit order view with the current order details
                $this->view('customer/editOrder', ['order' => $order]);
            } else {
                // If the order is not found, show an error
                echo "Order not found.";
            }
        } else {
            // Redirect to login if not logged in
            header('Location: ' . ROOT . '/login');
            exit();
        }
    }
}
