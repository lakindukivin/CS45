<?php

class Profile
{
    use Controller;

    public function index()
    {
        // Ensure session is active
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Redirect to login if user is not authenticated
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
        }

        // Get the user ID from the session
        $userId = $_SESSION['user_id'];

        // Fetch the customer's profile data
        $customer = new Customer();
        $profileData = $customer->getCustomerByUserId($userId);

        // Handle form submission if POST request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize form inputs
            $address = htmlspecialchars($_POST['address'] ?? '');
            $phoneNumber = htmlspecialchars($_POST['phone_number'] ?? '');

            // Validate the inputs
            if (!empty($address) && !empty($phoneNumber)) {
                $data = [
                    'user_id' => $userId,
                    'address' => $address,
                    'phone_number' => $phoneNumber,
                ];

                // Check if the user already has a profile
                if ($profileData) {
                    // Update existing profile
                    $customer->updateCustomer($userId, $data);
                    $_SESSION['success_message'] = "Profile updated successfully.";
                } else {
                    // Add a new profile
                    $customer->addCustomer($data);
                    $_SESSION['success_message'] = "Profile created successfully.";
                }
            } else {
                $_SESSION['error_message'] = "All fields are required.";
            }

            // Refresh the page to display the updated data
            redirect('profileComplete');
        }

        // Render the profile view with success/error messages and profile data
        $this->view('customer/profile');

        // Clear session messages after rendering
        unset($_SESSION['success_message'], $_SESSION['error_message']);
    }
}
