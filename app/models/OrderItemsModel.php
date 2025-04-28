<?php

class OrderItemModel
{
    use Model;

    protected $table = 'order_items';
    protected $allowedColumns = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    // Insert each cart item into order_items table
    public function addOrderItem($order_id, $product_id, $quantity, $price)
    {
        $data = [
            'order_id' => $order_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $price
        ];

        $this->insert($data);
    }
}
