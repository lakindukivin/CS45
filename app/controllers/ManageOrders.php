<?php

/**
 * ManageOrders class
 */
 
 class ManageOrders {

  use Controller;

  public function index() {

    $this->view('customerServiceManager/manage_orders');
  }

 }