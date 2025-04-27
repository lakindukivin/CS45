<?php
class ManageReviews {
    
    use Controller;
   
    public function index() {
        $reviewModel = new Review();

        // Get filter parameters
        $filterName = $_GET['filter_name'] ?? null;
        $filterDate = $_GET['filter_date'] ?? null;
        
        // Store filters in data array to pass to view
        $data['filters'] = [
            'name' => $filterName,
            'date' => $filterDate
        ];
        
        // Get filtered reviews
        $allPendingReviews = $reviewModel->getFilteredPendingReviews($filterName, $filterDate);

        // Pagination parameters
        $limit = 5; // Items per page
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $currentPage = max(1, $currentPage); // Make sure page is at least 1

        // Get total count of pending reviews
        $totalItems = count($allPendingReviews);
        $totalPages = ceil($totalItems / $limit);
        
        // Ensure current page is valid
        if ($currentPage > $totalPages && $totalPages > 0) {
            $currentPage = $totalPages;
        }
        $offset = ($currentPage - 1) * $limit;

        // Get the paginated reviews
        $data['reviews'] = array_slice($allPendingReviews, $offset, $limit);
        // Add pagination data to pass to the view
        $data['currentPage'] = $currentPage;
        $data['totalPages'] = $totalPages;

        $this->view('customerServiceManager/manage_reviews', $data);
    }

    public function addReply() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviewId = $_POST['review_id'];
            $replyText = trim($_POST['reply']); // Trim whitespace to avoid empty replies

            if (empty($replyText)) {
                // Redirect back with an error flag if the reply is empty
                header("Location: " . ROOT . "/ManageReviews?success=1");
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