<?php

class CompletedReviews {

  use Controller;


  public function index() {
      
      
        $reviewModel = new Review();
        $data['reviews'] = $reviewModel->getAllCompletedReviews();
        $this->view('customerServiceManager/completed_reviews',$data);

}
}