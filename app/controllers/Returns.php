<?php

/**
 * Return Class
 */

class Returns {
    use Controller;

    public function index() {
        $returnModel = new ReturnModel();

        // Process filters
        $filters = [
            'name' => $_GET['filter_name'] ?? '',
            'date' => $_GET['filter_date'] ?? ''
        ];
        
        // Pagination parameters
        $limit = 3; // Items per page
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $currentPage = max(1, $currentPage); // Make sure page is at least 1

        // Get filtered or all returns based on filter parameters
        $allPendingReturns = (!empty($filters['name']) || !empty($filters['date'])) 
            ? $returnModel->getFilteredReturns($filters)
            : $returnModel->getAllReturns();
        
        $totalItems = count($allPendingReturns);
        $totalPages = ceil($totalItems / $limit);

        // Ensure current page is valid
        if ($currentPage > $totalPages && $totalPages > 0) {
            $currentPage = $totalPages;
        }

        $offset = ($currentPage - 1) * $limit;
        // Get the paginated returns
        $data['returns'] = array_slice($allPendingReturns, $offset, $limit);
        // Add pagination data to pass to the view
        $data['currentPage'] = $currentPage;
        $data['totalPages'] = $totalPages;
        $data['filters'] = $filters; // Pass filters to the view
        
        // Handle POST requests
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $return_id = $_POST['returnId'];
            $return_status = $_POST['returnStatus'] ?? null;
            $decision_reason = $_POST['decision_reason'] ?? null;

            // Debugging: Check the value of $return_id and $return_status
            if (empty($return_id)) {
                die("Error: The return_id is missing or empty.");
            }
            if (empty($return_status)) {
                die("Error: The returnStatus is missing or empty.");
            }

            // Check if return_id exists in return_item
            $existingReturn = $returnModel->getReturnById($return_id);
            if (!$existingReturn) {
                die("Error: The return_id does not exist in the return_item table.");
            }

            if (isset($_POST['accept_return'])) {
                $returnModel->updateReturnStatus($return_id, 'accepted', $decision_reason);
                $returnModel->addCompletedReturn([
                    'return_id' => $return_id,
                    'order_id' => $_POST['orderId'],
                    'product_id' => $_POST['productId'],
                    'customer_id' => $_POST['customerId'],
                    'status' => 'accepted',
                    'decision_reason' => $decision_reason,
                    'message_to_customer' => $_POST['message_to_customer'],
                ]);

                header("Location: " . ROOT . "/Returns?success=1");
                exit;
            } elseif (isset($_POST['reject_return'])) {
                $returnModel->updateReturnStatus($return_id, 'rejected', $decision_reason);
                $returnModel->addCompletedReturn([
                    'return_id' => $return_id,
                    'order_id' => $_POST['orderId'],
                    'product_id' => $_POST['productId'],
                    'customer_id' => $_POST['customerId'],
                    'status' => 'rejected',
                    'decision_reason' => $decision_reason,
                    'message_to_customer' => $_POST['message_to_customer'],
                ]);

                header("Location: " . ROOT . "/Returns?error=1");
                exit;
            } elseif (isset($_POST['mark_as_returned'])) {
                $returnModel->updateReturnStatus($return_id, 'returned');
                $returnModel->updateCompletedReturn($return_id, [
                    'decision_reason' => $decision_reason,
                    'message_to_customer' => $_POST['message_to_customer'],
                ]);
            }

            // Redirect to avoid form resubmission
            header("Location: " . ROOT . "/Returns?success=1");
            exit;
        }

        $this->view('customerServiceManager/returns', $data);
    }
}