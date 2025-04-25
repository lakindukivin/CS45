<?php
class CollectionAgentHome
{
    use Controller;

     // Add the model method to load models dynamically
     public function model($model)
     {
         $modelPath = "../app/models/" . $model . ".php";
         if (file_exists($modelPath)) {
             require_once $modelPath;
             return new $model();
         } else {
             throw new Exception("Model file not found: " . $model);
         }
     }
 
    public function index($data = [])
    {
        // Get today's date in YYYY-MM-DD format
        $today = date('Y-m-d');

        // Fetch counts for today's date using the models
        $giveaways = $this->model('GiveAwayModel')->countByDateAccepted($today);
        $guests = $this->model('GuestCollectionModel')->countByDate($today);
        $total = $this->model('GuestCollectionModel')->getTotalAmountByDate($today);

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

    $this->view('collectionAgent/collectionAgentHome',[
      'giveaways' => $giveaways,
      'guests' => $guests,
      'total' => $total,
    ]);
  }

  public function getDayData()
    {
        if (isset($_GET['date']) && !empty($_GET['date'])) {
            $date = $_GET['date'];

            try {
                // Get counts for each type
                $giveawayCount = $this->model('GiveAwayModel')->countByDateAccepted($date);
                $guestCount = $this->model('GuestCollectionModel')->countByDate($date);
                $totalAmount = $this->model('GuestCollectionModel')->getTotalAmountByDate($date);
                
                header('Content-Type: application/json');
                echo json_encode([
                    'giveaways' => $giveawayCount,
                    'guests' => $guestCount,
                    'total' => $totalAmount
                ]);
                exit;
            } catch (Exception $e) {
                header('Content-Type: application/json');
                echo json_encode(['error' => $e->getMessage()]);
                exit;
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Invalid or missing date parameter.']);
            exit;
        }
    }
}
