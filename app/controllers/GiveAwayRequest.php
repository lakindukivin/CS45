<?php   


class GiveAwayRequest {

    use Controller;

    public function index() {
        $this->view('customerServiceManager/give_away_request');
    }   

}