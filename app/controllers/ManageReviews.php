<?php

/**
 * ManageReviews class
 **/

class ManageReviews {

  use Controller;

  public function index() {

    $this->view('customerServiceManager/manage_reviews');
  }
}