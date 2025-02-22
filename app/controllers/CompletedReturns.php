<?php

class CompletedReturns {
  
    use Controller;
    
    public function index() {
        $this->view('customerServiceManager/completed_returns');
    }

  }