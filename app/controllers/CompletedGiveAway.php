<?php

class CompletedGiveAway {

  use Controller;

  public function index() {
    $this->view('customerServiceManager/completed_give_away');
  }
}