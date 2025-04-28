<?php

class PendingCustomOrder {
    
    use Controller;
    private $pendingCustomOrderModel;

    public function __construct() {
        $this->pendingCustomOrderModel = new PendingCustomOrderModel();
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
        $orders = $this->pendingCustomOrderModel->getAll();
        $this->view('productionManager/pending_custom_orders', ['orders' => $orders]);
    }

    public function getOrderDetails()
    {
        if(isset($_POST['orderId'])) {
            $model = new PendingCustomOrderModel();
            $orderDetails = $model->getOrderDetails($_POST['orderId']);
            echo json_encode($orderDetails);
            exit;
        }
    }

    public function updateStatus() {
        if(isset($_POST['orderId']) && isset($_POST['status'])) {
            $allowed_statuses = ['pending', 'accepted', 'completed', 'declined']; // Add all valid statuses
            if(!in_array($_POST['status'], $allowed_statuses)) {
                echo json_encode(['success' => false, 'error' => 'Invalid status']);
                exit;
            }
            
            $model = new PendingCustomOrderModel();
            $result = $model->updateOrderStatus($_POST['orderId'], $_POST['status']);
            echo json_encode(['success' => $result]);
            exit;
        }
    }
}
