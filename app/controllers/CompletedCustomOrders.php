<?php

class CompletedCustomOrders{

  use Controller;
  private $pendingCustomOrderModel;

  public function index() {
    $orderModel = new PendingCustomOrderModel(); // You might want a specific method for this
    $completedOrders = $orderModel->getOrdersByStatus('completed'); // Fetch completed orders

    $data['completedOrders'] = $completedOrders;
    $this->view('productionManager/completed_custom_orders', $data);
}

}