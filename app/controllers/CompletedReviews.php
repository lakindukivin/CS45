<?php

class CompletedReviews {

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
    $allCompletedReviews = $reviewModel->getFilteredRepliedReviews($filterName, $filterDate);

    // Pagination parameters
    $limit = 5; // Items per page
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $currentPage = max(1, $currentPage); // Make sure page is at least 1

    // Get total count of completed reviews
    $totalItems = count($allCompletedReviews);
    $totalPages = ceil($totalItems / $limit);

    // Ensure current page is valid
    if ($currentPage > $totalPages && $totalPages > 0) {
        $currentPage = $totalPages;
    }
    $offset = ($currentPage - 1) * $limit;

    // Get the paginated reviews
    $data['reviews'] = array_slice($allCompletedReviews, $offset, $limit);
    // Add pagination data to pass to the view
    $data['currentPage'] = $currentPage;
    $data['totalPages'] = $totalPages;

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
                header("Location: " . ROOT . "/CompletedReviews?success=1"); // Redirect with error flag
                exit;
            }
        } else {
            header("Location: " . ROOT . "/CompletedReviews?success=1"); // Redirect with error flag
            exit;
        }
    }
  }

  
}