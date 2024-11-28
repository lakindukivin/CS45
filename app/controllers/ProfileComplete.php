<?php

/**
 * Profile Complete Controller
 */
class ProfileComplete
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

        // Fetch the user's profile data from the Customers table
        $customer = new Customer();
        $profileData = $customer->getCustomerByUserId($userId);

        // Handle form submission if POST request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete_account']) && $_POST['delete_account'] == 'true') {
                // Call the method to delete the account
                $this->deleteAccount($userId);
            } else {
                // Sanitize form inputs for profile update
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
        }

        // Render the profile view with success/error messages and profile data
        $this->view('customer/profileComplete', [
            'profileData' => $profileData,
            'success_message' => $_SESSION['success_message'] ?? '',
            'error_message' => $_SESSION['error_message'] ?? ''
        ]);

        // Clear session messages after rendering
        unset($_SESSION['success_message'], $_SESSION['error_message']);
    }

    public function deleteAccount($userId)
    {
        $user = new User(); // Initialize the User model

        // Attempt to delete the user from the Users table
        if ($user->delete($userId, 'user_id')) {
            // Successfully deleted, clear session and redirect to login
            $_SESSION['success_message'] = "Your account has been deleted successfully.";

            // Clear session data before redirecting
            session_unset();
            session_destroy();

            // Redirect to the login page
            redirect('login');
        } else {
            // If deletion from the Users table failed, set an error message
            $_SESSION['error_message'] = "There was an issue deleting your account.";
            redirect('profileComplete');
        }
    }
}
