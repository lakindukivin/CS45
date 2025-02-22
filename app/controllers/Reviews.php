<?php
class Reviews {
    use Controller;

    private $reviewModel;

    public function __construct() {
        $this->reviewModel = new Review();
    }

    public function index($id = null) {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        if (!isset($id) || empty($id)) {
            die("Error: No ID provided. Redirecting to ManageReviews...");
            redirect('ManageReviews');
        }

        $review = $this->reviewModel->getReviewDetails($id);

        if (!$review) {
            die("Error: Review not found for ID: " . htmlspecialchars($id));
            redirect('ManageReviews');
        }

        // Debugging Output
        echo "<pre>";
        print_r($review);
        echo "</pre>";
        die(); // Stop execution to verify data

        $this->view('customerServiceManager/reviews', ['review' => $review]);
    }

    public function reply() {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['review_id'], $_POST['reply'])) {
            $data = [
                'review_id' => htmlspecialchars($_POST['review_id']),
                'reply' => htmlspecialchars($_POST['reply'])
            ];

            // Debugging Output
            echo "<pre>";w
            print_r($data);
            echo "</pre>";
            exit(); // Stop execution to verify form data

            if ($this->reviewModel->addReply($data)) {
                $_SESSION['success_message'] = "Reply added successfully";
            } else {
                $_SESSION['error_message'] = "Failed to add reply";
            }
            redirect('ManageReviews');
        } else {
            $_SESSION['error_message'] = "Invalid request";
            redirect('ManageReviews');
        }
    }
}
