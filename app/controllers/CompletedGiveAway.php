<?php

class CompletedGiveAway {

  use Controller;

  public function index() {
    $giveAwayModel = new GiveAwayModel();
    $data['giveaway'] = $giveAwayModel->getAllCompletedGiveAways();
    $this->view('customerServiceManager/completed_give_away', $data);
  }
}