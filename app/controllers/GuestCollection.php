<?php

class GuestCollection
{

  use Controller;

  public function index()
  {
    // $guestCollection = new GuestCollectionModel();
    $this->view('collectionAgent/guest_collection');
  }

  public function save()
  {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $guestCollection = new GuestCollectionModel();

      $data = [
        'guest_name' => $_POST['guest_name'],
        'phone' => $_POST['phone'],
        'amount' => $_POST['amount'],
        'date' => date('Y-m-d') // Add today's date in YYYY-MM-DD format
      ];

      $guestCollection->addCollection($data);

      //get carbonfootprint data
      $carbonFootprintModel = new CarbonFootprintModel();
      $carbonFootprintData = [
        'customer_id' => null,
        'name' => 'Collections',
        'amount' => $_POST['amount'],
        'carbon_footprint_type_id' => 3

      ];
      $carbonFootprintModel->addCarbonFootprint($carbonFootprintData);

      // Set success message in session
      $_SESSION['success_message'] = "Collection successfully added!";

      redirect('GuestCollection');
    }
  }
}
