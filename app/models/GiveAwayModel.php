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

   
    public function getAllCompletedGiveAways() {
        $query = "SELECT cg.*, c.name, c.phone, c.address, gr.request_date, gr.details
                  FROM completedgiveaway cg
                  JOIN customer c ON cg.customer_id = c.customer_id
                  JOIN giveawayrequests gr ON cg.giveaway_id = gr.giveaway_id";

        return $this->query($query);
    }

    //search pending giveaways by name and date
    public function getPendingGiveAways($page = 1, $limit =10, $filters = []) {
        $offset = ($page - 1) * $limit;

        $query = "SELECT gr.*, c.name, c.phone, c.address
                  FROM giveawayrequests gr
                  JOIN customer c ON gr.customer_id = c.customer_id
                  WHERE gr.giveawayStatus = 'pending'";
        $params = [];

        // Add name filter
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }

         // Add date filter
         if (!empty($filters['date'])) {
            $query .= " AND DATE(gr.request_date) = :date";
            $params['date'] = $filters['date'];
        }

        $query .= " LIMIT $limit OFFSET $offset";

        return $this->query($query, $params);
    }


    public function getAcceptedGiveAways($page = 1, $limit = 10, $filters = []) {
        $offset = ($page - 1) * $limit;
        
        $query = "SELECT cg.*, c.name, c.phone, c.address, g.request_date, g.details 
                  FROM completedgiveaway cg 
                  JOIN customer c ON cg.customer_id = c.customer_id
                  JOIN giveawayrequests g ON cg.giveaway_id = g.giveaway_id
                  WHERE cg.status = 'accepted'";
        
        $params = [];
        
        // Add name filter
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        
        // Add date filter
        if (!empty($filters['date'])) {
            $query .= " AND DATE(g.request_date) = :date";
            $params['date'] = $filters['date'];
        }
        
        $query .= " LIMIT $limit OFFSET $offset";
        
        return $this->query($query, $params);
    }
    
    public function getCollectedGiveAways($page = 1, $limit = 10, $filters = []) {
        $offset = ($page - 1) * $limit;
        
        $query = "SELECT cg.*, c.name, c.phone, c.address, g.request_date, g.details 
                  FROM completedgiveaway cg 
                  JOIN customer c ON cg.customer_id = c.customer_id
                  JOIN giveawayrequests g ON cg.giveaway_id = g.giveaway_id
                  WHERE cg.status = 'collected'";
        
        $params = [];
        
        // Add name filter
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        
        // Add date filter
        if (!empty($filters['date'])) {
            $query .= " AND DATE(g.request_date) = :date";
            $params['date'] = $filters['date'];
        }
        
        $query .= " LIMIT $limit OFFSET $offset";
        
        return $this->query($query, $params);
    }

    public function getRejectedGiveAways($page = 1, $limit = 10, $filters = []) {
        $offset = ($page - 1) * $limit;
        
        $query = "SELECT cg.*, c.name, c.phone, c.address, g.request_date, g.details 
                  FROM completedgiveaway cg 
                  JOIN customer c ON cg.customer_id = c.customer_id
                  JOIN giveawayrequests g ON cg.giveaway_id = g.giveaway_id
                  WHERE cg.status = 'rejected'";
        
        $params = [];
        
        // Add name filter
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        
        // Add date filter
        if (!empty($filters['date'])) {
            $query .= " AND DATE(g.request_date) = :date";
            $params['date'] = $filters['date'];
        }
        
        $query .= " LIMIT $limit OFFSET $offset";
        
        return $this->query($query, $params);
    }

    public function countPendingGiveAways($filters = []) {
        $query = "SELECT COUNT(*) as count FROM giveawayrequests gr
                  JOIN customer c ON gr.customer_id = c.customer_id
                  WHERE giveawayStatus = 'pending'";
        $params = [];
        
        // Add name filter
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        
        // Add date filter
        if (!empty($filters['date'])) {
            $query .= " AND DATE(gr.request_date) = :date";
            $params['date'] = $filters['date'];
        }
        
        $result = $this->query($query, $params);
        return isset($result[0]->count) ? $result[0]->count : 0;
    }
    
    // Count total accepted giveaways for pagination with filters
    public function countAcceptedGiveAways($filters = []) {
        $query = "SELECT COUNT(*) as count 
                  FROM completedgiveaway cg
                  JOIN customer c ON cg.customer_id = c.customer_id
                  JOIN giveawayrequests g ON cg.giveaway_id = g.giveaway_id
                  WHERE cg.status = 'accepted'";
        
        $params = [];
        
        // Add name filter
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        
        // Add date filter
        if (!empty($filters['date'])) {
            $query .= " AND DATE(g.request_date) = :date";
            $params['date'] = $filters['date'];
        }
        
        $result = $this->query($query, $params);
        return isset($result[0]->count) ? $result[0]->count : 0;
    }
    
    // Count total collected giveaways for pagination with filters
    public function countCollectedGiveAways($filters = []) {
        $query = "SELECT COUNT(*) as count 
                  FROM completedgiveaway cg
                  JOIN customer c ON cg.customer_id = c.customer_id
                  JOIN giveawayrequests g ON cg.giveaway_id = g.giveaway_id
                  WHERE cg.status = 'collected'";
        
        $params = [];
        
        // Add name filter
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        
        // Add date filter
        if (!empty($filters['date'])) {
            $query .= " AND DATE(g.request_date) = :date";
            $params['date'] = $filters['date'];
        }
        
        $result = $this->query($query, $params);
        return isset($result[0]->count) ? $result[0]->count : 0;
    }

    // Count total rejected giveaways for pagination with filters
    public function countRejectedGiveAways($filters = []) {
        $query = "SELECT COUNT(*) as count 
                  FROM completedgiveaway cg
                  JOIN customer c ON cg.customer_id = c.customer_id
                  JOIN giveawayrequests g ON cg.giveaway_id = g.giveaway_id
                  WHERE cg.status = 'rejected'";
        
        $params = [];
        
        // Add name filter
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        
        // Add date filter
        if (!empty($filters['date'])) {
            $query .= " AND DATE(g.request_date) = :date";
            $params['date'] = $filters['date'];
        }
        
        $result = $this->query($query, $params);
        return isset($result[0]->count) ? $result[0]->count : 0;
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

    public function updateAcceptedGiveAway($giveaway_id, $status) {
        $query = "UPDATE completedgiveaway
                  SET status = :status
                  WHERE giveaway_id = :giveaway_id";
        return $this->query($query, [
            'giveaway_id' => $giveaway_id,
            'status' => $status
        ]);
    }

    public function updatePolytheneAmount($giveaway_id, $amount) {
        $query = "UPDATE completedgiveaway
                  SET amount = :amount
                  WHERE giveaway_id = :giveaway_id";

        return $this->query($query, [
            'giveaway_id' => $giveaway_id,
            'amount' => $amount
        ]);
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

    public function countByDateAccepted($date)
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            throw new Exception("Invalid date format. Expected YYYY-MM-DD.");
        }
        $query = "SELECT COUNT(completed_id) as count FROM completedgiveaway WHERE DATE(completion_date) = :date";
        $result = $this->query($query, ['date' => $date]);

        // Access the result as an object
        if (isset($result[0]->count)) {
            return $result[0]->count;
        }

        return 0; // Default to 0 if no valid result is found
    }

    // public function getPendingGiveaways()
    // {
    //     $query = "SELECT g.*, c.name FROM giveawayrequests g 
    //               JOIN customer c ON g.customer_id = c.customer_id 
    //               WHERE g.giveawayStatus = 'pending' 
    //               ORDER BY g.request_date DESC";
    //     return $this->query($query);
    // }

    public function getRecentGiveaways($limit = 8) {
        // Convert $limit to an integer to prevent SQL injection
        $limit = (int) $limit;
        
        // Modified to get only pending giveaways
        $query = "SELECT gr.*, c.name
                  FROM giveawayrequests gr 
                  JOIN customer c ON gr.customer_id = c.customer_id
                  WHERE gr.giveawayStatus = 'pending'
                  ORDER BY gr.request_date DESC
                  LIMIT $limit";
        
        return $this->query($query);
    }
}