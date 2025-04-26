<?php

class CompletedCustomOrders{

  use Controller;
  private $pendingCustomOrderModel;

  public function index() {
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
    $orderModel = new PendingCustomOrderModel(); // You might want a specific method for this
    $completedOrders = $orderModel->getOrdersByStatus('completed'); // Fetch completed orders
    $declinedOrders = $orderModel->getOrdersByStatus('declined');
    $allOrders = array_merge($completedOrders, $declinedOrders);

    usort($allOrders, function($a, $b) {
      return $b->customOrder_id - $a->customOrder_id; // Newest first (higher IDs first)
  });

    $data = [
      'allOrders' => $allOrders 
  ];
    $this->view('productionManager/completed_custom_orders', $data);
}

}