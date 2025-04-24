<?php

class PelletForm
{
    use Controller;
    public function index()
    {
        // Load the view
        $this->view('customer/pelletForm');
    }

    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'company_name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'amount' => trim($_POST['amount']),
                'contact' => trim($_POST['phone']),
                'dateRequired' => trim($_POST['date']),
                'errors' => [],
                'success' => false
            ];

            // Validate inputs
            if (empty($data['company_name'])) {
                $data['errors']['name'] = 'Please enter company/client name';
            }

            if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['errors']['email'] = 'Please enter a valid email';
            }

            if (empty($data['amount']) || $data['amount'] < 1) {
                $data['errors']['amount'] = 'Please enter a valid amount';
            }

            if (empty($data['contact']) || !preg_match('/^[0-9]{10}$/', $data['contact'])) {
                $data['errors']['phone'] = 'Please enter a valid 10-digit phone number';
            }

            if (empty($data['dateRequired']) || strtotime($data['dateRequired']) < strtotime('today')) {
                $data['errors']['date'] = 'Please select a valid future date';
            }

            // If no validation errors, proceed with order creation
            if (empty($data['errors'])) {
                $pelletOrder = new PelletOrderModel();

                try {
                    if ($pelletOrder->createOrder($data)) {
                        $data['success'] = true;
                        $data['success_message'] = 'Your pellet order has been submitted successfully!';
                    }
                } catch (Exception $e) {
                    $data['errors']['submit'] = $e->getMessage();

                    // Add a link to complete profile if that's the issue
                    if (strpos($e->getMessage(), 'complete your customer profile') !== false) {
                        $data['errors']['profile_link'] = ROOT . '/profile';
                    }
                }
            }

            $this->view('customer/pelletForm', $data);
        } else {
            redirect('pelletForm');
        }
    }
}
