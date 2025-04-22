<?php


class ReturnModel {
    use Model;

    protected $table = 'return_item';
    protected $table2 = 'completed_returns';


    public function getAllReturns() {
        $query = "SELECT ri.*, o.customer_id, c.name AS customerName, o.quantity, c.phone, p.productName, o.total,  o.orderDate
                  FROM return_item ri
                  JOIN orders o ON ri.order_id = o.order_id
                  JOIN customer c ON o.customer_id = c.customer_id
                  JOIN product p ON o.product_id = p.product_id
                  WHERE ri.returnStatus = 'pending'";

                  return $this->query($query);
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
        $query = "SELECT cr.*, o.customer_id, c.name AS customerName, o.quantity, c.phone, p.productName, o.total,  o.orderDate, ri.returnDetails, ri.cus_requirements
                    FROM completed_returns cr
                    JOIN return_item ri ON cr.return_id = ri.return_id
                    JOIN orders o ON cr.order_id = o.order_id
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
        $query = "SELECT ri.*, o.customer_id, c.name AS customerName
                  FROM return_item ri
                  JOIN orders o ON ri.order_id = o.order_id
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
        $query = "SELECT COUNT(return_id) as count FROM return_item WHERE DATE(date) = :date";
        $result = $this->query($query, ['date' => $date]);

        // Access the result as an object
        if (isset($result[0]->count)) {
            return $result[0]->count;
        }

        return 0; // Default to 0 if no valid result is found
    }

}