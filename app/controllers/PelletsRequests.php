<?php

/**
 * pellets request class
 */

 class PelletsRequests{

  use Controller;

  private $pelletsRequestsModel;

  public function __construct() {
        $this->pelletsRequestsModel = new PelletsRequestsModel();
    }

  public function index(){

    $orders = $this->pelletsRequestsModel->getAll();
    $this->view('productionManager/pellets_requests', ['orders' => $orders]);
  }

  public function getOrderDetails()
  {
        if(isset($_POST['orderId'])) {
            $model = new PelletsRequestsModel();
            $orderDetails = $model->getOrderDetails($_POST['orderId']);
            echo json_encode($orderDetails);
            exit;
        }
  }

  public function updateStatus()
  {
        if(isset($_POST['orderId']) && isset($_POST['status'])) {
            $model = new PelletsRequestsModel();
            $result = $model->updateOrderStatus($_POST['orderId'], $_POST['status']);
            echo json_encode(['success' => $result]);
            exit;
        }
  }
  
 }