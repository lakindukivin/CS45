<?php

/**
 * pellets request class
 */

 class PelletsRequests{

  use Controller;

  public function index(){

    $this->view('productionManager/pellets_requests');
  }
 }