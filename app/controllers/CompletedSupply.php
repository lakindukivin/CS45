<?php

/**
 * completed supply class
 */

 class CompletedSupply{

  use Controller;

  public function index(){

    $this->view('productionManager/completed_sup_req');
  }
 }