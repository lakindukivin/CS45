<?php
class GiveAwayModel {
    
  use  Model;

  protected $table = 'giveawayrequests';

    public function getAllGiveAways() {
        $query = "SELECT gr.*, c.name, c.phone, c.address
                  FROM giveawayrequests gr 
                  JOIN customer c ON gr.customer_id = c.customer_id";
        
        return $this->query($query);
    }
  
}