<?php

class GiveAwayRequestModel{

    use Model;
    protected $table = 'polythenegiveaway';
    protected $primaryKey = 'Giveaway_id';
    
    public function getAllGiveAwayRequests() {
        $query = "SELECT pg.*, c.Name as customer_name 
                 FROM {$this->table} pg 
                 JOIN customer c ON pg.Customer_id = c.Customer_id";
        return $this->query($query);
    }

    public function getGiveAwayRequestById($id) {
        $id = intval($id);
        $query = "SELECT pg.*, c.Name as customer_name 
                 FROM {$this->table} pg 
                 JOIN customer c ON pg.Customer_id = c.Customer_id 
                 WHERE pg.{$this->primaryKey} = ?";
        $result = $this->query($query, [$id]);
        return !empty($result) ? $result[0] : null;
    }

    public function updateGiveAwayRequest($data) {
        $id = $data[$this->primaryKey];
        unset($data[$this->primaryKey]);
        
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "`$key` = ?";
        }
        
        $query = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE {$this->primaryKey} = ?";
        $values = array_values($data);
        $values[] = $id;
        
        return $this->query($query, $values);
    }
}
