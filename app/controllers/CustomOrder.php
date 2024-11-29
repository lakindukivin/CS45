<?php

class CustomOrder
{
    use Controller;

    public function index()
    {

        if (!isset($_SESSION['user_id'])) {
            redirect('login');
        }

        $userId = $_SESSION['user_id'];
        $orderModel = new CustomOrderModel();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $companyName = htmlspecialchars(trim($_POST['company_name'] ?? ''));
            $quantity = htmlspecialchars(trim($_POST['quantity'] ?? ''));
            $email = htmlspecialchars(trim($_POST['email'] ?? ''));
            $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
            $type = htmlspecialchars(trim($_POST['type'] ?? ''));
            $specifications = htmlspecialchars(trim($_POST['specifications'] ?? ''));


            if (!empty($companyName) && !empty($quantity) && !empty($email) && !empty($phone) && !empty($type)) {

                $data = [
                    'user_id' => $userId, // Use the user's ID from the session
                    'company_name' => $companyName,
                    'quantity' => $quantity,
                    'email' => $email,
                    'phone' => $phone,
                    'type' => $type,
                    'specifications' => $specifications,
                ];

                try {
                    $success = $orderModel->createOrder($data);
                    if ($success) {
                        $_SESSION['success_message'] = "Your custom order has been submitted successfully!";
                    } else {
                        $_SESSION['error_message'] = "Failed to submit your order. Please try again.";
                    }
                } catch (Exception $e) {
                    error_log("Error inserting order: " . $e->getMessage());
                    $_SESSION['error_message'] = "A database error occurred. Please contact support.";
                }
            } else {
                $_SESSION['error_message'] = "All required fields must be filled!";
            }

            // Redirect to refresh the page and avoid resubmission
            redirect('customOrder');
        }

        // Load the custom order view
        $this->view('customer/customOrder');
    }
}
