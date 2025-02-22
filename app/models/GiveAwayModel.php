<?php
class GiveAwayModel {
    
  use  Model;

  protected $table = 'polythenegiveaway';

    public function getAllGiveAways() {
        $query = "SELECT pg.*, c.Name, c.Phone 
                  FROM polythenegiveaway pg 
                  JOIN customer c ON pg.Customer_id = c.Customer_id";
        
        return $this->query($query);
    }
}
