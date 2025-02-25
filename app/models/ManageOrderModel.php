<?php

class ManageOrderModel
{
    use Model;

    protected $table = 'orders';
    protected $allowedColumns = [
        'order_id',
        'product_id', 
        'customer_id',
        'quantity',
        'total',
        'deliveryAddress',
        'billingAddress', 
        'orderDate',
        'orderStatus'
    ];

    public function getAllOrders()
    {
        $query = "SELECT o.*, p.productName, c.Name as customerName 
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
