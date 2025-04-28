<?php

class PelletsRequestsModel {

    use Model;

    protected $table = 'pellet';
    protected $primaryKey = 'PelletOrder_id';

    public function getAll() {
        $query = "SELECT po.*, c.Name as customer_name 
        FROM pellet po
        JOIN customer c ON po.customer_id = c.customer_id";
        return $this->query($query);
    }

    public function getById($id) {
        $query = "SELECT po.*, c.Name as customer_name 
        FROM pellet po
        JOIN customer c ON po.customer_id = c.Customer_id
        WHERE PelletOrder_id = :id LIMIT 1";
        $params = ['id' => $id];
        $data = $this->query($query, $params);
        return !empty($data) ? $data[0] : false;
    }

    public function getOrderDetails($orderId)
    {
        $query = "SELECT * FROM pellet WHERE PelletOrder_id = :id";
        $params = ['id' => $orderId];

        return $this->query($query, $params);
    }

    public function updateOrderStatus($order_id, $status, $reply=null){
        if ($status === 'declined' && $reply !== null) {
            $sql = "UPDATE pellet SET pelletOrderStatus = :status, reply = :reply WHERE pelletOrder_id = :order_id";
            $params = [
                ':status' => $status,
                ':reply' => $reply,
                ':order_id' => $order_id
            ];
        } else {
            $sql = "UPDATE pellet SET pelletOrderStatus = :status WHERE pelletOrder_id = :order_id";
            $params = [
                ':status' => $status,
                ':order_id' => $order_id
            ];
        }

        return $this->query($sql, $params);
  }

  public function getOrdersByStatus($status) {
    $query = "SELECT po.*, c.Name as customer_name 
              FROM pellet po
              JOIN customer c ON po.customer_id = c.customer_id 
              WHERE po.pelletOrderStatus = :status";
    $params = ['status' => $status];
    return $this->query($query, $params);
} 

public function countPendingOrders() {
    $query = "SELECT COUNT(*) as count FROM pellet WHERE pelletOrderStatus = 'pending'";
    $result = $this->query($query);
    return $result[0]->count ?? 0;
}

}