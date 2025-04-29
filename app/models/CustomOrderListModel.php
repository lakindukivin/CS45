<?php

class CustomOrderListModel
{
    use Model;

    protected $table = 'custom_order'; // Assuming your custom orders table is called 'custom_order'
    protected $allowedColumns = [
        'customOrder_id',
        'customer_id',
        'company_name',
        'quantity',
        'email',
        'phone',
        'type',
        'specifications',
        'customOrder_status',
        'created_at'
    ];

    /**
     * Fetch all custom orders for a specific customer.
     * 
     * @param array $conditions - Conditions to search for custom orders.
     * @param array $orderBy - The column to order by.
     * @param string $direction - The direction of the order, 'asc' or 'desc'.
     * @return array|bool - Returns an array of orders or false if none found.
     */
    public function where($conditions, $orderBy = [], $column = 'customOrder_id', $direction = 'asc')
    {
        try {
            $whereClause = $this->buildWhereClause($conditions); // Build the WHERE clause
            $query = "SELECT * FROM " . $this->table . " WHERE " . $whereClause . " ORDER BY " . $column . " " . $direction;
            $result = $this->query($query, $conditions); // Execute the query with conditions
            return $result ?: false;
        } catch (Exception $e) {
            error_log("Error fetching custom orders: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Build the WHERE clause for the SQL query based on conditions.
     *
     * @param array $conditions - Conditions to build the WHERE clause.
     * @return string - The WHERE clause of the query.
     */
    private function buildWhereClause($conditions)
    {
        $clauses = [];
        foreach ($conditions as $key => $value) {
            // Append each condition as `key = :key`
            $clauses[] = "$key = :$key";
        }
        // Join the conditions with 'AND' to form the complete WHERE clause
        return implode(' AND ', $clauses);
    }

    // You can add more methods here as needed
}
