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
        // First try to get the order with completed status
        $query = "SELECT o.*, co.status, co.message_to_customer, p.productName, c.name AS customerName
                  FROM orders o
                  LEFT JOIN completed_orders co ON o.order_id = co.order_id
                  LEFT JOIN product p ON o.product_id = p.product_id
                  LEFT JOIN customer c ON o.customer_id = c.customer_id
                  WHERE o.order_id = :order_id";

        $data = [
            'order_id' => $order_id,
        ];

        $result = $this->query($query, $data);

        // Debugging: Log the query and result
        if (!$result) {
            error_log("Order not found for order_id: " . $order_id);
            error_log("Query executed: " . $query);
            error_log("Data passed: " . json_encode($data));
            return false;
        }

        error_log("Order found: " . json_encode($result[0]));
        return $result[0]; // Return the first result
    }

    public function addCompletedOrder($data)
    {
        // Ensure the order exists in the `orders` table
        $orderExists = $this->query("SELECT * FROM orders WHERE order_id = :order_id", ['order_id' => $data['order_id']]);
        if (!$orderExists) {
            error_log("Order ID does not exist in the orders table: " . $data['order_id']);
            throw new Exception("Order ID does not exist in the orders table.");
        }

        // Check if the order already exists in `completed_orders`
        $existingOrder = $this->query("SELECT * FROM completed_orders WHERE order_id = :order_id", ['order_id' => $data['order_id']]);
        if ($existingOrder) {
            // Update the existing record in `completed_orders`
            $query = "UPDATE completed_orders 
                      SET status = :status, message_to_customer = :message_to_customer, date_completed = NOW() 
                      WHERE order_id = :order_id";
        } else {
            // Insert a new record into `completed_orders`
            $query = "INSERT INTO completed_orders 
                      (order_id, status, message_to_customer, date_completed) 
                      VALUES (:order_id, :status, :message_to_customer, NOW())";
        }

        $result = $this->query($query, $data);

        // Debugging: Log the query and result
        if (!$result) {
            error_log("Failed to add or update completed order for order_id: " . $data['order_id']);
            return false;
        }

        // Update the `orderStatus` field in the `orders` table
        $updateOrderStatusQuery = "UPDATE orders SET orderStatus = :status WHERE order_id = :order_id";
        $updateResult = $this->query($updateOrderStatusQuery, [
            'status' => $data['status'],
            'order_id' => $data['order_id'],
        ]);

        if (!$updateResult) {
            error_log("Failed to update orderStatus in orders table for order_id: " . $data['order_id']);
            return false;
        }

        return true;
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

    //search pending orders by name and date
    public function getPendingOrders($page = 1, $limit = 10, $filters = [])
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT o.*, p.productName, c.name as customerName, b.bag_size, o.quantity, c.phone, o.total, o.orderDate 
                  FROM orders o 
                  JOIN product p ON o.product_id = p.product_id
                  JOIN bag_size b ON o.bag_id = b.bag_id
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE o.orderStatus = 'pending'";

        $params = [];

        // Add filters for name and date
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(o.orderDate) = :date";
            $params['date'] = $filters['date'];
        }

        $query .= " LIMIT $limit OFFSET $offset";

        return $this->query($query, $params);
    }

    // search accepted orders by name and date
    public function getAcceptedOrders($page = 1, $limit = 10, $filters = [])
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT co.*, p.productName, c.name as customerName , b.bag_size, o.quantity, c.phone, o.total, o.orderDate
                  FROM completed_orders co 
                  JOIN orders o ON co.order_id = o.order_id
                  JOIN bag_size b ON o.bag_id = b.bag_id
                  JOIN product p ON o.product_id = p.product_id 
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE co.status = 'accepted'";

        $params = [];

        // Add filters for name and date
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(co.date_completed) = :date";
            $params['date'] = $filters['date'];
        }

        $query .= " LIMIT $limit OFFSET $offset";

        return $this->query($query, $params);
    }

    //search processing orders by name and date
    public function getProcessingOrders($page = 1, $limit = 10, $filters = [])
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT co.*, p.productName, c.name as customerName, b.bag_size, o.quantity, c.phone, o.total, o.orderDate 
                  FROM completed_orders co 
                  JOIN orders o ON co.order_id = o.order_id
                  JOIN bag_size b ON o.bag_id = b.bag_id
                  JOIN product p ON o.product_id = p.product_id
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE co.status = 'processing'";

        $params = [];

        // Add filters for name and date
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(co.date_completed) = :date";
            $params['date'] = $filters['date'];
        }

        $query .= " LIMIT $limit OFFSET $offset";

        return $this->query($query, $params);
    }

    //search shipped orders by name and date
    public function getShippedOrders($page = 1, $limit = 10, $filters = [])
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT co.*, p.productName, c.name as customerName, b.bag_size, o.quantity, c.phone, o.total, o.orderDate  
                  FROM completed_orders co 
                  JOIN orders o ON co.order_id = o.order_id
                  JOIN bag_size b ON o.bag_id = b.bag_id
                  JOIN product p ON o.product_id = p.product_id 
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE co.status = 'shipped'";

        $params = [];

        // Add filters for name and date
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(co.date_completed) = :date";
            $params['date'] = $filters['date'];
        }

        $query .= " LIMIT $limit OFFSET $offset";

        return $this->query($query, $params);
    }

    //search delivered orders by name and date
    public function getDeliveredOrders($page = 1, $limit = 10, $filters = [])
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT co.*, p.productName, c.name as customerName,b.bag_size,  o.quantity, c.phone, o.total, o.orderDate  
                  FROM completed_orders co 
                  JOIN orders o ON co.order_id = o.order_id 
                  JOIN bag_size b ON o.bag_id = b.bag_id
                  JOIN product p ON o.product_id = p.product_id 
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE co.status = 'delivered'";

        $params = [];

        // Add filters for name and date
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(co.date_completed) = :date";
            $params['date'] = $filters['date'];
        }

        $query .= " LIMIT $limit OFFSET $offset";

        return $this->query($query, $params);
    }

    // search rejected orders by name and date
    public function getRejectedOrders($page = 1, $limit = 10, $filters = [])
    {
        $offset = ($page - 1) * $limit;

        $query = "SELECT co.*, p.productName, c.name as customerName,b.bag_size,  o.quantity, c.phone, o.total, o.orderDate 
                  FROM completed_orders co 
                  JOIN orders o ON co.order_id = o.order_id 
                  JOIN bag_size b ON o.bag_id = b.bag_id
                  JOIN product p ON o.product_id = p.product_id 
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE co.status = 'rejected'";

        $params = [];

        // Add filters for name and date
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(co.date_completed) = :date";
            $params['date'] = $filters['date'];
        }

        $query .= " LIMIT $limit OFFSET $offset";

        return $this->query($query, $params);
    }


    public function countPendingOrders($filters = [])
    {
        $query = "SELECT COUNT(o.order_id) as count 
                  FROM orders o 
                  JOIN product p ON o.product_id = p.product_id 
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE o.orderStatus = 'pending'";

        $params = [];

        // Add filters for name and date
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(o.orderDate) = :date";
            $params['date'] = $filters['date'];
        }

        $result = $this->query($query, $params);

        $result = $this->query($query, $params);
        return isset($result[0]->count) ? $result[0]->count : 0;
    }

    public function countAcceptedOrders($filters = [])
    {
        $query = "SELECT COUNT(co.order_id) as count 
                  FROM completed_orders co 
                  JOIN orders o ON co.order_id = o.order_id 
                  JOIN product p ON o.product_id = p.product_id 
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE co.status = 'accepted'";

        $params = [];

        // Add filters for name and date
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(co.date_completed) = :date";
            $params['date'] = $filters['date'];
        }

        $result = $this->query($query, $params);
        return isset($result[0]->count) ? $result[0]->count : 0;
    }


    public function countProcessingOrders($filters = [])
    {
        $query = "SELECT COUNT(co.order_id) as count 
                  FROM completed_orders co 
                  JOIN orders o ON co.order_id = o.order_id 
                  JOIN product p ON o.product_id = p.product_id 
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE co.status = 'processing'";

        $params = [];

        // Add filters for name and date
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(co.date_completed) = :date";
            $params['date'] = $filters['date'];
        }

        $result = $this->query($query, $params);
        return isset($result[0]->count) ? $result[0]->count : 0;
    }

    public function countShippedOrders($filters = [])
    {
        $query = "SELECT COUNT(co.order_id) as count 
                  FROM completed_orders co 
                  JOIN orders o ON co.order_id = o.order_id 
                  JOIN product p ON o.product_id = p.product_id 
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE co.status = 'shipped'";

        $params = [];

        // Add filters for name and date
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(co.date_completed) = :date";
            $params['date'] = $filters['date'];
        }

        $result = $this->query($query, $params);
        return isset($result[0]->count) ? $result[0]->count : 0;
    }

    public function countDeliveredOrders($filters = [])
    {
        $query = "SELECT COUNT(co.order_id) as count 
                  FROM completed_orders co 
                  JOIN orders o ON co.order_id = o.order_id 
                  JOIN product p ON o.product_id = p.product_id 
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE co.status = 'delivered'";

        $params = [];

        // Add filters for name and date
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(co.date_completed) = :date";
            $params['date'] = $filters['date'];
        }

        $result = $this->query($query, $params);
        return isset($result[0]->count) ? $result[0]->count : 0;
    }

    public function countRejectedOrders($filters = [])
    {
        $query = "SELECT COUNT(co.order_id) as count 
                  FROM completed_orders co 
                  JOIN orders o ON co.order_id = o.order_id 
                  JOIN product p ON o.product_id = p.product_id 
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE co.status = 'rejected'";

        $params = [];

        // Add filters for name and date
        if (!empty($filters['name'])) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['date'])) {
            $query .= " AND DATE(co.date_completed) = :date";
            $params['date'] = $filters['date'];
        }

        $result = $this->query($query, $params);
        return isset($result[0]->count) ? $result[0]->count : 0;
    }

    public function countByDate($date)
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            throw new Exception("Invalid date format. Expected YYYY-MM-DD.");
        }
        $query = "SELECT COUNT(order_id) as count FROM orders WHERE DATE(orderDate) = :date";
        $result = $this->query($query, ['date' => $date]);

        // Access the result as an object
        if (isset($result[0]->count)) {
            return $result[0]->count;
        }

        return 0;
    }

    public function getRecentOrders($limit = 8)
    {
        // Convert $limit to an integer to prevent SQL injection
        $limit = (int) $limit;

        // Modified to get only pending orders
        $query = "SELECT o.*, c.name as customerName 
                  FROM orders o 
                  JOIN customer c ON o.customer_id = c.customer_id 
                  WHERE o.orderStatus = 'pending'
                  ORDER BY o.orderDate DESC 
                  LIMIT $limit";

        return $this->query($query);
    }
}
