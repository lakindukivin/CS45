<?php

/**
 * production Manager home class
 */

class ProductionManagerHome
{
    use Controller;
    private $pendingCustomOrderModel;
    private $pelletsRequestsModel;
    public function __construct() {
        $this->pendingCustomOrderModel = new PendingCustomOrderModel();
        $this->pelletsRequestsModel = new PelletsRequestsModel();
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
        if ($_SESSION['role_id'] != 3) {
            redirect('login');
        }

        // Fetch new orders
        $data = [
            'pendingCustomOrders' => $this->pendingCustomOrderModel->countPendingOrders(),
            'pendingPelletsOrders' => $this->pelletsRequestsModel->countPendingOrders()
        ];

        $this->view('productionManager/productionManagerHome', $data);
    }

    //dynamically updates the new orders
    public function getOrderCounts() {
        $customCount = $this->pendingCustomOrderModel->countPendingOrders();
        $pelletsCount = $this->pelletsRequestsModel->countPendingOrders();
        
        echo json_encode([  
            'custom' => $customCount,
            'pellets' => $pelletsCount,
            'total' => $customCount + $pelletsCount
        ]);
        exit;
    }
}
