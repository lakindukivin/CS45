<?php

class PendingCustomOrderModel {
    
    use Model;
    
    protected $table = 'custom_order';
    protected $primaryKey = 'customOrder_id';

    public function getAll() {
        $query = "SELECT co.*, c.Name as customer_name 
                 FROM custom_order co 
                 JOIN customer c ON co.customer_id = c.Customer_id 
                 WHERE customOrder_status = 'pending'";
        return $this->query($query);
    }

    public function getById($id) {
        $query = "SELECT co.*, c.Name as customer_name 
                 FROM custom_order co 
                 JOIN customer c ON co.customer_id = c.Customer_id 
                 WHERE co.customOrder_id = :id 
                 LIMIT 1";
        $params = ['id' => $id];
        $data = $this->query($query, $params);
        return !empty($data) ? $data[0] : false;
    }

    public function getOrderDetails($orderId) 
    {
        $query = "SELECT * FROM custom_order WHERE customOrder_id = :id";
        $params = ['id' => $orderId];
        
        return $this->query($query, $params);
    }
    public function updateOrderStatus($order_id, $status, $reply = null) {
        if ($status === 'declined' && $reply !== null) {
            $sql = "UPDATE custom_order SET customOrder_status = :status, decline_reason = :reply WHERE customOrder_id = :order_id";
            $params = [
                ':status' => $status,
                ':reply' => $reply,
                ':order_id' => $order_id
            ];
        } else {
            $sql = "UPDATE custom_order SET customOrder_status = :status WHERE customOrder_id = :order_id";
            $params = [
                ':status' => $status,
                ':order_id' => $order_id
            ];
        }
    
        return $this->query($sql, $params);
    }
    

    public function getOrdersByStatus($status) {
        $query = "SELECT co.*, c.Name as customer_name 
                  FROM custom_order co 
                  JOIN customer c ON co.customer_id = c.customer_id 
                  WHERE co.customOrder_status = :status";
        $params = ['status' => $status];
        return $this->query($query, $params);
    }   
    
    
}
