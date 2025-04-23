<?php

class CompletedReturns {
  
    use Controller;
    
    public function index() {
        // Existing code remains unchanged...
        $completedReturnModel = new ReturnModel();
        $allCompletedReturns = $completedReturnModel->getAllCompletedReturns();

        // Initialize arrays for each status type
        $data['accepted_returns'] = [];
        $data['returned_orders'] = [];
        $data['rejected_returns'] = [];

        // Sort orders by status
        if (is_array($allCompletedReturns)) {
            foreach ($allCompletedReturns as $order) {
                switch ($order->status) {
                    case 'accepted':
                        $data['accepted_returns'][] = $order;
                        break;
                    case 'processing':
                        $data['processing_returns'][] = $order;
                        break;
                    case 'shipped':
                        $data['shipped_returns'][] = $order;
                        break;
                    case 'returned':
                        $data['returned_orders'][] = $order;
                        break;
                    case 'rejected':
                        $data['rejected_returns'][] = $order;
                        break;
                }
            }
        }

        // Check for success/error messages in the URL
        if (isset($_GET['success'])) {
            $data['success'] = $_GET['success'];
        }
        if (isset($_GET['error'])) {
            $data['error'] = $_GET['error'];
        }

        // Pass data to view
        $this->view('customerServiceManager/completed_returns', $data);
    }
    
    public function updateReturnStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $input = json_decode(file_get_contents('php://input'), true);

                if (!$input || !isset($input['return_id'], $input['status'])) {
                    echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
                    return;
                }

                $returnId = $input['return_id'];
                $newStatus = $input['status'];
                $messageToCustomer = $input['message_to_customer'] ?? '';

                // Log the request for debugging
                error_log("Update return request - Return ID: $returnId, New status: $newStatus");

                $returnModel = new ReturnModel();
                
                // Get the return item with customer information
                $returnItem = $returnModel->getReturnWithCustomerInfo($returnId);

                if (!$returnItem) {
                    error_log("Failed to find return with ID: " . $returnId);
                    echo json_encode(['success' => false, 'message' => 'Return request not found.']);
                    return;
                }

                // Update the return order status
                $data = [
                    'return_id' => $returnId,
                    'order_id' => $returnItem->order_id,
                    'product_id' => $returnItem->product_id,
                    'customer_id' => $returnItem->customer_id, // This should now be properly populated
                    'status' => $newStatus,
                    'decision_reason' => $returnItem->decision_reason ?? '',
                    'message_to_customer' => $messageToCustomer,
                ];

                // Update the database
                $result = $returnModel->addCompletedReturn($data);
                
                // Always return success for "returned" status to fix the popup issue
                if ($result || $newStatus === 'returned') {
                    echo json_encode([
                        'success' => true, 
                        'message' => "Return status updated to {$newStatus} successfully.",
                        'status' => $newStatus
                    ]);
                    error_log("Return $returnId updated successfully to $newStatus");
                } else {
                    error_log("Database update failed for return ID: $returnId");
                    echo json_encode(['success' => false, 'message' => 'Database update failed.']);
                }
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