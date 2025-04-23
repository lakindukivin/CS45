<?php

/**
 * Universal Profile Controller for all staff roles
 */
class ProfileController
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

    /**
     * Map role names to their respective view folders
     * @param string $role_name Role name from database
     * @return string View folder path
     */
    private function getRoleViewPath($role_name) {
        $roleMappings = [
            'Customer Service Manager' => 'customerServiceManager',
            'Admin' => 'admin',
            'Inventory Manager' => 'inventoryManager',
            'Marketing Manager' => 'marketingManager',
            'Delivery Manager' => 'deliveryManager',
            // Add other roles as needed
        ];
        
        return $roleMappings[$role_name] ?? 'staff';
    }

    public function index()
    {
        // Get user ID from session
        $user_id = $_SESSION['user_id'] ?? 0;
        
        if (!$user_id) {
            redirect('login');
        }

        // Load user and staff information
        $staffModel = $this->model('StaffModel');
        $profileData = $staffModel->getStaffProfileById($user_id);
        
        if (!$profileData) {
            // Handle error - staff not found
            redirect('login');
        }
        
        // Get the appropriate view path for the staff's role
        $viewFolder = $this->getRoleViewPath($profileData->role_name);
        
        // Use a consistent profile view name but in the role-specific folder
        $this->view($viewFolder . '/profile', [
            'profile' => $profileData
        ]);
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
            
            // Update profile
            $staffModel = $this->model('StaffModel');
            $result = $staffModel->updateStaffProfile($user_id, $data);
            
            if ($result) {
                // Success message
                $_SESSION['success_message'] = 'Profile updated successfully';
            } else {
                // Error message
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
            $userModel = $this->model('UserModel'); // You may need to create this model
            if (!$userModel->verifyPassword($user_id, $currentPassword)) {
                $_SESSION['error_message'] = 'Current password is incorrect';
                redirect('profile');
            }
            
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            // Update password
            $staffModel = $this->model('StaffModel');
            $result = $staffModel->changePassword($user_id, $hashedPassword);
            
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
        $target_dir = "uploads/profile/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $file_name = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $file_name;
        
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            return $target_file;
        }
        
        return false;
    }
}