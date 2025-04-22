<?php

/**
 * ManageStaffAccounts class
 */

class ManageStaffAccounts
{
    use Controller;

    private $manageStaffAccountsModel;
    private $userModel;

    public function __construct()
    {
        $this->manageStaffAccountsModel = new ManageStaffAccountsModel();
        $this->userModel = new User();
    }
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

        // Check if the user has the right role to access this page
        if ($_SESSION['role_id'] != 1) {
            redirect('login');
        }

        $limit = 10;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        if ($search !== '') {
            $staffAccounts = $this->manageStaffAccountsModel->searchStaff($search, $limit, $offset);
            $totalStaff = $this->manageStaffAccountsModel->searchStaffCount($search);
        } else {
            $staffAccounts = $this->manageStaffAccountsModel->getStaffPaginated($limit, $offset);
            $totalStaff = $this->manageStaffAccountsModel->getStaffCount();
        }
        $totalPages = ceil($totalStaff / $limit);
        $this->view('admin/manageStaffAccounts', [
            'staffAccounts' => $staffAccounts,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'search' => $search,
        ]);
    }

    public function getSingleStaff()
    {

        if (isset($_POST['staff_id'])) {
            $singleStaff = $this->manageStaffAccountsModel->findById($_POST['staff_id']);
            echo json_encode($singleStaff);
            exit;
        }

    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                // 'image' => $_POST['image'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
                'role' => $_POST['role'],
                'status' => 1

            ];

            if ($this->manageStaffAccountsModel->addStaff($data)) {
                $_SESSION['success'] = "Successfully Added!";
                header("Location: " . ROOT . "/manageStaffAccounts");
                exit();
            }
        }
    }

    // ...existing code...
    public function addStaffWithUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // 1. Insert into user table
            $userData = [
                'email' => $_POST['email'],
                'password' => password_hash('defaultpassword', PASSWORD_BCRYPT), // Set a default or random password
                'role_id' => $_POST['role']

            ];

            $user_id = $this->userModel->addUser($userData);


            // 2. Insert into staff table
            $staffData = [
                'name' => $_POST['name'],
                'address' => $_POST['address'],
                'phone' => $_POST['phone'],
                // 'image' => $_POST['image'],
                'role_id' => $_POST['role'],
                'user_id' => $user_id, // Use the user_id from the user table
                'status' => 1
            ];

            if ($this->manageStaffAccountsModel->addStaff($staffData)) {
                $_SESSION['success'] = "Successfully Added!";
                header("Location: " . ROOT . "/manageStaffAccounts");
                exit();
            } else {
                $_SESSION['error'] = "Failed to add staff!";
                header("Location: " . ROOT . "/manageStaffAccounts");
                exit();
            }
            // else {
            //     // If adding staff fails, delete the user record
            //     // $this->userModel->deleteUser($user_id);
            //     $_SESSION['error'] = "Failed to add staff. User record deleted.";
            // }



        }
    }


    //update staff details
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['staff_id'])) {
                $data = [
                    'staff_id' => $_POST['staff_id'],
                    'name' => $_POST['editStaffName'],
                    'image' => $_POST['editImage'],
                    'email' => $_POST['editStaffEmail'],
                    'phone' => $_POST['editStaffContactNo'],
                    'address' => $_POST['editStaffAddress'],
                    'role' => $_POST['editStafrole'],
                    'status' => $_POST['status']
                ];

                if ($this->manageStaffAccountsModel->updateStaff($_POST['staff_id'], $data)) {
                    $_SESSION['success'] = "Successfully updated!";
                    header("Location: " . ROOT . "/manageStaffAccounts");
                    exit();
                }
            }
        }
    }

    //Delete staff
    public function delete()
    {
        if (isset($_POST['staff_id'])) {
            if ($this->manageStaffAccountsModel->DeleteStaff($_POST['staff_id'])) {
                $_SESSION['success'] = "Successfully deleted!";
                header("Location: " . ROOT . "/manageStaffAccounts");
                exit();
            }
        }
    }

    public function restore()
    {
        if (isset($_POST['staff_id'])) {
            if ($this->manageStaffAccountsModel->RestoreStaff($_POST['staff_id'])) {
                $_SESSION['success'] = "Successfully restored!";
                header("Location: " . ROOT . "/manageStaffAccounts");
                exit();
            }
        }
    }
}