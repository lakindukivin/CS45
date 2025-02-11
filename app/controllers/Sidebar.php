<?php 

/**
 * sidebar class  
 */

 class Sidebar {

  use Controller;

  public function index() {
    $this->view('customerServiceManager/sidebar');
  }
 }