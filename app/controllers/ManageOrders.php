<?php
class ManageOrders {
    use Controller;

    public function index() {
        $orderModel = new ManageOrderModel();
        $data['orders'] = $orderModel->getAllOrders();
        $this->view('customerServiceManager/manage_orders', $data);
    }

    }

