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
        $customer = new Customer(); // Add Customer model instance
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Set default role if not provided
            $_POST['role_id'] = $_POST['role_id'] ?? 5; // Default to Customer role (5)

            if ($user->validate($_POST)) {
                try {
                    // Hash the password before insertion
                    $user->processedData['password'] = password_hash($user->processedData['password'], PASSWORD_DEFAULT);

                    // Insert the user and get the new user ID
                    $user_id = $user->addUser($user->processedData);

                    if ($user_id) {
                        // Create customer record with default values
                        $customerData = [
                            'user_id' => $user_id,
                            'address' => '', // Default empty address
                            'phone' => '', // Default empty phone
                            'status' => 1 // Default active status
                        ];

                        // Add customer record
                        if (!$customer->insert($customerData)) {
                            // If customer creation fails, delete the user to maintain consistency
                            $user->delete($user_id, 'user_id');
                            throw new Exception("Failed to create customer profile");
                        }

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
            
            // You might want to add customer data to session as well
            $customer = new Customer();
            $customerData = $customer->where(['user_id' => $user_id]);
            if ($customerData && count($customerData) > 0) {
                $_SESSION['customer_id'] = $customerData[0]->customer_id;
            }
        }
    }
}