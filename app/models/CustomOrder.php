<?php

class CustomOrder
{
    use Model;

    protected $table = 'custom_order'; // Ensure this matches the table name
    protected $allowedColumns = ['user_id', 'company_name', 'quantity', 'email', 'phone', 'type', 'specifications'];

    /**
     * Save a new custom order to the database.
     *
     * @param array $data Key-value pairs of column names and values.
     * @return bool Success status of the operation.
     */
    public function createOrder($data)
    {
        // Filter the data to only include allowed columns
        $filteredData = array_filter($data, function ($key) {
            return in_array($key, $this->allowedColumns);
        }, ARRAY_FILTER_USE_KEY);

        // Insert the filtered data into the table
        return $this->insert($filteredData);
    }
}
