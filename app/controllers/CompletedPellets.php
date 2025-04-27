<?php
 class CompletedPellets{

  use Controller;

  public function index(){
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

  $orderModel = new pelletsRequestsModel(); // You might want a specific method for this
  $completedPellets = $orderModel->getOrdersByStatus('accepted') ?:[];
  $declinedPellets = $orderModel->getOrdersByStatus('declined')?:[]; 
  $allPellets = array_merge($completedPellets, $declinedPellets);

  usort($allPellets, function($a, $b) {
    return $b->pelletOrder_id - $a->pelletOrder_id; // Newest first (higher IDs first)
});

  $data['allPellets'] = $allPellets;
  $this->view('productionManager/completed_pellets', $data);
  }
 }