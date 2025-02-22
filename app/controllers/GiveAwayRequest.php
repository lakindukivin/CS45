<?php
class GiveAwayRequest {

    use Controller;
    
    private $giveAwayModel;

    public function __construct() {
        $this->giveAwayModel = new GiveAwayModel();
    }

    public function index() {
        $giveaways = $this->giveAwayModel->getAllGiveAways();
        
        $data['giveaways'] = $giveaways;
        $this->view('customerServiceManager/give_away_request', $data);
    }
}
