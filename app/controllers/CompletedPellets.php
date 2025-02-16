<?php

/**
 *completed pellets request class
 */

 class CompletedPellets{

  use Controller;

  public function index(){

    $this->view('productionManager/completed_pellets');
  }
 }