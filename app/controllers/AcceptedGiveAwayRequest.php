<?php
class AcceptedGiveAwayRequest
{
    use Controller;

    public function index()
    {
        $giveAwayModel = new GiveAwayModel();

        // Get current page and tab from URL
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $tab = isset($_GET['tab']) ? $_GET['tab'] : 'accepted';
        $limit = 3; // items per page

        // Get filter parameters
        $filters = [
            'name' => isset($_GET['filter_name']) ? $_GET['filter_name'] : '',
            'date' => isset($_GET['filter_date']) ? $_GET['filter_date'] : '',
        ];

        // For accepted giveaways
        $acceptedGiveaways = $giveAwayModel->getAcceptedGiveAways($page, $limit, $filters);
        $totalAccepted = $giveAwayModel->countAcceptedGiveAways($filters);
        $totalAcceptedPages = ceil($totalAccepted / $limit);

        // For collected giveaways
        $collectedGiveaways = $giveAwayModel->getCollectedGiveAways($page, $limit, $filters);
        $totalCollected = $giveAwayModel->countCollectedGiveAways($filters);
        $totalCollectedPages = ceil($totalCollected / $limit);

        // Pass to the view
        $data = [
            'accepted_giveaway' => $acceptedGiveaways,
            'collected_giveaway' => $collectedGiveaways,
            'currentPage' => $page,
            'totalAcceptedPages' => $totalAcceptedPages,
            'totalCollectedPages' => $totalCollectedPages,
            'activeTab' => $tab,
            'filters' => $filters
        ];

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

                //get data for carbon footprint
                $carbonFootprintModel = new CarbonFootprintModel();
                $carbonFootprintData = [
                    'customer_id' => $existingGiveAway[0]->customer_id,
                    'name' => 'Giveaways',
                    'amount' => $_POST['amount'],
                    'carbon_footprint_type_id' => 2,
                ];
                $carbonFootprintModel->addCarbonFootprint($carbonFootprintData);


                // Redirect with success flag
                header("Location: " . ROOT . "/AcceptedGiveAwayRequest?success=1&tab=$tab");
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




