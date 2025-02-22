<?php

class CompletedCustomOrders{

  use Controller;

  public function index(){
    $this->view('customerServiceManager/completed_custom_orders');
  }
}