<?php

class ManageOrderModel
{
    use Model;

    protected $table = 'orders';

    public function getAllOrders()
    {
        $query = "SELECT o.*, p.productName, c.name as customerName 
                 FROM orders o 
                 JOIN product p ON o.product_id = p.product_id 
                 JOIN customer c ON o.customer_id = c.customer_id 
                 ORDER BY o.order_id DESC";

        return $this->query($query);
    }

    public function updateOrderStatus($orderId, $status)
    {
        $data = [
            'orderStatus' => $status
        ];
        
        return $this->update($orderId, $data, 'order_id');
    }
}
