<?php

class GuestCollectionModel {
  
  use Model;
  
  protected $table = 'guest_collection';
  protected $allowedColumns = [ 'collection_id','guest_name', 'phone', 'amount', 'date'];
  
 
  
  public function addCollection($data = []) {
    if(!empty($data)) {
      $data = array_filter($data, function ($key) {
        return in_array($key, $this->allowedColumns);
      }, ARRAY_FILTER_USE_KEY);
      return $this->insert($data);
    }
    return false;
  }

  public function countByDate($date) {
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
      throw new Exception("Invalid date format. Expected YYYY-MM-DD.");
    }
    
    // Use DATE() function to extract only the date part from timestamp date column name
    $query = "SELECT COUNT(collection_id) as count FROM guest_collection WHERE DATE(date) = :date";
    
    // Debug output to check what's happening (remove in production)
    // error_log("Querying guest count for date: $date");
    
    $result = $this->query($query, ['date' => $date]);
    
    // Debug output to check the result (remove in production)
    // error_log("Query result: " . print_r($result, true));
    
    // Return count or 0 if no results
    return (isset($result[0]->count)) ? $result[0]->count : 0;
  }

  public function getTotalAmountByDate($date) {
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
      throw new Exception("Invalid date format. Expected YYYY-MM-DD.");
    }
    
    // Sum up the amounts for the given date
    $query = "SELECT SUM(amount) as total FROM guest_collection WHERE DATE(date) = :date";
    $result = $this->query($query, ['date' => $date]);
    
    // Return total or 0 if no results
    return (isset($result[0]->total)) ? $result[0]->total : 0;
  }
}
