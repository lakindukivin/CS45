<?php
class ManageOrders {
    use Controller;

    public function index() {
        $orderModel = new ManageOrderModel();
        
        // Get current page and tab from URL
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 5; // items per page

         // Get filter parameters
         $filters = [
            'name' => isset($_GET['filter_name']) ? $_GET['filter_name'] : '',
            'date' => isset($_GET['filter_date']) ? $_GET['filter_date'] : '',
        ];

        $allPendingOrders = $orderModel->getPendingOrders($page, $limit, $filters);
        $totalPending = $orderModel->countPendingOrders($filters);
        $totalPendingPages = ceil($totalPending / $limit);

        $data = [
            'orders' => $allPendingOrders,
            'currentPage' => $page,
            'totalPages' => $totalPendingPages,
            'activeTab' => 'pending',
            'filters' => $filters
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $order_id = $_POST['orderId'];
            $order_status = $_POST['orderStatus'] ?? null;

            // Debugging: Check the value of $order_id and $order_status
            if (empty($order_id)) {
                die("Error: The order_id is missing or empty.");
            }
            if (empty($order_status)) {
                die("Error: The orderStatus is missing or empty.");
            }

            // Check if order_id exists in orders table
            $existingOrder = $orderModel->getOrderById($order_id);
            if (!$existingOrder) {
                die("Error: The order_id does not exist in the orders table.");
            }

            if (isset($_POST['accept_order'])) {
                $orderModel->updateOrderStatus($order_id, 'accepted');
                $orderModel->addCompletedOrder([
                    'order_id' => $order_id,
                    'status' => 'accepted',
                    'message_to_customer' => $_POST['message_to_customer'],
                ]);
                // Redirect with success flag
                header('Location: ' . ROOT . '/ManageOrders?success=1');
                exit();
            } elseif (isset($_POST['reject_order'])) {
                $orderModel->updateOrderStatus($order_id, 'rejected');
                $orderModel->addCompletedOrder([
                    'order_id' => $order_id,
                    'status' => 'rejected',
                    'message_to_customer' => $_POST['message_to_customer'],
                ]);
                // Redirect with error flag
                header('Location: ' . ROOT . '/ManageOrders?error=1');
                exit();
            }
        }
        
        // Check for success or error flags from redirects
        if (isset($_GET['success'])) {
            $data['success'] = true;
        }
        if (isset($_GET['error'])) {
            $data['error'] = true;
        }
        
        $this->view('customerServiceManager/manage_orders', $data);
    }
}

