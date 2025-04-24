<?php
class AcceptedGiveAwayRequest
{
    use Controller;
   
    public function index () {

      $giveAwayModel = new GiveAwayModel();
      $allCompletedgiveAways =  $giveAwayModel->getAcceptedGiveAways();

     // Initialize arrays for each status type
     $data['accepted_giveaway'] = [];
     $data['collected_giveaway'] = [];

      // Sort giveaways by status
      if (is_array($allCompletedgiveAways)) {
        foreach ($allCompletedgiveAways as $giveaway) {
            switch ($giveaway->status) {
                case 'accepted':
                    $data['accepted_giveaway'][] = $giveaway;
                    break;
                case 'collected':
                    $data['collected_giveaway'][] = $giveaway;
                    break;
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $giveaway_id = $_POST['giveaway_id'] ?? null;
        
        // Check if we have the required data
        if (empty($giveaway_id)) {
            die("Error: The giveaway_id is missing or empty.");
        }

        // Check if giveaway_id exists
        $existingGiveAway = $giveAwayModel->getGiveAwayById($giveaway_id);
        if (!$existingGiveAway) {
            die("Error: The giveaway_id does not exist in the giveawayrequests table.");
        }

        if (isset($_POST['accept_giveaway'])) {
            // Now calling the updated method with proper parameters
            $giveAwayModel->updateAcceptedGiveAway($giveaway_id, 'collected');
            $giveAwayModel->updatePolytheneAmount($giveaway_id, $_POST['amount']);
           
            // Redirect with success flag
            header("Location: " . ROOT . "/AcceptedGiveAwayRequest?success=1");
            exit;
        }
    }

     // Check for success/error messages in the URL
     if (isset($_GET['success'])) {
      $data['success'] = $_GET['success'];
    }
    if (isset($_GET['error'])) {
      $data['error'] = $_GET['error'];
    }  
  
    $this->view('collectionAgent/accepted_give_away', $data);
    }
}




