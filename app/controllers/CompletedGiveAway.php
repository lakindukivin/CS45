<?php

class CompletedGiveAway {

  use Controller;

  public function index() {
    $giveAwayModel = new GiveAwayModel();
    $allCompletedgiveAways =  $giveAwayModel->getAllCompletedGiveAways();

     // Initialize arrays for each status type
     $data['accepted_giveaway'] = [];
     $data['rejected_giveaway'] = [];

      // Sort giveaways by status
      if (is_array($allCompletedgiveAways)) {
        foreach ($allCompletedgiveAways as $giveaway) {
            switch ($giveaway->status) {
                case 'accepted':
                    $data['accepted_giveaway'][] = $giveaway;
                    break;
                case 'rejected':
                    $data['rejected_giveaway'][] = $giveaway;
                    break;
            }
        }
    }

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