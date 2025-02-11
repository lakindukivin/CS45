<?php
class PolytheneAmountViewModel {
    use Model;
    
    protected $table = 'polytheneamount';

    public function getAllAmounts() {
        $query = "SELECT * FROM polytheneamount ORDER BY updated_date DESC";
        return $this->query($query);
    }

    public function updateAmount($data) {
        $query = "INSERT INTO polytheneamount (polytheneamount, message, month) 
                 VALUES (:polytheneamount, :message, :month)";
        
        return $this->query($query, [
            'polytheneamount' => $data['amount'],
            'message' => $data['message'],
            'month' => $data['month']
        ]);
    }
}
