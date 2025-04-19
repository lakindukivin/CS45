<?php

class CompletedReturns {
  
    use Controller;
    
    public function index() {
       
            $completedReturnModel = new ReturnModel();
            $data['completedReturns'] = $completedReturnModel->getAllCompletedReturns();
            $this->view('customerServiceManager/completed_returns', $data);


  }
}