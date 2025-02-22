<?php

class CompletedReviews {

  use Controller;

  private $reviewModel;

    public function __construct() {
        $this->reviewModel = new Review();
    }

  public function index() {
        $completedReviews = $this->reviewModel->getRepliedReviews();

        $this->view('customerServiceManager/completed_reviews' ,['reviews' => $completedReviews]);

}
}