<?php
 class SupplyRequest{

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

  $supplyRequestModel = new SupplyRequestModel();
        $data['stockItems'] = $supplyRequestModel->getLowStockItems();
        
        $this->view('productionManager/supply_request', $data);
  }

  public function post() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate and sanitize input
        $productId = $_POST['product_id'] ?? null;
        $packId = $_POST['pack_id'] ?? null;
        $bagId = $_POST['bag_id'] ?? null;
        $quantityToAdd = $_POST['quantity'] ?? null;
        $action = $_POST['action'] ?? null;

        if ($action === 'add' && $productId && $packId && $bagId && $quantityToAdd && $quantityToAdd > 0) {
            $supplyRequestModel = new SupplyRequestModel();
            
            // Add to the existing quantity
            $success = $supplyRequestModel->addToStock($productId, $packId, $bagId, $quantityToAdd);
            
            if ($success) {
                $_SESSION['message'] = "Successfully added $quantityToAdd items to stock!";
            } else {
                $_SESSION['error'] = "Failed to add to stock. Please try again.";
            }
        } else {
            $_SESSION['error'] = "Invalid input data. Please enter a valid quantity.";
        }
    }
    
    redirect('SupplyRequest');
}
  
}