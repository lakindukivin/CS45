<?php

class CustomOrderModel
{
    use Model;

    protected $table = 'custom_order'; // The table this model interacts with
    protected $allowedColumns = ['user_id', 'company_name', 'quantity', 'email', 'phone', 'type', 'specifications'];

    /**
     * Create a new order.
     * 
     * @param array $data - Associative array of data to insert into the table.
     * @return bool - Returns true if insertion was successful, false otherwise.
     */
    public function createOrder($data)
    {
        try {
            return $this->insert($data);
        } catch (Exception $e) {
            error_log("Error creating order: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get all custom orders for a specific user.
     * 
     * @param int $user_id - The user ID to fetch orders for.
     * @return array|bool - Returns an array of orders or false on failure.
     */
    public function getOrdersForUser($user_id)
    {
        try {
            return $this->where(['user_id' => $user_id]);
        } catch (Exception $e) {
            error_log("Error fetching orders: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Update a specific custom order
     *
     * @param int $order_id - The order ID to update.
     * @param array $data - The data to update the order with.
     * @param string $id_column - The column to use for identifying the order, default is 'order_id'
     * @return bool - Returns true on success, false otherwise.
     */
    public function update($order_id, $data, $id_column = 'order_id')
    {
        // Ensure only allowed columns are updated
        if (!empty($this->allowedColumns)) {
            $data = array_intersect_key($data, array_flip($this->allowedColumns));
        }

        // Perform the update query
        return $this->update($order_id, $data, $id_column);
    }
}
