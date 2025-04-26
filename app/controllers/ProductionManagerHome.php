<?php

/**
 * production Manager home class
 */

class ProductionManagerHome
{
    use Controller;
    private $pendingCustomOrderModel;
    private $pelletsRequestsModel;
    private $polytheneAmount;
    public function __construct() {
        $this->pendingCustomOrderModel = new PendingCustomOrderModel();
        $this->pelletsRequestsModel = new PelletsRequestsModel();
        $this->polytheneAmount = new PolytheneAmount();
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

         // Get latest polythene amount
         $latestAmount = $this->polytheneAmount->getLatestAmount();
         $polytheneAmount = !empty($latestAmount) ? $latestAmount[0]->polythene_amount : 0;

        // Fetch new orders
        $data = [
            'pendingCustomOrders' => $this->pendingCustomOrderModel->countPendingOrders(),
            'pendingPelletsOrders' => $this->pelletsRequestsModel->countPendingOrders(),
            'polytheneAmount' => $polytheneAmount
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

    //dynamically updates the recycled polythene amount
    public function getPolytheneAmount() {
        $latestAmount = $this->polytheneAmount->getLatestAmount();
        echo json_encode([
            'amount' => !empty($latestAmount) ? $latestAmount[0]->polythene_amount : 0
    ]);
    exit;
}
}
