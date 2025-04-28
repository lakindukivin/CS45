<?php

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
        $staffModel = new ManageStaffAccountsModel();
        $issuesModel = new IssuesModel(); // Need to create or use existing issues model

        // Get counts
        $totalCustomers = $customerModel->getCustomersCount();
        $totalStaff = $staffModel->getStaffCount();

        // Get recent issues for notifications (8 most recent)
        $recentIssues = $issuesModel->getRecentIssues(8);

        // Process issues into notification format
        $notifications = [];
        if (!empty($recentIssues)) {
            foreach ($recentIssues as $issue) {
                $notifications[] = [
                    'type' => 'issue',
                    'id' => $issue->issue_id,
                    'timestamp' => strtotime($issue->created_at ?? date('Y-m-d H:i:s')),
                    'message' => "New issue reported: " . substr($issue->description, 0, 50) . "...",
                    'status' => $issue->status == 1 ? 'Resolved' : 'Pending',
                    'email' => $issue->email
                ];
            }
        }

        $this->view('admin/adminHome', [
            'totalCustomers' => $totalCustomers,
            'totalStaff' => $totalStaff,
            'notifications' => $notifications
        ]);
    }
}
