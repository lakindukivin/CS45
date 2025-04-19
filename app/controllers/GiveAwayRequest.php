<?php
class GiveAwayRequest {

    use Controller;
    
    // private $giveAwayModel;

    // public function __construct() {
    //     $this->giveAwayModel = new GiveAwayModel();
    // }

    public function index($data) {
        $giveAwayModel = new GiveAwayModel();
        $data['giveaways'] = $giveAwayModel->getAllGiveAways();

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
            } elseif (isset($_POST['reject_giveaway'])) {
                $giveAwayModel->updateGiveAwayStatus($giveaway_id, 'rejected', $decision_reason);
                $giveAwayModel->addCompletedGiveAway([
                    'giveaway_id' => $giveaway_id,
                    'customer_id' => $_POST['customer_id'],
                    'status' => 'rejected',
                    'decision_reason' => $decision_reason,
                    'message_to_customer' => $_POST['message_to_customer'],
                ]);
            }
        }
        $this->view('customerServiceManager/give_away_request', $data);
    }
}