<?php

class NormalOrderModel
{
    use Model;

    protected $table = 'completed_orders'; // correct table

    public function getCompletedOrdersByCustomerId($customerId)
    {
        // Step 1: Get all order_ids for this customer
        $orderModel = new OrderModel(); // we will need OrderModel
        $orders = $orderModel->where(['customer_id' => $customerId]);

        if (!$orders) {
            return []; // no orders found
        }

        // Step 2: Extract order IDs
        $orderIds = array_column($orders, 'order_id'); // assuming orders table has 'order_id'

        if (empty($orderIds)) {
            return []; // no orders
        }

        // Step 3: Fetch completed orders matching those order_ids
        $placeholders = implode(',', array_fill(0, count($orderIds), '?'));
        $query = "SELECT * FROM completed_orders WHERE order_id IN ($placeholders) ORDER BY date_completed DESC";

        return $this->query($query, $orderIds);
    }
}
