<?php

/**
 * admin home class
 */

class AdminHome
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

        // Check if the user has the right role to access this page
        if ($_SESSION['role_id'] != 1) {
            redirect('login');
        }

        // Load models
        $customerModel = new ManageCustomerAccountsModel();
        $staffModel = new ManageStaffAccountsModel(); // You need to have this model

        // Get counts
        $totalCustomers = $customerModel->getCustomersCount();
        $totalStaff = $staffModel->getStaffCount(); // Implement getStaffCount() in staff model

        $this->view('admin/adminHome', [
            'totalCustomers' => $totalCustomers,
            'totalStaff' => $totalStaff,
        ]);
    }
}
