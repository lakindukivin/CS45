<?php

class CompletedGiveAway
{

  use Controller;

  private $carbonFootprintModel;
  private $giveAwayModel;
  public function __construct()
  {
    $this->carbonFootprintModel = new CarbonFootprintModel();
    $this->giveAwayModel = new GiveAwayModel();
  }

  public function index()
  {
    $giveAwayModel = new GiveAwayModel();

    // Get current page and tab from URL
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $tab = isset($_GET['tab']) ? $_GET['tab'] : 'accepted';
    $limit = 3; // items per page

    // Get filter parameters
    $filters = [
      'name' => isset($_GET['filter_name']) ? $_GET['filter_name'] : '',
      'date' => isset($_GET['filter_date']) ? $_GET['filter_date'] : '',
    ];

    // For accepted giveaways
    $acceptedGiveaways = $giveAwayModel->getAcceptedGiveAways($page, $limit, $filters);
    $totalAccepted = $giveAwayModel->countAcceptedGiveAways($filters);
    $totalAcceptedPages = ceil($totalAccepted / $limit);

    // For collected giveaways
    $collectedGiveaways = $giveAwayModel->getCollectedGiveAways($page, $limit, $filters);
    $totalCollected = $giveAwayModel->countCollectedGiveAways($filters);
    $totalCollectedPages = ceil($totalCollected / $limit);

    // For rejected giveaways
    $rejectedGiveaways = $giveAwayModel->getRejectedGiveAways($page, $limit, $filters);
    $totalRejected = $giveAwayModel->countRejectedGiveAways($filters);
    $totalRejectedPages = ceil($totalRejected / $limit);

    // Pass to the view
    $data = [
      'accepted_giveaway' => $acceptedGiveaways,
      'collected_giveaway' => $collectedGiveaways,
      'rejected_giveaway' => $rejectedGiveaways,
      'currentPage' => $page,
      'totalAcceptedPages' => $totalAcceptedPages,
      'totalCollectedPages' => $totalCollectedPages,
      'totalRejectedPages' => $totalRejectedPages,
      'activeTab' => $tab,
      'filters' => $filters
    ];

    // Check for success/error messages in the URL
    if (isset($_GET['success'])) {
      $data['success'] = $_GET['success'];
    }
    if (isset($_GET['error'])) {
      $data['error'] = $_GET['error'];
    }

    $this->view('customerServiceManager/completed_give_away', $data);
  }
}