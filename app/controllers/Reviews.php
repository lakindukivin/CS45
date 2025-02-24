<?php
class Reviews {

    use Controller;

    public function index() {
        $reviewModel = new Review();
        $data['reviews'] = $reviewModel->getAllPendingReviews();
        $this->view('customerServiceManager/reviews', $data);
    }

    public function show($Review_id) {
        $reviewModel = new Review();
        $data['review'] = $reviewModel->getReviewDetails($Review_id);

        if (!$data['review']) {
            $_SESSION['error'] = "Review not found.";
            redirect("CSManagerHome");
        }

        $this->view('customerServiceManager/review_details', $data);
    }

    public function addReply() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $reviewModel = new Review();

            $data = [
                'Review_id' => htmlspecialchars($_POST['Review_id']),
                'reply' => htmlspecialchars($_POST['reply'])
            ];

            if ($reviewModel->addReply($data)) {
                $_SESSION['success'] = "Reply added successfully.";
                redirect("CompletedReviews");
            } else {
                $_SESSION['error'] = "Failed to add reply.";
                redirect("Reviews/" . $_POST['Review_id']);
            }
        }
    }

    public function editReply() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $reviewModel = new Review();

            $data = [
                'reply_id' => htmlspecialchars($_POST['reply_id']),
                'reply' => htmlspecialchars($_POST['reply'])
            ];

            if ($reviewModel->editReply($data)) {
                $_SESSION['success'] = "Reply updated successfully.";
                redirect("CompletedReviews");
            } else {
                $_SESSION['error'] = "Failed to update reply.";
                redirect("Reviews/" . $_POST['Review_id']);
            }
        }
    }

    public function deleteReply($reply_id) {
        $reviewModel = new Review();

        if ($reviewModel->removeReply($reply_id)) {
            $_SESSION['success'] = "Reply deleted successfully.";
        } else {
            $_SESSION['error'] = "Failed to delete reply.";
        }

        redirect("CompletedReviews");
    }
}
