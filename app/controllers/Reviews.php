<?php

/**
 * Review class
 */

class Reviews {

    use Controller;

    private $reviewModels;

    public function __construct() {
        $this->reviewModels = new Review();
    }

    public function index($review_id = null) {
      if (!$review_id) {
          redirect('ManageReviews');
      }
  
      $reviewData = $this->reviewModels->getReviewDetails($review_id);
  
      if ($reviewData) {
          $data['review'] = [
              'review_id' => $reviewData['review_id'],
              'customer_id' => $reviewData['customer_id'],
              'order_id' => $reviewData['order_id'],
              'rating' => $reviewData['rating'],
              'comment' => $reviewData['comment'],
              'date' => $reviewData['date'],
              'customer_name' => $reviewData['customer_name']
          ];
          
          $this->view('customerServiceManager/reviews', $data);
      } else {
          redirect('ManageReviews');
      }
  }
  

    public function reply() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'review_id' => $_POST['review_id'],
                'reply' => $_POST['reply']
            ];

            if ($this->reviewModels->addReply($data)) {
                $_SESSION['success_message'] = "Reply added successfully";
            } else {
                $_SESSION['error_message'] = "Failed to add reply";
            }
            redirect('ManageReviews');
        }
    }

    public function update($id = null) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'reply_id' => $id,
                'reply' => $_POST['reply']
            ];

            if ($this->reviewModel->updateReply($data)) {
                $_SESSION['success_message'] = "Reply updated successfully";
            } else {
                $_SESSION['error_message'] = "Failed to update reply";
            }
            redirect('ManageReviews/replied');
        }
    }

    public function delete($id = null) {
        if ($this->reviewModel->deleteReply($id)) {
            $_SESSION['success_message'] = "Reply deleted successfully";
        } else {
            $_SESSION['error_message'] = "Failed to delete reply";
        }
        redirect('ManageReviews/replied');
    }

    public function replied() {
        $repliedReviews = $this->reviewModel->getRepliedReviews();
        $this->view('customerServiceManager/replied_reviews', ['reviews' => $repliedReviews]);
    }
}
