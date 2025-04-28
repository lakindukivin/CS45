<?php

class CustomOrder
{
    use Controller;

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
            exit();
        }

        $orderModel = new CustomOrderModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // CSRF protection
                if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                    throw new Exception("Invalid CSRF token");
                }

                $companyName = htmlspecialchars(trim($_POST['company_name'] ?? ''));
                $quantity = (int)($_POST['quantity'] ?? 0);
                $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
                $phone = preg_replace('/[^0-9]/', '', $_POST['phone'] ?? '');
                $type = htmlspecialchars(trim($_POST['type'] ?? ''));
                $specifications = htmlspecialchars(trim($_POST['specifications'] ?? ''));

                // Validate inputs
                $errors = $this->validateOrderInputs($companyName, $quantity, $email, $phone, $type);

                if (empty($errors)) {
                    $data = [
                        'company_name' => $companyName,
                        'quantity' => $quantity,
                        'email' => $email,
                        'phone' => $phone,
                        'type' => $type,
                        'specifications' => $specifications,
                    ];

                    $success = $orderModel->createOrder($data);

                    if ($success) {
                        $_SESSION['success_message'] = "Your custom order has been submitted successfully!";
                        unset($_SESSION['form_data']); // Clear saved form data on success
                    } else {
                        $_SESSION['error_message'] = "Failed to submit order. Please try again.";
                    }
                } else {
                    $_SESSION['form_errors'] = $errors;
                }
            } catch (Exception $e) {
                error_log("Order Error: " . $e->getMessage());
                $_SESSION['error_message'] = $e->getMessage();
            }

            // Store form data for repopulation
            $_SESSION['form_data'] = $_POST;
            redirect('customOrder');
            exit();
        }

        // Generate CSRF token if not exists
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        // Prepare view data
        $viewData = [
            'errors' => $_SESSION['form_errors'] ?? [],
            'success' => $_SESSION['success_message'] ?? null,
            'formData' => $_SESSION['form_data'] ?? [],
            'csrf_token' => $_SESSION['csrf_token']
        ];

        // Clear flash messages
        unset($_SESSION['form_errors']);
        unset($_SESSION['success_message']);
        unset($_SESSION['error_message']);

        $this->view('customer/customOrder', $viewData);
    }

    private function validateOrderInputs($companyName, $quantity, $email, $phone, $type)
    {
        $errors = [];

        if (empty($companyName)) {
            $errors['company_name'] = "Company name is required";
        } elseif (strlen($companyName) > 100) {
            $errors['company_name'] = "Company name must be less than 100 characters";
        }

        if ($quantity < 1000) {
            $errors['quantity'] = "Minimum quantity is 1000";
        } elseif ($quantity > 1000000) {
            $errors['quantity'] = "Maximum quantity is 1,000,000";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Valid email is required";
        } elseif (strlen($email) > 100) {
            $errors['email'] = "Email must be less than 100 characters";
        }

        if (strlen($phone) !== 10) {
            $errors['phone'] = "10-digit phone number is required";
        }

        if (empty($type)) {
            $errors['type'] = "Bag type is required";
        }

        return $errors;
    }
}
