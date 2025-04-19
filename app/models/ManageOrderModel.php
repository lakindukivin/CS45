<?php

class ManageOrderModel
{
    use Model;

    protected $table = 'orders';
    protected $table2 = 'completed_orders';

    public function getAllOrders()
    {
        $query = "SELECT o.*, p.productName, c.name as customerName 
                 FROM orders o 
                 JOIN product p ON o.product_id = p.product_id 
                 JOIN customer c ON o.customer_id = c.customer_id 
                 WHERE o.orderStatus = 'pending'
                 ORDER BY o.orderDate DESC";

        return $this->query($query);
    }

    public function updateOrderStatus($order_id, $status)
    {
        $query = "UPDATE orders SET orderStatus = :status WHERE order_id = :orderId";
        $data = [
            'orderId' => $order_id,
            'status' => $status,
        ];
        return $this->query($query, $data);
    }

    public function getOrderById($order_id)
    {
        $query = "SELECT * FROM orders WHERE order_id = :order_id";
        $data = [
            'order_id' => $order_id,
        ];
        return $this->query($query, $data);
    }

    public function addCompletedOrder($data)
    {
        // Check if the order_id already exists in completed_orders
        $existingOrder = $this->query("SELECT * FROM completed_orders WHERE order_id = :order_id", ['order_id' => $data['order_id']]);
        if ($existingOrder) {
            // If it exists, update the existing record instead of inserting
            $query = "UPDATE completed_orders 
                      SET status = :status, message_to_customer = :message_to_customer 
                      WHERE order_id = :order_id";
        } else {
            // If it doesn't exist, insert a new record
            $query = "INSERT INTO completed_orders 
                      (order_id, status, message_to_customer) 
                      VALUES (:order_id, :status, :message_to_customer)";
        }
        return $this->query($query, $data);
    }

    public function getAllCompletedOrders()
    {
        $query = "SELECT co.*, o.customer_id, c.name AS customerName, o.quantity, c.phone, p.productName, o.total,  o.orderDate
                    FROM completed_orders co
                    JOIN orders o ON co.order_id = o.order_id
                    JOIN customer c ON o.customer_id = c.customer_id
                    JOIN product p ON o.product_id = p.product_id
                    ORDER BY co.date_completed DESC";
        return $this->query($query);
    }

    public function updateCompletedOrder($orderId, $data)
    {
        $query = "UPDATE completed_orders 
                  SET message_to_customer = :message_to_customer 
                  WHERE order_id = :orderId";
        return $this->query($query, array_merge($data, ['orderId' => $orderId]));
    }

    public function getOrderByCustomerId($customerId)
    {
        $query = "SELECT * FROM orders WHERE customer_id = :customerId";
        $data = [
            'customerId' => $customerId,
        ];
        return $this->query($query, $data);
    }

    // Add this new method to get orders by status
    public function getCompletedOrdersByStatus($status)
    {
        $query = "SELECT co.*, o.customer_id, c.name AS customerName, o.quantity, c.phone, 
                  p.productName, o.total, o.orderDate, o.delivery_address, o.billing_address
                  FROM completed_orders co
                  JOIN orders o ON co.order_id = o.order_id
                  JOIN customer c ON o.customer_id = c.customer_id
                  JOIN product p ON o.product_id = p.product_id
                  WHERE co.status = :status
                  ORDER BY co.date_completed DESC";
        
        return $this->query($query, ['status' => $status]);
    }

    // Optional method to get order details including addresses
    public function getOrderDetails($orderId)
    {
        $query = "SELECT o.*, co.status, co.message_to_customer, co.date_completed,
                  c.name AS customerName, p.productName
                  FROM orders o
                  JOIN completed_orders co ON o.order_id = co.order_id
                  JOIN customer c ON o.customer_id = c.customer_id
                  JOIN product p ON o.product_id = p.product_id
                  WHERE o.order_id = :orderId";
        
        $result = $this->query($query, ['orderId' => $orderId]);
        return $result ? $result[0] : false;
    }

}
