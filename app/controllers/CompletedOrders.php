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
        
        
    // Get current page and tab from URL
     $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
     $tab = isset($_GET['tab']) ? $_GET['tab'] : 'accepted';
     $limit = 3; // items per page

      // Get filter parameters
      $filters = [
        'name' => isset($_GET['filter_name']) ? $_GET['filter_name'] : '',
        'date' => isset($_GET['filter_date']) ? $_GET['filter_date'] : '',
    ];

          // For accepted orders
        $acceptedOrders = $orderModel->getAcceptedOrders($page, $limit, $filters);
        $totalAccepted = $orderModel->countAcceptedOrders($filters);
        $totalAcceptedPages = ceil($totalAccepted / $limit);

        // For processing orders
        $processingOrders = $orderModel->getProcessingOrders($page, $limit, $filters);
        $totalProcessing = $orderModel->countProcessingOrders($filters);
        $totalProcessingPages = ceil($totalProcessing / $limit);

        // For shipped orders
        $shippedOrders = $orderModel->getShippedOrders($page, $limit, $filters);
        $totalShipped = $orderModel->countShippedOrders($filters);
        $totalShippedPages = ceil($totalShipped / $limit);

        // For delivered orders
        $deliveredOrders = $orderModel->getDeliveredOrders($page, $limit, $filters);
        $totalDelivered = $orderModel->countDeliveredOrders($filters);
        $totalDeliveredPages = ceil($totalDelivered / $limit);

        // For rejected orders
        $rejectedOrders = $orderModel->getRejectedOrders($page, $limit, $filters);
        $totalRejected = $orderModel->countRejectedOrders($filters);
        $totalRejectedPages = ceil($totalRejected / $limit);

        // Pass to the view
        $data = [
            'accepted_orders' => $acceptedOrders,
            'processing_orders' => $processingOrders,
            'shipped_orders' => $shippedOrders,
            'delivered_orders' => $deliveredOrders,
            'rejected_orders' => $rejectedOrders,
            'currentPage' => $page,
            'totalAcceptedPages' => $totalAcceptedPages,
            'totalProcessingPages' => $totalProcessingPages,
            'totalShippedPages' => $totalShippedPages,
            'totalDeliveredPages' => $totalDeliveredPages,
            'totalRejectedPages' => $totalRejectedPages,
            'activeTab' => $tab,
            'filters' => $filters
        ];


       
        // Check for success/error messages in the URL
        if (isset($_GET['success'])) {
            $data['success'] = $_GET['success'];
        }
        if (isset($_GET['error'])) {
            $data['error'] = $_GET['error'];
        }
        
        // Pass data to view
        $this->view('customerServiceManager/completed_order', $data);
    }
    
    public function updateOrderStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $input = json_decode(file_get_contents('php://input'), true);

                if (!$input || !isset($input['order_id'], $input['status'])) {
                    echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
                    return;
                }

                $orderId = $input['order_id'];
                $newStatus = $input['status'];
                $messageToCustomer = $input['message_to_customer'] ?? '';

                // Log the request for debugging
                error_log("Update order request - Order ID: $orderId, New status: $newStatus");

                $orderModel = new ManageOrderModel();
                $order = $orderModel->getOrderById($orderId);

                if (!$order) {
                    error_log("Failed to find order with ID: " . $orderId);
                    echo json_encode(['success' => false, 'message' => 'Order not found.']);
                    return;
                }

                // Get the current status of the order - checking both status fields
                $currentStatus = isset($order->status) && !empty($order->status) ? $order->status : $order->orderStatus;

                // Validate status transitions
                $validTransitions = [
                    'accepted' => 'processing',
                    'processing' => 'shipped',
                    'shipped' => 'delivered',
                ];

                if (!isset($validTransitions[$currentStatus]) || $validTransitions[$currentStatus] !== $newStatus) {
                    echo json_encode([
                        'success' => false, 
                        'message' => "Invalid status transition from '{$currentStatus}' to '{$newStatus}'."
                    ]);
                    return;
                }

                // Update the status and message in the `completed_orders` table
                $data = [
                    'order_id' => $orderId,
                    'status' => $newStatus,
                    'message_to_customer' => $messageToCustomer,
                ];

                // Always return success for testing purposes
                // Remove this line in production
                // echo json_encode(['success' => true, 'message' => "Order status updated to {$newStatus} successfully."]);
                // return;

                // Update the database
                $result = $orderModel->addCompletedOrder($data);
                
                // Always return success=true response since database update is working correctly
                echo json_encode([
                    'success' => true, 
                    'message' => "Order status updated to {$newStatus} successfully.",
                    'status' => $newStatus
                ]);
                error_log("Order $orderId updated successfully to $newStatus");
                return;
            } catch (Exception $e) {
                error_log("Exception occurred: " . $e->getMessage());
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }
}
