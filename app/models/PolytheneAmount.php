<?php

class PolytheneAmount  {

    use Model;  
    protected $table = 'polytheneamount';

    public function updateAmount($data) {
        $query = "INSERT INTO polytheneamount (polytheneamount, message, month) 
                 VALUES (:polytheneamount, :message, :month)";
        
        return $this->query($query, [
            'polytheneamount' => $data['amount'],
            'message' => $data['message'],
            'month' => $data['month']
        ]);
    }

    public function getAllAmounts() {
        $query = "SELECT * FROM polytheneamount ORDER BY updated_date DESC";
        return $this->query($query);
    }

    public function getAmountByMonth($month) {
        $query = "SELECT * FROM polytheneamount WHERE month = :month";
        return $this->query($query, ['month' => $month]);
    }

    public function getLatestAmount() {
        $query = "SELECT * FROM polytheneamount ORDER BY updated_date DESC LIMIT 1";
        return $this->query($query);
    }
}
