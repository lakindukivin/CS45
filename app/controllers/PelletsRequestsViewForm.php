    <?php

    class PelletsRequestsViewForm {
        use Controller;
        private $pelletsRequestsModel;

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

            $orderModel = new pelletsRequestsModel();
            $order = $orderModel->getById($id); // Fetch order details

            if (empty($order)) {
                $_SESSION['error'] = "Order not found.";
                // Handle case where order is not found
                redirect('PelletsRequests');
                exit;
            }

            $data['order'] = $order; // Assuming `where()` returns an array
            
            $this->view('productionManager/pellets_requests_view_form', $data);
        }

        public function post() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $order_id = $_POST['order_id'] ?? null;
                if (!$order_id) {
                    $_SESSION['error'] = "No order ID provided.";
                    redirect('PelletsRequests');
                    exit;
                }
        
                $action = $_POST['action'] ?? '';
                $reply = trim($_POST['reply'] ?? '');
        
                $orderModel = new pelletsRequestsModel();
                
                try {
                    if ($action === 'decline' && empty($reply)) {
                        throw new Exception("Please provide a reason for declining.");
                    }
        
                    if ($action === 'accept') {
                        $orderModel->updateOrderStatus($order_id, 'completed');
                        $_SESSION['success'] = "Order #$order_id has been accepted and marked as completed.";
                    } elseif ($action === 'decline') {
                        $orderModel->updateOrderStatus($order_id, 'declined', $reply);
                        $_SESSION['success'] = "Order #$order_id has been declined.";
                    }
        
                    redirect('CompletedPellets');
                    
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    redirect("PelletsRequestsViewForm/index/$order_id");
                }
            }
        }
    }