<?php

class PolytheneAmount  {

    use Model;  
    protected $table = 'polytheneamount';
    protected $primaryKey = 'polythene_id';
    protected $allowedColumns = [
        'polythene_amount', 
        'message',
        'month',
        'updated_date'
    ];
    
    public function updateAmount($data) {
        $data['updated_date'] = date('Y-m-d');
        // Check if record exists for this month
        $existing = $this->first(['month' => $data['month']]);
        
        if($existing) {
            return $this->update($existing->polythene_id, $data);
        } else {
            return $this->insert($data);
        }
    }
    public function getAllAmounts() {
        return $this->query("SELECT * FROM polytheneamount ORDER BY updated_date DESC");
    }

    public function getAllMonths() {
        return $this->query("SELECT month FROM polytheneamount");
    }
    
    public function monthExists($month) {
        $result = $this->first(['month' => $month]);
        return !empty($result);
    }


    //below methods (have no idea)

    public function getAmountByMonth($month) {
        $query = "SELECT * FROM polytheneamount WHERE month = :month";
        return $this->query($query, ['month' => $month]);
    }

    public function getLatestAmount() {
        $query = "SELECT * FROM polytheneamount ORDER BY updated_date DESC LIMIT 1";
        return $this->query($query);
    }
}
