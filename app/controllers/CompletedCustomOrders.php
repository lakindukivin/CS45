<?php

class CompletedCustomOrders{

  use Controller;

  public function index(){
    $this->view('productionManager/completed_custom_orders');
  }
}