<?php

class CollectionAgentProfile
{
    use Controller;
    private $user_id;
    private $model;
    
    public function __construct()
    {
        // Check if user is logged in and is a Customer Service Manager
        if(!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 6) {
            redirect('login');
        }
        
        $this->user_id = $_SESSION['user_id'];
        $this->model = new CollectionAgentProfileModel();
    }
    
    public function index()
    {
        // Fetch profile data from database
        $profile = $this->model->getProfileData($this->user_id);
        
        if(!$profile) {
            $profile = (object)[];
        }
        
        $data = [
            'profile' => $profile
        ];
        
        $this->view('collectionAgent/myprofile', $data);
    }
    
    public function update()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get form data
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            
            // Process image if uploaded
            $image_path = null;
            if(!empty($_FILES['profile_image']['name'])) {
                $upload_result = $this->handleImageUpload();
                
                if(isset($upload_result['error'])) {
                    $_SESSION['error_message'] = $upload_result['error'];
                    redirect('CollectionAgentProfile');
                }
                
                if(isset($upload_result['path'])) {
                    $image_path = $upload_result['path'];
                }
            }
            
            $update_data = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
            ];
            
            // Only add image to update_data if it was uploaded
            if($image_path) {
                $update_data['image'] = $image_path;
            }
            
            if($this->model->updateProfile($this->user_id, $update_data)) {
                $_SESSION['success_message'] = 'Profile updated successfully!';
            } else {
                $_SESSION['error_message'] = 'Failed to update profile. Please try again.';
            }
            
            redirect('CollectionAgentProfile');
        }
    }
    
    public function changePassword()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $current_password = $_POST['current_password'] ?? '';
            $new_password = $_POST['new_password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            
            // Validate inputs
            if(empty($current_password) || empty($new_password) || empty($confirm_password)) {
                $_SESSION['error_message'] = 'All password fields are required';
                redirect('CSmanagerProfile');
            }
            
            if($new_password !== $confirm_password) {
                $_SESSION['error_message'] = 'New password and confirmation do not match';
                redirect('CollectionAgentProfile');
            }
            
            // Verify current password and update to new password
            $result = $this->model->changePassword($this->user_id, $current_password, $new_password);
            
            if($result === true) {
                $_SESSION['success_message'] = 'Password changed successfully!';
            } else {
                $_SESSION['error_message'] = $result; // Error message from model
            }
            
            redirect('CollectionAgentProfile');
        }
    }
    
    private function handleImageUpload()
    {
        // Check for PHP upload errors first
        if ($_FILES['profile_image']['error'] !== UPLOAD_ERR_OK) {
            $errors = [
                UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
                UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form',
                UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
                UPLOAD_ERR_NO_FILE => 'No file was uploaded',
                UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
                UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
                UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload'
            ];
            
            $error_message = $errors[$_FILES['profile_image']['error']] ?? 'Unknown upload error';
            return ['error' => $error_message];
        }
        
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        $max_size = 10 * 1024 * 1024; // 10MB
        
        if(!in_array($_FILES['profile_image']['type'], $allowed_types)) {
            return ['error' => 'Only JPG, JPEG, PNG and GIF files are allowed'];
        }
        
        if($_FILES['profile_image']['size'] > $max_size) {
            return ['error' => 'File size should be less than 10MB'];
        }
        
        // Create uploads directory similar to products implementation
        $uploadDir = 'uploads/profiles/';
        
        // Make sure directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        // Generate a unique filename with proper extension
        $fileName = uniqid('profile_') . '_' . basename($_FILES['profile_image']['name']);
        $targetFile = $uploadDir . $fileName;
        
        // Move the uploaded file
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
            // Use consistent path format with leading slash
            return ['path' => '/' . $targetFile];
        } else {
            // More detailed error message
            $upload_error = error_get_last();
            $error_msg = $upload_error ? $upload_error['message'] : 'Unknown error';
            return ['error' => 'Failed to upload image: ' . $error_msg];
        }
    }
}


