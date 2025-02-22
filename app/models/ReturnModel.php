<?php


class ReturnModel {
    use Model;

    protected $table = 'return_item';

    public function getAllReturns() {
        $query = "SELECT ri.*, o.customer_id, c.Name AS customer_name, o.Quantity, c.phone
                  FROM return_item ri
                  JOIN orders o ON ri.order_id = o.Order_id
                  JOIN customer c ON o.customer_id = c.Customer_id";

                  return $this->query($query);
    }

  }