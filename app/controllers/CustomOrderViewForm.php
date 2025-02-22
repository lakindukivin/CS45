<?php

class CustomOrderViewForm {

  use Controller;

  public function index() {
    $this->view('productionManager/custom_order_view_form');
  }
}