<?php

/**
 * Review class
 */

 class Reviews  {

  use Controller;

  public function index() {
    $reviews = new Review();
    $reviews = $reviews->getAllPendingReviews();
    $this->view('customerServiceManager/reviews', ['reviews' => $reviews]);
  }
 }