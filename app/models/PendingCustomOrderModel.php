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
        $query = "SELECT * FROM custom_orders WHERE customOrder_id = :id";
        $params = ['id' => $orderId];
        
        return $this->query($query, $params);
    }
    public function updateOrderStatus($orderId, $status) 
    {
        $query = "UPDATE custom_orders SET customOrder_status = :status WHERE customOrder_id = :id";
        $params = [
            'status' => $status,
            'id' => $orderId
        ];
        
        return $this->query($query, $params);
    }
}
