<?php

/**
 * Return Class
 */

 class Returns {

  use Controller;

  public function index() {

    $this->view('customerServiceManager/returns');
    
  }
 }