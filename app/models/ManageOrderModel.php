<?php

class ManageOrderModel
{
    use Model;

    protected $table = 'orders';
    protected $allowedColumns = [
        'Order_id',
        'product_id', 
        'customer_id',
        'Quantity',
        'Total',
        'deliveryAddress',
        'billingAddress', 
        'orderDate',
        'orderStatus'
    ];

    public function getAllOrders()
    {
        $query = "SELECT o.*, p.productName, c.Name as customerName 
                 FROM orders o 
                 JOIN product p ON o.product_id = p.Product_id 
                 JOIN customer c ON o.customer_id = c.Customer_id 
                 ORDER BY o.Order_id DESC";

        return $this->query($query);
    }

    public function updateOrderStatus($orderId, $status)
    {
        $data = [
            'orderStatus' => $status
        ];
        
        return $this->update($orderId, $data, 'Order_id');
    }
}
