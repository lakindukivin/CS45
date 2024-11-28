<?php

/**
 * Custom Order Controller
 */
class CustomOrder
{
    use Controller;

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
        }

        $userId = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get data from the POST request
            $companyName = htmlspecialchars($_POST['company_name'] ?? '');
            $quantity = htmlspecialchars($_POST['quantity'] ?? '');
            $email = htmlspecialchars($_POST['email'] ?? '');
            $phone = htmlspecialchars($_POST['phone'] ?? '');
            $type = htmlspecialchars($_POST['type'] ?? '');
            $specifications = htmlspecialchars($_POST['specifications'] ?? '');

            if (!empty($companyName) && !empty($quantity) && !empty($email) && !empty($phone) && !empty($type)) {
                // Prepare data for insertion, using user_id from session
                $data = [
                    'user_id' => $userId,  // Use the user_id from the session (foreign key)
                    'company_name' => $companyName,
                    'quantity' => $quantity,
                    'email' => $email,
                    'phone' => $phone,
                    'type' => $type,
                    'specifications' => $specifications,
                ];

                // Debugging: Log the data being inserted
                error_log("Data being inserted: " . print_r($data, true));

                // Attempt to insert the order into the database using the model
                $orderModel = new CustomOrder();  // Use the model for data insertion
                if ($orderModel->createOrder($data)) {
                    $_SESSION['success_message'] = "Your custom order has been submitted successfully!";
                } else {
                    $_SESSION['error_message'] = "Failed to create your custom order. Please try again.";
                }
            } else {
                $_SESSION['error_message'] = "All required fields must be filled!";
            }

            // Redirect to the custom order page (refresh the page)
            redirect('customOrder');
        }

        // Load the custom order view
        $this->view('customer/customOrder');
    }
}
