<?php

/**
 * CreateAccount Class
 */
class CreateAccount
{
    use Controller;

    public function index()
    {
        $user = new User();
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($user->validate($_POST)) {
                try {
                    // Use processed data for insertion
                    if ($user->insert($user->processedData)) {
                        // Successful account creation, redirect to home
                        redirect('login');
                    } else {
                        // If insert fails, show a general error message
                        $data['errors']['general'] = "An unexpected error occurred. Please try again.";
                    }
                } catch (Exception $e) {
                    // Log any errors for debugging
                    error_log("Database Error: " . $e->getMessage());
                    // Show a friendly error message to the user
                    $data['errors']['general'] = "Failed to create account: " . $e->getMessage();
                }
            } else {
                // Validation failed, show the validation errors
                $data['errors'] = $user->errors;
            }
        }

        // Load the view and pass data (errors)
        $this->view('customer/createAccount', $data);
    }
}
