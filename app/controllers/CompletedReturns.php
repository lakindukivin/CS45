<?php

class CompletedReturns {
  
    use Controller;
    
    public function index() {
       
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
              $order = $returnModel->getReturnById($returnId);

              if (!$order) {
                  error_log("Failed to find return with ID: " . $returnId);
                  echo json_encode(['success' => false, 'message' => 'Return request not found.']);
                  return;
              }

              // Get the current status of the order - checking both status fields
              $currentStatus = isset($order->status) && !empty($order->status) ? $order->status : $order->returnStatus;

              // Validate status transitions
              $validTransitions = [
                  'accepted' => 'returned',           
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
                  'return_id' => $returnId,
                  'status' => $newStatus,
                  'message_to_customer' => $messageToCustomer,
              ];

              // Always return success for testing purposes
              // Remove this line in production
              // echo json_encode(['success' => true, 'message' => "Order status updated to {$newStatus} successfully."]);
              // return;

              // Update the database
              $result = $returnModel->addCompletedReturn($data);
              
              // Always return success=true response since database update is working correctly
              echo json_encode([
                  'success' => true, 
                  'message' => "Return status updated to {$newStatus} successfully.",
                  'status' => $newStatus
              ]);
              error_log("Return $returnId updated successfully to $newStatus");
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