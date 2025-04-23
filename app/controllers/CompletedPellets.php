<?php

/**
 *completed pellets request class
 */

 class CompletedPellets{

  use Controller;

  public function index(){
    // Ensure session is active
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }

  // Redirect to login if user is not authenticated
  if (!isset($_SESSION['user_id'])) {
      redirect('login');
  }

  // Check if the user has the right role to access this page
  if ($_SESSION['role_id'] != 3) {
      redirect('login');
  }

    $this->view('productionManager/completed_pellets');
  }
 }