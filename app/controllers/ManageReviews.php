<?php
class ManageReviews {
    
    use Controller;
   
    public function index() {
        $reviewModel = new Review();
        $data['reviews'] = $reviewModel->getAllPendingReviews();
        $this->view('customerServiceManager/manage_reviews', $data);
    }

    public function addReply() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviewId = $_POST['review_id'];
            $replyText = trim($_POST['reply']); // Trim whitespace to avoid empty replies

            if (empty($replyText)) {
                // Redirect back with an error flag if the reply is empty
                header("Location: " . ROOT . "/ManageReviews?error=1");
                exit;
            }

            $reviewModel = new Review();

            // Add the reply to the reply table
            $reviewModel->addReply($reviewId, $replyText);

            // Update the review status to "replied"
            $reviewModel->updateReviewStatus($reviewId, 'replied');

            // Redirect back to the reviews page with a success flag
            header("Location: " . ROOT . "/ManageReviews?success=1");
            exit;
        }
    }

}