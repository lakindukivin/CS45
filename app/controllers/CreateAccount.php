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
            // Set default role if not provided
            $_POST['role_id'] = $_POST['role_id'] ?? 3; // Default to Customer role (3)

            if ($user->validate($_POST)) {
                try {
                    // Hash the password before insertion
                    $user->processedData['password'] = password_hash($user->processedData['password'], PASSWORD_DEFAULT);

                    // Insert the user and get the new user ID
                    $user_id = $user->addUser($user->processedData);

                    if ($user_id) {
                        // Optionally log the user in immediately
                        // $this->autoLogin($user_id);

                        // Set success message and redirect
                        $_SESSION['success'] = "Account created successfully!";
                        redirect('login');
                    } else {
                        $data['errors']['general'] = "Failed to create account. Please try again.";
                    }
                } catch (Exception $e) {
                    error_log("Database Error: " . $e->getMessage());
                    $data['errors']['general'] = "A system error occurred. Please try again later.";
                }
            } else {
                $data['errors'] = $user->errors;
                // Preserve form input for better UX
                $data['old'] = $_POST;
            }
        }

        $this->view('customer/createAccount', $data);
    }

    // Optional: Auto-login after registration
    protected function autoLogin($user_id)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $user = new User();
        $userData = $user->first(['user_id' => $user_id]);

        if ($userData) {
            $_SESSION['user_id'] = $userData->user_id;
            $_SESSION['email'] = $userData->email;
            $_SESSION['role_id'] = $userData->role_id;
        }
    }
}
