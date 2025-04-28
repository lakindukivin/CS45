<?php


class ReturnModel {
    use Model;

    protected $table = 'return_item';
    protected $table2 = 'completed_returns';


    public function getAllReturns() {
        $query = "SELECT ri.*, o.customer_id, c.name AS customerName, c.address,b.bag_size, s.pack_size, o.quantity, c.phone, p.productName, o.total,  o.orderDate
                  FROM return_item ri
                  JOIN orders o ON ri.order_id = o.order_id
                  JOIN bag_size b ON o.bag_id = b.bag_id
                  JOIN pack_size s ON o.pack_id = s.pack_id
                  JOIN customer c ON o.customer_id = c.customer_id
                  JOIN product p ON o.product_id = p.product_id
                  WHERE ri.returnStatus = 'pending'";

                  $result = $this->query($query);
                  // Ensure we always return an array, even if the query fails
                  return is_array($result) ? $result : [];
    }

    public function updateReturnStatus($return_id, $status, $decision_reason = null) {
        $query = "UPDATE return_item 
                  SET returnStatus = :status, decision_reason = :decision_reason 
                  WHERE return_id = :return_id";
        $data = [
            'return_id' => $return_id,
            'status' => $status,
            'decision_reason' => $decision_reason,
        ];
        return $this->query($query, $data);
    }

    public function getAllCompletedReturns() {
        $query = "SELECT cr.*, o.customer_id, c.name AS customerName,b.bag_size, s.pack_size, o.quantity, c.phone, p.productName, o.total,  o.orderDate, ri.returnDetails, ri.cus_requirements
                    FROM completed_returns cr
                    JOIN return_item ri ON cr.return_id = ri.return_id
                    JOIN orders o ON cr.order_id = o.order_id
                    JOIN bag_size b ON o.bag_id = b.bag_id
                    JOIN pack_size s ON o.pack_id = s.pack_id
                    JOIN customer c ON o.customer_id = c.customer_id
                    JOIN product p ON o.product_id = p.product_id
                    ORDER BY cr.date_completed DESC";
        return $this->query($query);
    }

    public function addCompletedReturn($data) {
        // Check if the return_id already exists in completed_returns
        $existingReturn = $this->query("SELECT * FROM completed_returns WHERE return_id = :return_id", ['return_id' => $data['return_id']]);
        
        // Debug log
        error_log("Adding/updating completed return: " . print_r($data, true));
        
        try {
            if ($existingReturn) {
                // If it exists, update the existing record
                $query = "UPDATE completed_returns 
                        SET order_id = :order_id, product_id = :product_id, customer_id = :customer_id, 
                            status = :status, decision_reason = :decision_reason, message_to_customer = :message_to_customer,
                            date_completed = CURRENT_TIMESTAMP
                        WHERE return_id = :return_id";
            } else {
                // If it doesn't exist, insert a new record
                $query = "INSERT INTO completed_returns 
                        (return_id, order_id, product_id, customer_id, status, decision_reason, message_to_customer) 
                        VALUES (:return_id, :order_id, :product_id, :customer_id, :status, :decision_reason, :message_to_customer)";
            }
            
            // Also update the status in the return_item table
            $this->updateReturnStatus($data['return_id'], $data['status'], $data['decision_reason']);
            
            $result = $this->query($query, $data);
            error_log("Database query result: " . ($result ? "Success" : "Failed"));
            
            return true; // Return true to indicate success even if query returns null
        } catch (Exception $e) {
            error_log("Error in addCompletedReturn: " . $e->getMessage());
            return false;
        }
    }

    public function updateCompletedReturn($return_id, $data) {
        $query = "UPDATE completed_returns 
                  SET decision_reason = :decision_reason, message_to_customer = :message_to_customer 
                  WHERE return_id = :return_id";
        return $this->query($query, array_merge($data, ['return_id' => $return_id]));
    }

    public function getReturnById($return_id) {
        $query = "SELECT * FROM return_item WHERE return_id = :return_id";
        $data = ['return_id' => $return_id];
        return $this->query($query, $data)[0] ?? null;
    }

    public function getReturnWithCustomerInfo($return_id) {
        $query = "SELECT ri.*, o.customer_id, c.name AS customerName,b.bag_size, s.pack_size, o.quantity, c.phone, p.productName, o.total,  o.orderDate
                  FROM return_item ri
                  JOIN orders o ON ri.order_id = o.order_id
                  JOIN product p ON o.product_id = p.product_id
                  JOIN bag_size b ON o.bag_id = b.bag_id
                  JOIN pack_size s ON o.pack_id = s.pack_id
                  JOIN customer c ON o.customer_id = c.customer_id
                  WHERE ri.return_id = :return_id";
        $data = ['return_id' => $return_id];
        $result = $this->query($query, $data);
        return $result ? $result[0] : null;
    }

    public function countByDate($date)
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            throw new Exception("Invalid date format. Expected YYYY-MM-DD.");
        }
        // Fix the query to use the correct date column name
        $query = "SELECT COUNT(return_id) as count FROM return_item WHERE DATE(date) = :date";
        $result = $this->query($query, ['date' => $date]);

        // Access the result as an object
        if (isset($result[0]->count)) {
            return $result[0]->count;
        }

        return 0; // Default to 0 if no valid result is found
    }

    public function getPendingReturns()
    {
        $query = "SELECT r.*, c.name FROM return_item r 
                  JOIN orders o ON r.order_id = o.order_id 
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE r.returnStatus = 'pending' 
                  ORDER BY r.date DESC";
        return $this->query($query);
    }

   
    public function getAcceptedReturns($page = 1, $limit = 10, $filters = []) {
         // Add pagination
        $offset = ($page - 1) * $limit;
        
        // Base query without ORDER BY and LIMIT
        $query = "SELECT cr.*, c.name AS customerName,b.bag_size, s.pack_size, c.phone, p.productName, o.quantity, o.total, o.orderDate, r.returnDetails, r.cus_requirements 
                  FROM completed_returns cr 
                  JOIN return_item r ON cr.return_id = r.return_id
                  JOIN orders o ON cr.order_id = o.order_id 
                  JOIN bag_size b ON o.bag_id = b.bag_id
                  JOIN pack_size s ON o.pack_id = s.pack_id
                  JOIN customer c ON o.customer_id = c.customer_id 
                  JOIN product p ON o.product_id = p.product_id 
                  WHERE cr.status = 'accepted'";
        
        // Prepare the parameters
        $params = [];
        
        // Add filters if provided
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(cr.date_completed) = :date";
            $params['date'] = $filters['date'];
        }
        
        // Add ORDER BY and LIMIT after all WHERE conditions
        $query .= " ORDER BY cr.date_completed DESC LIMIT $limit OFFSET $offset";

        return $this->query($query, $params);
    }


    public function getReturnedOrders($page = 1, $limit = 10, $filters = [])
    {
        // Add pagination
        $offset = ($page - 1) * $limit;
        
        // Base query without ORDER BY and LIMIT
        $query = "SELECT cr.*, c.name AS customerName,b.bag_size, s.pack_size, c.phone, p.productName, o.quantity, o.total 
                  FROM completed_returns cr 
                  JOIN orders o ON cr.order_id = o.order_id 
                  JOIN bag_size b ON o.bag_id = b.bag_id
                  JOIN pack_size s ON o.pack_id = s.pack_id
                  JOIN customer c ON o.customer_id = c.customer_id 
                  JOIN product p ON o.product_id = p.product_id 
                  WHERE cr.status = 'returned'";
        
        // Prepare the parameters
        $params = [];
        
        // Add filters if provided
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(cr.date_completed) = :date";
            $params['date'] = $filters['date'];
        }
        
        // Add ORDER BY and LIMIT after all WHERE conditions
        $query .= " ORDER BY cr.date_completed DESC LIMIT $limit OFFSET $offset";

        return $this->query($query, $params);
       
    }

    public function getRejectedReturns($page = 1, $limit = 10, $filters = [])
    {
        // Add pagination
        $offset = ($page - 1) * $limit;
        
        // Base query without ORDER BY and LIMIT
        $query = "SELECT cr.*, c.name AS customerName,b.bag_size, s.pack_size, c.phone, p.productName, o.quantity, o.total 
                  FROM completed_returns cr 
                  JOIN orders o ON cr.order_id = o.order_id 
                  JOIN bag_size b ON o.bag_id = b.bag_id
                  JOIN pack_size s ON o.pack_id = s.pack_id
                  JOIN customer c ON o.customer_id = c.customer_id 
                  JOIN product p ON o.product_id = p.product_id 
                  WHERE cr.status = 'rejected'";
        
        // Prepare the parameters
        $params = [];
        
        // Add filters if provided
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(cr.date_completed) = :date";
            $params['date'] = $filters['date'];
        }
        
        // Add ORDER BY and LIMIT after all WHERE conditions
        $query .= " ORDER BY cr.date_completed DESC LIMIT $limit OFFSET $offset";

        return $this->query($query, $params);
    }

    public function countAcceptedReturns($filters = [])
    {
        $query = "SELECT COUNT(*) as count FROM completed_returns cr 
                 JOIN orders o ON cr.order_id = o.order_id
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE cr.status = 'accepted'";
        
        // Prepare the parameters
        $params = [];
        
        // Add filters if provided
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(cr.date_completed) = :date";
            $params['date'] = $filters['date'];
        }

        $result = $this->query($query, $params);
        
        return isset($result[0]->count) ? (int)$result[0]->count : 0;
    }

    public function countReturnedOrders($filters = [])
    {
        $query = "SELECT COUNT(*) as count FROM completed_returns cr 
                 JOIN orders o ON cr.order_id = o.order_id
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE cr.status = 'returned'";
        
        // Prepare the parameters
        $params = [];
        
        // Add filters if provided
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(cr.date_completed) = :date";
            $params['date'] = $filters['date'];
        }

        $result = $this->query($query, $params);
        
        return isset($result[0]->count) ? (int)$result[0]->count : 0;
    }

    public function countRejectedReturns($filters = [])
    {
        $query = "SELECT COUNT(*) as count FROM completed_returns cr 
                 JOIN orders o ON cr.order_id = o.order_id
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE cr.status = 'rejected'";
        
        // Prepare the parameters
        $params = [];
        
        // Add filters if provided
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(cr.date_completed) = :date";
            $params['date'] = $filters['date'];
        }

        $result = $this->query($query, $params);
        
        return isset($result[0]->count) ? (int)$result[0]->count : 0;
    }
    
    public function getRecentReturns($limit = 8) {
        // Convert $limit to an integer to prevent SQL injection
        $limit = (int) $limit;
        
        // Modified to get only pending returns
        $query = "SELECT ri.*, c.name
                  FROM return_item ri
                  JOIN orders o ON ri.order_id = o.order_id
                  JOIN customer c ON o.customer_id = c.customer_id
                  WHERE ri.returnStatus = 'pending'
                  ORDER BY ri.date DESC
                  LIMIT $limit";
                  
        return $this->query($query);
    }

    public function getFilteredReturns($filters = []) {
        $query = "SELECT ri.*, o.customer_id, c.name AS customerName, b.bag_size, s.pack_size, o.quantity, c.phone, p.productName, o.total, o.orderDate
                  FROM return_item ri
                  JOIN orders o ON ri.order_id = o.order_id
                  JOIN bag_size b ON o.bag_id = b.bag_id
                  JOIN pack_size s ON o.pack_id = s.pack_id
                  JOIN customer c ON o.customer_id = c.customer_id
                  JOIN product p ON o.product_id = p.product_id
                  WHERE ri.returnStatus = 'pending'";
        
        $params = [];
        
        // Add filter for customer name
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        
        // Add filter for request date
        if (!empty($filters['date'])) {
            $query .= " AND DATE(ri.date) = :date";
            $params['date'] = $filters['date'];
        }
        
        $result = $this->query($query, $params);
        
        // Ensure we always return an array, even if the query failed
        return is_array($result) ? $result : [];
    }
}