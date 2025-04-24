<?php

class GuestCollectionModel {
  
  use Model;
  
  protected $table = 'guest_collection';
  protected $allowedColumns = [ 'guest_name', 'phone', 'amount'];
  
 
  
  public function addCollection($data = []) {
    if(!empty($data)) {
      $data = array_filter($data, function ($key) {
        return in_array($key, $this->allowedColumns);
      }, ARRAY_FILTER_USE_KEY);
      return $this->insert($data);
    }
    return false;
  }
}
