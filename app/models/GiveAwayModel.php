<?php
class GiveAwayModel {
    
  use  Model;

  protected $table = 'polythenegiveaway';

    public function getAllGiveAways() {
        $query = "SELECT pg.*, c.name, c.phone 
                  FROM polythenegiveaway pg 
                  JOIN customer c ON pg.customer_id = c.customer_id";
        
        return $this->query($query);
    }

    public function getGiveAwayById($id) {
      $query = "SELECT pg.*, c.name, c.phone 
                FROM polythenegiveaway pg 
                JOIN customer c ON pg.customer_id = c.customer_id
                WHERE pg.giveaway_id = :id";
      
      $result = $this->query($query, ['id' => $id]);
      
      // Add debugging
      show($result);
      
      return $result[0] ?? null;
  }
  
  
}
