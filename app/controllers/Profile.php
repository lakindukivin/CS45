<?php

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
                'user_id' => $userId,
                'name' => htmlspecialchars($_POST['name'] ?? ''),
                'phone' => htmlspecialchars($_POST['phone'] ?? ''), // Note field name change
                'address' => htmlspecialchars($_POST['address'] ?? ''),
                'image' => $picturePath
            ];

            // Validate required fields
            if (!empty($data['name']) && !empty($data['phone']) && !empty($data['address'])) {
                if ($profileData) {
                    $customer->updateCustomer($userId, $data);
                    $_SESSION['success_message'] = "Profile updated successfully!";
                } else {
                    $customer->addCustomer($data);
                    $_SESSION['success_message'] = "Profile created successfully!";
                }
                redirect('profileComplete');
            } else {
                $_SESSION['error_message'] = "Please fill all required fields!";
            }
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
