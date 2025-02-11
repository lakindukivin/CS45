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

    public function reply() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'review_id' => $_POST['review_id'],
                'reply' => $_POST['reply']
            ];
            
            if($this->reviewModel->addReply($data)) {
                $_SESSION['success_message'] = "Reply added successfully";
            } else {
                $_SESSION['error_message'] = "Failed to add reply";
            }
            redirect('manageReviews');
        }
    }

    public function update($id = null) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'reply_id' => $id,
                'reply' => $_POST['reply']
            ];
            
            if($this->reviewModel->updateReply($data)) {
                $_SESSION['success_message'] = "Reply updated successfully";
            } else {
                $_SESSION['error_message'] = "Failed to update reply";
            }
            redirect('manageReviews/replied');
        }
    }

    public function delete($id = null) {
        if($this->reviewModel->deleteReply($id)) {
            $_SESSION['success_message'] = "Reply deleted successfully";
        } else {
            $_SESSION['error_message'] = "Failed to delete reply";
        }
        redirect('manageReviews/replied');
    }

    public function replied() {
        $repliedReviews = $this->reviewModel->getRepliedReviews();
        $this->view('customerServiceManager/replied_reviews', ['reviews' => $repliedReviews]);
    }
}