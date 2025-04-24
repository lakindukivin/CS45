<?php

class GuestCollection {

  use Controller;

  public function index() {
    $guestCollection = new GuestCollectionModel();
    $this ->view('collectionAgent/guest_collection'); 
  }
  
  public function save() {
    if($_SERVER['REQUEST_METHOD'] == "POST") {
      $guestCollection = new GuestCollectionModel();
      
      $data = [
        'guest_name' => $_POST['guest_name'],
        'phone' => $_POST['phone'],
        'amount' => $_POST['amount']
      ];
      
      $guestCollection->addCollection($data);
      
      redirect('GuestCollection');
    }
  }
}
