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
        $query = "SELECT cr.*, o.customer_id, c.name AS customerName, o.quantity, c.phone, p.productName, o.total,  o.orderDate
                    FROM completed_returns cr
                    JOIN orders o ON cr.order_id = o.order_id
                    JOIN customer c ON o.customer_id = c.customer_id
                    JOIN product p ON o.product_id = p.product_id
                    ORDER BY cr.date_completed DESC";
        return $this->query($query);
    }

    public function addCompletedReturn($data) {
        // Check if the return_id already exists in completed_returns
        $existingReturn = $this->query("SELECT * FROM completed_returns WHERE return_id = :return_id", ['return_id' => $data['return_id']]);
        if ($existingReturn) {
            // If it exists, update the existing record instead of inserting
            $query = "UPDATE completed_returns 
                      SET order_id = :order_id, product_id = :product_id, customer_id = :customer_id, 
                          status = :status, decision_reason = :decision_reason, message_to_customer = :message_to_customer 
                      WHERE return_id = :return_id";
        } else {
            // If it doesn't exist, insert a new record
            $query = "INSERT INTO completed_returns 
                      (return_id, order_id, product_id, customer_id, status, decision_reason, message_to_customer) 
                      VALUES (:return_id, :order_id, :product_id, :customer_id, :status, :decision_reason, :message_to_customer)";
        }
        return $this->query($query, $data);
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

}