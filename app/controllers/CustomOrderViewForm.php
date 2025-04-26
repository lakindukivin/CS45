<?php

class CustomOrderViewForm {
    use Controller;
    private $pendingCustomOrderModel;

    public function index($data = [], $id = null) {
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
        if (!$id) {
            $_SESSION['error'] = "No order ID provided.";
            redirect('PendingCustomOrder');
            exit;
        }

        $orderModel = new PendingCustomOrderModel();
        $order = $orderModel->getById($id); // Fetch order details

        if (empty($order)) {
            $_SESSION['error'] = "Order not found.";
            // Handle case where order is not found
            redirect('PendingCustomOrder');
            exit;
        }

        $data['order'] = $order; // Assuming `where()` returns an array
        
        $this->view('productionManager/custom_order_view_form', $data);
    }

    public function post() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_id = $_POST['order_id'] ?? null;
            $action = $_POST['action'] ?? '';
            $reason = trim($_POST['reason'] ?? '');

            $orderModel = new PendingCustomOrderModel();

            // if (!$order_id) {
            //     $_SESSION['error'] = "No order ID provided.";
            //     redirect('PendingCustomOrder');
            //     exit;
            // }
    
            
    
            
            
            try {
                if ($action === 'decline') {
                    if (empty($reason)) {
                        throw new Exception("Please provide a reason for declining.");
                    }
                    $orderModel->updateOrderStatus($order_id, 'declined', $reason);
                    $_SESSION['success'] = "Order #$order_id has been declined.";
                } elseif ($action === 'accept') {
                    $orderModel->updateOrderStatus($order_id, 'completed');
                    $_SESSION['success'] = "Order #$order_id has been accepted and marked as completed.";
                }
    
                redirect('CompletedCustomOrders');
                
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                redirect("CustomOrderViewForm/index/$order_id");
            }
        }
    }
}