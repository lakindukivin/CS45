<?php

class CustomOrderViewForm {
    use Controller;

    public function index($data = [], $id = null) {
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

    public function post($order_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            $reply = trim($_POST['reply'] ?? '');
    
            $orderModel = new PendingCustomOrderModel();
            
            try {
                if ($action === 'decline' && empty($reply)) {
                    throw new Exception("Please provide a reason for declining.");
                }
    
                // Process the action
                if ($action === 'accept') {
                    $orderModel->updateOrderStatus($order_id, 'completed');
                    $_SESSION['success'] = "Order #$order_id has been accepted and marked as completed.";
                } 
                elseif ($action === 'decline') {
                    $orderModel->updateOrderStatus($order_id, 'declined', $reply);
                    $_SESSION['success'] = "Order #$order_id has been declined.";
                }
    
                redirect('CompletedCustomOrders');
                
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                redirect("CustomOrderViewForm/$order_id");
            }
        }
    }
}