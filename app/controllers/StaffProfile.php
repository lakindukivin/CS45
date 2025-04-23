<?php

class StaffProfile
{
    use Controller;

    public function index()
    {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Redirect if not authenticated
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
        }

        // Only staff members can access this controller (roles 1-4)
        if ($_SESSION['role_id'] == 5) { // Role 5 is Customer
            redirect('home');
        }

        $userId = $_SESSION['user_id'];
        $staffModel = new StaffModel();
        $profileData = $staffModel->getStaffProfileById($userId);

        // Pass data to view
        $this->view('customerServiceManager/profile', [
            'profile' => $profileData
        ]);

        // Clear messages
        unset($_SESSION['success_message'], $_SESSION['error_message']);
    }
    
    public function update()
    {
        // Check if user is logged in
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $_SESSION['user_id'];
            
            // Get staff model
            $staffModel = new StaffModel();
            
            // Handle image upload
            $profileImage = $_FILES['profile_image'] ?? null;
            $imagePath = null;
            
            if ($profileImage && $profileImage['error'] == UPLOAD_ERR_OK) {
                $imagePath = $this->handleImageUpload($profileImage);
            }
            
            // Prepare data for update
            $data = [
                'name' => htmlspecialchars($_POST['name'] ?? ''),
                'email' => htmlspecialchars($_POST['email'] ?? ''),
                'phone' => htmlspecialchars($_POST['phone'] ?? ''),
                'address' => htmlspecialchars($_POST['address'] ?? '')
            ];
            
            // Add image path if an image was uploaded
            if ($imagePath) {
                $data['image'] = $imagePath;
            }
            
            // Update staff profile
            $result = $staffModel->updateStaffProfile($userId, $data);
            
            if ($result) {
                $_SESSION['success_message'] = 'Profile updated successfully';
            } else {
                $_SESSION['error_message'] = 'Failed to update profile';
            }
        }
        
        redirect('StaffProfile');
    }
    
    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get user ID from session
            $userId = $_SESSION['user_id'] ?? 0;
            
            if (!$userId) {
                redirect('login');
            }
            
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            // Validate passwords
            if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                $_SESSION['error_message'] = 'All password fields are required';
                redirect('StaffProfile');
            }
            
            if ($newPassword !== $confirmPassword) {
                $_SESSION['error_message'] = 'New passwords do not match';
                redirect('StaffProfile');
            }
            
            // Verify current password
            $userModel = new UserModel();
            if (!$userModel->verifyPassword($userId, $currentPassword)) {
                $_SESSION['error_message'] = 'Current password is incorrect';
                redirect('StaffProfile');
            }
            
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            // Update password
            $result = $userModel->changePassword($userId, $hashedPassword);
            
            if ($result) {
                $_SESSION['success_message'] = 'Password changed successfully';
            } else {
                $_SESSION['error_message'] = 'Failed to change password';
            }
            
            redirect('StaffProfile');
        } else {
            redirect('StaffProfile');
        }
    }
    
    private function handleImageUpload($file)
    {
        // Define project root paths
        $project_root = dirname(dirname(dirname(__FILE__))); // Gets path to CS45 folder
        $upload_dir = "assets/uploads/staff/"; 
        $upload_path = $project_root . '/' . $upload_dir;
        
        // Create directory if it doesn't exist
        if (!file_exists($upload_path)) {
            if (!mkdir($upload_path, 0777, true)) {
                error_log("Failed to create directory: " . $upload_path);
                return false;
            }
        }
        
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $file_name = 'staff_' . $_SESSION['user_id'] . '_' . uniqid() . '.' . $file_extension;
        $file_path = $upload_path . $file_name;
        $db_path = $upload_dir . $file_name; // Path to store in database
        
        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            return $db_path; // Return path for database
        } else {
            error_log("File upload failed. Error code: " . $file['error']);
            return false;
        }
    }
}