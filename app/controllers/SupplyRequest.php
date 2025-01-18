<?php

/**
 * supplyrequest class
 */

 class SupplyRequest{

  use Controller;

  public function index(){
    $this->view('productionManager/supply_request');
  }
  
}