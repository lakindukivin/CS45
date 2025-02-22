<?php

/**
 * Return Class
 */

 class Returns {

  private $returnModel;

  public function __construct() {
    $this->returnModel = new ReturnModel();
  }

  use Controller;

  public function index() {

    $returns = $this->returnModel->getAllReturns();

    $data['returns'] = $returns;

    $this->view('customerServiceManager/returns' , $data);
    
  }
 }