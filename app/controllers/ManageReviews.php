<?php
class ManageReviews {
    
    use Controller;
    private $reviewModel;

    public function __construct() {
        $this->reviewModel = new Review();
    }

    public function index() {
        $pendingReviews = $this->reviewModel->getAllPendingReviews();
        $this->view('customerServiceManager/manage_reviews', ['reviews' => $pendingReviews]);
    }

}