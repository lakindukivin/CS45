<?php
class GiveAwayRequest {

    use Controller;
    
    // private $giveAwayModel;

    // public function __construct() {
    //     $this->giveAwayModel = new GiveAwayModel();
    // }

    public function index($data) {
        $giveAwayModel = new GiveAwayModel();
        //var_dump($giveAwayModel); die();
        $data['giveaways'] = $giveAwayModel->getAllGiveAways();
        $this->view('customerServiceManager/give_away_request', $data);
    }
}