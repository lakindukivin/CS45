<?php


class ReturnModel {
    use Model;

    protected $table = 'return_item';

    public function getAllReturns() {
        $query = "SELECT ri.*, o.customer_id, c.name AS customerName, o.quantity, c.phone, p.productName, o.total,  o.orderDate
                  FROM return_item ri
                  JOIN orders o ON ri.order_id = o.order_id
                  JOIN customer c ON o.customer_id = c.customer_id
                  JOIN product p ON o.product_id = p.product_id";

                  return $this->query($query);
    }

  }