<?php

class RecycledPolythene {
    use Controller;
    private $polytheneModel;

    public function __construct() {
        $this->polytheneModel = new PolytheneAmount();
    }

    public function index() {
        // Ensure session is active
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Redirect to login if user is not authenticated
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
        }

        // Check if the user has the right role to access this page
        if ($_SESSION['role_id'] != 3) {
            redirect('login');
        }

        $data = [];
        // Get all existing months to prevent duplicates
        $existingMonths = $this->polytheneModel->getAllMonths()?:[];
        $data['existingMonths'] = array_column($existingMonths, 'month');
        $data['success'] = isset($_SESSION['success']) ? $_SESSION['success'] : '';
        unset($_SESSION['success']);
        $this->view('productionManager/recycled_polythene', $data);
    }

    public function updateAmount() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $month = $_POST['month'];
            // Check if month already exists (unless we're updating)
            if(empty($_POST['is_update']) && $this->polytheneModel->monthExists($month)) {
                $_SESSION['error'] = "Data for $month already exists!";
                redirect('RecycledPolythene');
                return;
        }
            $data = [
                'polythene_amount' => $_POST['polythene_amount'], // Changed to match your table column
                'message' => $_POST['message'],
                'month' => $_POST['month'],
                'updated_date' => date('Y-m-d H:i:s')
            ];

            if($this->polytheneModel->updateAmount($data)) {
                redirect('PolytheneAmount?month=' . urlencode($month));
            }
        }
    }
    
    public function PolytheneAmount() {
        $data['amounts'] = $this->polytheneModel->getAllAmounts();
        $this->view('productionManager/polythene_amount', $data);
    }
}