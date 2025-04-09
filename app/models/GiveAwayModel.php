<?php
class GiveAwayModel {
    
  use  Model;

  protected $table = 'giveawayrequests';
  protected $table2 = 'completedgiveaway';

    public function getAllGiveAways() {
        $query = "SELECT gr.*, c.name, c.phone, c.address
                  FROM giveawayrequests gr 
                  JOIN customer c ON gr.customer_id = c.customer_id
                  WHERE gr.status = 'Pending'";
        
        return $this->query($query);
    }
    
    public function getAllCompletedGiveAways() {
        $query = "SELECT cg.*, c.name, c.phone, c.address, gr.status, gr.request_date
                  FROM completedgiveaway cg
                  JOIN customer c ON cg.customer_id = c.customer_id
                  JOIN giveawayrequests gr ON cg.giveaway_id = gr.giveaway_id
                  WHERE gr.status = 'Approved' OR gr.status = 'Rejected'";

        return $this->query($query);
    }
}