<?php

/**
 * completed order class
 */

class CompletedOrders
{
    use Controller;
    public function index()
    {
        $orderModel = new ManageOrderModel();
        
        // Get all completed orders filtered by status
        $allCompletedOrders = $orderModel->getAllCompletedOrders();
        
        // Initialize arrays for each status type
        $data['accepted_orders'] = [];
        $data['shipped_orders'] = [];
        $data['delivered_orders'] = [];
        $data['rejected_orders'] = [];
        
        // Sort orders by status
        if(is_array($allCompletedOrders)) {
            foreach($allCompletedOrders as $order) {
                switch($order->status) {
                    case 'accepted':
                        $data['accepted_orders'][] = $order;
                        break;
                    case 'shipped':
                        $data['shipped_orders'][] = $order;
                        break;
                    case 'delivered':
                        $data['delivered_orders'][] = $order;
                        break;
                    case 'rejected':
                        $data['rejected_orders'][] = $order;
                        break;
                }
            }
        }
        
        // Pass data to view
        $this->view('customerServiceManager/completed_order', $data);
    }
    
    public function updateOrderStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the JSON input
            $input = json_decode(file_get_contents('php://input'), true);

            $orderId = $input['order_id'];
            $status = $input['status'];
            $messageToCustomer = $input['message_to_customer'] ?? '';

            $orderModel = new ManageOrderModel();

            // Update the status in the completed_orders table
            $data = [
                'order_id' => $orderId,
                'status' => $status,
                'message_to_customer' => $messageToCustomer,
            ];

            $result = $orderModel->addCompletedOrder($data);

            if ($result) {
                // Update the status in the orders table as well
                $orderModel->updateOrderStatus($orderId, $status);

                // Return a success response
                echo json_encode(['success' => true]);
                return;
            }
        }

        // Return a failure response
        echo json_encode(['success' => false]);
    }
}
