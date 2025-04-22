<?php
class GiveAwayModel {
    
  use  Model;

  protected $table = 'giveawayrequests';
  protected $table2 = 'completedgiveaway';

    public function getAllGiveAways() {
        $query = "SELECT gr.*, c.name, c.phone, c.address
                  FROM giveawayrequests gr 
                  JOIN customer c ON gr.customer_id = c.customer_id
                  WHERE gr.giveawayStatus = 'pending'";
        
        return $this->query($query);
    }

    public function updateGiveAwayStatus($giveaway_id, $status, $decision_reason = null) {
        $query = "UPDATE giveawayrequests
                  SET giveawayStatus = :status, decision_reason = :decision_reason
                  WHERE giveaway_id = :giveaway_id";
        $data = [
            'giveaway_id' => $giveaway_id,
            'status' => $status,
            'decision_reason' => $decision_reason,
        ];
        return $this->query($query, $data);
    }
   
    public function getAllCompletedGiveAways() {
        $query = "SELECT cg.*, c.name, c.phone, c.address, gr.request_date, gr.details
                  FROM completedgiveaway cg
                  JOIN customer c ON cg.customer_id = c.customer_id
                  JOIN giveawayrequests gr ON cg.giveaway_id = gr.giveaway_id";

        return $this->query($query);
    }

    public function addCompletedGiveaway($data) {
        // Check if the giveaway_id already exists in completed_giveaways
        $existingGiveaway = $this->query("SELECT * FROM completedgiveaway WHERE giveaway_id = :giveaway_id", ['giveaway_id' => $data['giveaway_id']]);
        if ($existingGiveaway) {
            // If it exists, update the existing record instead of inserting
            $query = "UPDATE completedgiveaway
                      SET customer_id = :customer_id, status = :status, decision_reason = :decision_reason, message_to_customer = :message_to_customer
                      WHERE giveaway_id = :giveaway_id";
        } else {
            // If it doesn't exist, insert a new record
            $query = "INSERT INTO completedgiveaway
                      (giveaway_id, customer_id, status, decision_reason, message_to_customer)
                      VALUES (:giveaway_id, :customer_id, :status, :decision_reason, :message_to_customer)";
        }
        return $this->query($query, $data);
    }

    public function getGiveAwayById($giveaway_id) {
        $query = "SELECT * FROM giveawayrequests WHERE giveaway_id = :giveaway_id";
        return $this->query($query, ['giveaway_id' => $giveaway_id]);
    }

    public function updateCompletedGiveAway($giveaway_id, $data) {
        $query = "UPDATE completedgiveaway
                  SET decision_reason = :decision_reason, message_to_customer = :message_to_customer
                  WHERE giveaway_id = :giveaway_id";
        return $this->query($query, array_merge(['giveaway_id' => $giveaway_id], $data));
    }


    public function countByDate($date)
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            throw new Exception("Invalid date format. Expected YYYY-MM-DD.");
        }
        $query = "SELECT COUNT(giveaway_id) as count FROM giveawayrequests WHERE DATE(request_date) = :date";
        $result = $this->query($query, ['date' => $date]);

        // Access the result as an object
        if (isset($result[0]->count)) {
            return $result[0]->count;
        }

        return 0; // Default to 0 if no valid result is found
    }
}