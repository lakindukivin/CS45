<?php

class AdminProfile{

    use Controller;
    private $user_id; 
    private $model;  

    public function __construct(){
        // Check if user is logged in and is an Admin
        if(!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
            redirect('login');
        }
        
        $this->user_id = $_SESSION['user_id'];
        $this->model = new AdminProfileModel();
    }
    public function index(){
        // Fetch profile data from database
        $profile = $this->model->getProfileData($this->user_id);
        
        if(!$profile) {
            $profile = (object)[];
        }
        
        $data = [
            'profile' => $profile
        ];
        
        $this->view('admin/myprofile', $data);
    }

    public function update(){
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
                    redirect('AdminProfile');
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
                'image' => $image_path
            ];
            
            // Update profile in database
            if($this->model->updateProfile($this->user_id, $update_data)) {
                $_SESSION['success_message'] = "Profile updated successfully!";
            } else {
                $_SESSION['error_message'] = "Failed to update profile.";
            }
            
            redirect('AdminProfile');
        } else {
            redirect('AdminProfile');
        }
    }   
    public function handleImageUpload() {
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
            $target_dir = ROOT . "/assets/images/profile/";
            $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
            if ($check === false) {
                return ['error' => "File is not an image."];
            }

            // Check file size
            if ($_FILES["profile_image"]["size"] > 500000) {
                return ['error' => "Sorry, your file is too large."];
            }

            // Allow certain file formats
            if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                return ['error' => "Sorry, only JPG, JPEG, PNG & GIF files are allowed."];
            }

            // Try to upload file
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                return ['path' => "/assets/images/profile/" . basename($_FILES["profile_image"]["name"])];
            } else {
                return ['error' => "Sorry, there was an error uploading your file."];
            }
        }
        return null;
    }
}