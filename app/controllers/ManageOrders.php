<?php
class ManageOrders {
    use Controller;
    private $orderModel;

    public function __construct() {
        $this->orderModel = new ManageOrderModel();
    }

    public function index() {
        $orders = $this->orderModel->getAllOrders();
        $this->view('customerServiceManager/manage_orders', ['orders' => $orders]);
    }

    public function updateStatus() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $orderId = $_POST['order_id'];
            $status = $_POST['status'];
            $result = $this->orderModel->updateOrderStatus($orderId, $status);
            echo json_encode(['success' => $result]);
        }
    }
}
