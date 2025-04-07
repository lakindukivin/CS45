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

}
