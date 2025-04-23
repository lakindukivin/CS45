<?php
class GiveAwayRequest {

    use Controller;
    
    // private $giveAwayModel;

    // public function __construct() {
    //     $this->giveAwayModel = new GiveAwayModel();
    // }

    public function index($data) {
        $giveAwayModel = new GiveAwayModel();

        // Pagination parameters
        $limit = 3; // Items per page
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $currentPage = max(1, $currentPage); // Make sure page is at least 1

        // Get total count of pending giveaways
        $allPendingGiveaways = $giveAwayModel->getAllGiveAways();
        $totalItems = count($allPendingGiveaways);
        $totalPages = ceil($totalItems / $limit);

        // Ensure current page is valid
        if ($currentPage > $totalPages && $totalPages > 0) {
            $currentPage = $totalPages;
        }

        $offset = ($currentPage - 1) * $limit;
        // Get the paginated giveaways
        $data['giveaways'] = array_slice($allPendingGiveaways, $offset, $limit);
        // Add pagination data to pass to the view
        $data['currentPage'] = $currentPage;
        $data['totalPages'] = $totalPages;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $giveaway_id = $_POST['giveaway_id'];
            $giveaway_status = $_POST['giveawayStatus'] ?? null;
            $decision_reason = $_POST['decision_reason'] ?? null;

            // Debugging: Check the value of $giveaway_id and $giveaway_status
            if (empty($giveaway_id)) {
                die("Error: The giveaway_id is missing or empty.");
            }
            if (empty($giveaway_status)) {
                die("Error: The giveawayStatus is missing or empty.");
            }

            // Check if giveaway_id exists in giveaway_item
            $existingGiveAway = $giveAwayModel->getGiveAwayById($giveaway_id);
            if (!$existingGiveAway) {
                die("Error: The giveaway_id does not exist in the giveaway_item table.");
            }

            if (isset($_POST['accept_giveaway'])) {
                $giveAwayModel->updateGiveAwayStatus($giveaway_id, 'accepted', $decision_reason);
                $giveAwayModel->addCompletedGiveAway([
                    'giveaway_id' => $giveaway_id,
                    'customer_id' => $_POST['customer_id'],
                    'status' => 'accepted',
                    'decision_reason' => $decision_reason,
                    'message_to_customer' => $_POST['message_to_customer'],
                ]);

                // Redirect with success flag
                header("Location: " . ROOT . "/GiveAwayRequest?success=1");
                exit;

            } elseif (isset($_POST['reject_giveaway'])) {
                $giveAwayModel->updateGiveAwayStatus($giveaway_id, 'rejected', $decision_reason);
                $giveAwayModel->addCompletedGiveAway([
                    'giveaway_id' => $giveaway_id,
                    'customer_id' => $_POST['customer_id'],
                    'status' => 'rejected',
                    'decision_reason' => $decision_reason,
                    'message_to_customer' => $_POST['message_to_customer'],
                ]);

                // Redirect with error flag
                header("Location: " . ROOT . "/GiveAwayRequest?error=1");
                exit;
            }
        }
        $this->view('customerServiceManager/give_away_request', $data);
    }
}