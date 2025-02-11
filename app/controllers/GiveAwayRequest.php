<?php

class GiveAwayRequest {

    use Controller;
    private $giveAwayRequestModel;

    public function __construct() {
        $this->giveAwayRequestModel = new GiveAwayRequestModel();
    }

    public function index() {
        $giveAwayRequests = $this->giveAwayRequestModel->getAllGiveAwayRequests();
        $this->view('customerServiceManager/give_away_request', [
            'giveAwayRequests' => $giveAwayRequests
        ]);
    }

    public function view($params = []) {
        if (!empty($params[0])) {
            $id = $params[0];
            $request = $this->giveAwayRequestModel->getGiveAwayRequestById($id);
            
            if ($request) {
                echo json_encode($request);
                return;
            }
        }
        
        http_response_code(404);
        echo json_encode(['error' => 'Request not found']);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $data = [
                'Giveaway_id' => $_POST['id'],
                'Type' => $_POST['type'],
                'Address' => $_POST['address'],
                'quantity' => $_POST['quantity']
            ];

            if ($this->giveAwayRequestModel->updateGiveAwayRequest($data)) {
                echo json_encode(['success' => true]);
                return;
            }
        }
        
        http_response_code(500);
        echo json_encode(['error' => 'Failed to update request']);
    }
}
