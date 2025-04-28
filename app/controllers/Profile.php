<?php

/**
 * Universal Profile Controller for all users (both staff and customers)
 */
class Profile
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

        $userId = $_SESSION['user_id'];
        $customer = new Customer();
        $profileData = $customer->getCustomerByUserId($userId);

        // Convert object to array if needed
        if (is_object($profileData)) {
            $profileData = (array)$profileData;
        }

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process profile picture upload
            $profilePicture = $_FILES['profile_picture'] ?? null;
            $picturePath = $profileData['image'] ?? null;

            if ($profilePicture && $profilePicture['error'] == UPLOAD_ERR_OK) {
                $uploadDir = ROOT . '/assets/uploads/profiles/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $extension = pathinfo($profilePicture['name'], PATHINFO_EXTENSION);
                $filename = 'profile_' . $userId . '.' . $extension;
                $picturePath = '/assets/uploads/profiles/' . $filename;

                move_uploaded_file($profilePicture['tmp_name'], $uploadDir . $filename);
            }

            // Prepare data
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
