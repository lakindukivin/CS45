<?php

/**
 * Universal Profile Controller for all users (both staff and customers)
 */
class Profile
{
    use Controller;

    public function model($model)
    {
        $modelPath = "../app/models/" . $model . ".php";
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model();
        } else {
            throw new Exception("Model file not found: " . $model);
        }
    }

    public function index()
    {
        // Get user ID from session
        $user_id = $_SESSION['user_id'] ?? 0;
        
        // Debug information - will help identify if session is working
        if (!$user_id) {
            // For testing, set a hardcoded user ID for CS Manager (change this to match your user)
            // Remove this line after testing!
            $_SESSION['user_id'] = 4; // Assuming 4 is the CS Manager's user_id
            $user_id = 4;
            
            // For debugging only
            echo "<div style='background:yellow;padding:10px;'>";
            echo "DEBUG: No user_id in session. Using test ID: $user_id<br>";
            echo "Session data: " . print_r($_SESSION, true);
            echo "</div>";
        }

        // Get user role to determine if staff or customer
        $userModel = $this->model('UserModel');
        $user = $userModel->getUserById($user_id);
        
        if (!$user) {
            echo "<div style='background:red;color:white;padding:10px;'>";
            echo "DEBUG: User with ID $user_id not found in database</div>";
            redirect('login');
        }
        
       
        
        // Determine if user is staff or customer based on role_id
        if ($user->role_id == 5) { // Customer role_id is 5 in your database
            // Load customer profile
            $customerModel = $this->model('Customer');
            $profileData = $customerModel->getCustomerByUserId($user_id);
            $this->view('customer/profile', [
                'profile' => $profileData
            ]);
        } else {
            // Load staff profile using existing ProfileController functionality
            $staffModel = $this->model('StaffModel');
            $profileData = $staffModel->getStaffProfileById($user_id);
            
            if (!$profileData) {
                // Handle error - staff not found
                echo "<div style='background:orange;padding:10px;'>";
                redirect('login');
            }
            
            // Map role ID to view folder
            $roleMappings = [
                1 => 'admin',
                2 => 'salesManager',
                3 => 'productionManager',
                4 => 'customerServiceManager',
                // Add other mappings as needed
            ];
            
            $viewFolder = $roleMappings[$user->role_id] ?? 'staff';
            
            $this->view($viewFolder . '/profile', [
                'profile' => $profileData
            ]);
        }
    }
    
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get user ID from session
            $user_id = $_SESSION['user_id'] ?? 0;
            
            if (!$user_id) {
                redirect('login');
            }
            
            // Process form data
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? '',
            ];
            
            // Optional profile image upload
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
                $image = $this->handleImageUpload($_FILES['profile_image']);
                if ($image) {
                    $data['image'] = $image;
                }
            }
            
            // Get user role to determine update method
            $userModel = $this->model('UserModel');
            $user = $userModel->getUserById($user_id);
            
            if ($user->role_id == 5) { // Customer
                $customerModel = $this->model('Customer');
                $result = $customerModel->updateCustomerProfile($user_id, $data);
            } else { // Staff
                $staffModel = $this->model('StaffModel');
                $result = $staffModel->updateStaffProfile($user_id, $data);
            }
            
            if ($result) {
                $_SESSION['success_message'] = 'Profile updated successfully';
            } else {
                $_SESSION['error_message'] = 'Failed to update profile';
            }
            
            redirect('profile');
        } else {
            redirect('profile');
        }
    }
    
    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get user ID from session
            $user_id = $_SESSION['user_id'] ?? 0;
            
            if (!$user_id) {
                redirect('login');
            }
            
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            // Validate passwords
            if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                $_SESSION['error_message'] = 'All password fields are required';
                redirect('profile');
            }
            
            if ($newPassword !== $confirmPassword) {
                $_SESSION['error_message'] = 'New passwords do not match';
                redirect('profile');
            }
            
            // Verify current password
            $userModel = $this->model('UserModel');
            if (!$userModel->verifyPassword($user_id, $currentPassword)) {
                $_SESSION['error_message'] = 'Current password is incorrect';
                redirect('profile');
            }
            
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            // Update password
            $result = $userModel->changePassword($user_id, $hashedPassword);
            
            if ($result) {
                $_SESSION['success_message'] = 'Password changed successfully';
            } else {
                $_SESSION['error_message'] = 'Failed to change password';
            }
            
            redirect('profile');
        } else {
            redirect('profile');
        }
    }
    
    private function handleImageUpload($file)
    {
        // Create relative path without leading slash
        $target_dir = "uploads/profile/";
        $full_target_dir = $_SERVER['DOCUMENT_ROOT'] . '/' . $target_dir;
        
        // Create directory if it doesn't exist
        if (!file_exists($full_target_dir)) {
            mkdir($full_target_dir, 0777, true);
        }
        
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $file_name = uniqid() . '.' . $file_extension;
        $relative_path = $target_dir . $file_name; // Store relative path in database
        $full_target_file = $_SERVER['DOCUMENT_ROOT'] . '/' . $relative_path;
        
        if (move_uploaded_file($file['tmp_name'], $full_target_file)) {
            error_log("Image uploaded successfully: " . $relative_path);
            return $relative_path; // Return relative path without leading slash
        } else {
            error_log("Image upload failed. Error: " . $_FILES['profile_image']['error']);
            return false;
        }
    }
}
