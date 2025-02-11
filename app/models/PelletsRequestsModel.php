<?php

class PelletsRequestsModel {

    use Model;

    protected $table = 'pellet';
    protected $primaryKey = 'PelletOrder_id';

    public function getAll() {
        $query = "SELECT po.*, c.Name as customer_name 
        FROM pellet po
        JOIN customer c ON po.customer_id = c.Customer_id";
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

    public function updateOrderStatus($orderId, $status)
  {
        $query = "UPDATE pellet SET PelletOrder_status = :status WHERE PelletOrder_id = :id";
        $params = [
            'status' => $status,
            'id' => $orderId
        ];

        return $this->query($query, $params);
  }

}