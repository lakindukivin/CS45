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

        // Pass data to view
        $this->view('customer/profile', [
            'profile' => $profileData,
            'success_message' => $_SESSION['success_message'] ?? null,
            'error_message' => $_SESSION['error_message'] ?? null
        ]);

        // Clear messages
        unset($_SESSION['success_message'], $_SESSION['error_message']);
    }
}
