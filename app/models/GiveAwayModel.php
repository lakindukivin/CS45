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

    public function getGiveAwayById($id) {
      $query = "SELECT gr.*, c.name, c.phone 
                FROM giveawayrequests gr 
                JOIN customer c ON gr.customer_id = c.customer_id
                WHERE gr.giveaway_id = :id";
      
      $result = $this->query($query, ['id' => $id]);
      
      // Add debugging
      show($result);
      
      return $result[0] ?? null;
  }
  
  
}