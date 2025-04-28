<?php
class PelletsRequestsViewForm {
    use Controller;
    private $pelletsRequestsModel;

    public function index($data = [], $id = null) {
        // Session management
        if (session_status() == PHP_SESSION_NONE) session_start();
        
        // Authentication check
        if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 3) {
            redirect('login');
        }

        if (!$id) {
            $_SESSION['error'] = "No order ID provided.";
            redirect('PelletsRequests');
            exit;
        }

        // Get order data
        $orderModel = new PelletsRequestsModel();
        $order = $orderModel->getById($id);
        
        if (empty($order)) {
            $_SESSION['error'] = "Order not found.";
            // Handle case where order is not found
            redirect('PelletRequests');
            exit;
        }

        $data['order'] = $order;
        $this->view('productionManager/pellets_requests_view_form', $data);
    }

    public function post() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_id = $_POST['order_id'] ?? null;
            $action = $_POST['action'] ?? '';
            $reply = trim($_POST['reply'] ?? '');

            $orderModel = new PelletsRequestsModel();
            
            try {
                if ($action === 'decline') {
                    if (empty($reply)) {
                        throw new Exception("Please provide a reason for declining.");
                    }
                    $orderModel->updateOrderStatus($order_id, 'declined', $reply);
                    $_SESSION['success'] = "Order #$order_id has been declined.";
                } elseif ($action === 'accept') {
                    $orderModel->updateOrderStatus($order_id, 'accepted');
                    $_SESSION['success'] = "Order #$order_id has been accepted and marked as completed.";
                }
    
                redirect('CompletedPellets');
                
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                redirect("PelletsRequestsViewForm/index/$order_id");
            }
        }
    }

    // private function handleDecline($model, $order_id, $reason) {
    //     if (empty($reason)) {
    //         throw new Exception("Please provide a reason for declining.");
    //     }
    //     $result = $model->updateOrderStatus($order_id, 'declined', $reason);
    //     $_SESSION['success'] = "Pellet order #$order_id has been declined.";
    // }

    // private function handleAccept($model, $order_id) {
    //     $result = $model->updateOrderStatus($order_id, 'completed');
    //     $_SESSION['success'] = "Pellet order #$order_id has been accepted and marked as completed.";
    // }

    // private function setErrorAndRedirect($message, $route) {
    //     $_SESSION['error'] = $message;
    //     redirect($route);
    //     exit;
    // }
}