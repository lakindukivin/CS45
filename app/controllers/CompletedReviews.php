<?php

class CompletedReviews {

  use Controller;


  public function index() {
    $reviewModel = new Review();
    $data['reviews'] = $reviewModel->getAllCompletedReviews();
    $this->view('customerServiceManager/completed_reviews', $data);
  }

  public function updateReply() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $replyId = $_POST['reply_id'];
        $replyText = $_POST['reply'];

        if (!empty($replyText)) {
            $reviewModel = new Review();
            $result = $reviewModel->updateReply($replyId, $replyText);

            if ($result) {
                header("Location: " . ROOT . "/CompletedReviews?success=1"); // Redirect with success flag
                exit;
            } else {
                header("Location: " . ROOT . "/CompletedReviews?error=1"); // Redirect with error flag
                exit;
            }
        } else {
            header("Location: " . ROOT . "/CompletedReviews?error=1"); // Redirect with error flag
            exit;
        }
    }
  }
}