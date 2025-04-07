<?php

/**
 * Return Class
 */

 class Returns {

  use Controller;

  public function index() {
    $returnModel = new ReturnModel();
    $data['returns'] = $returnModel->getAllReturns();
    $this->view('customerServiceManager/returns' , $data);
    
  }
 }