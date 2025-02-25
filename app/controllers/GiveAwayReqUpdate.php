<?php 

class GiveAwayReqUpdate {
    use Controller;
    
    private $giveAwayModel;
    
    public function __construct() {
        $this->giveAwayModel = new GiveAwayModel();
    }

    public function index($params = []) {

       
       
       
        $this->view('customerServiceManager/give_away_req_update');
        // Add debugging
        /*show($params);
        
        if(!empty($params[0])) {
            $giveaway = $this->giveAwayModel->getGiveAwayById($params[0]);
            
            // Add debugging
            show($giveaway);
            
            $data['giveaway'] = $giveaway;
            $this->view('customerServiceManager/give_away_req_update', $data);
        } else {
            redirect('GiveAwayRequest');
        }*/
    }
}
