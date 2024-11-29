<?php

/** 
 * Main Model trait
 */

trait Model
{
    use Database;
    protected $limit = 10;
    protected $offset = '0';
    public $order_type = "desc";
    public $order_column = "customer_id";
    public $errors = [];

    public function findAll($order_column = null, $order_type = null)
    {
        $order_column = $order_column ?? $this->order_column;
        $order_type = $order_type ?? $this->order_type;

        $query = "select * from $this->table order by $order_column $order_type limit $this->limit offset $this->offset";

        return $this->query($query);
    }

    public function where($data, $data_not = [], $order_column = null, $order_type = null)
    {
        $order_column = $order_column ?? $this->order_column;
        $order_type = $order_type ?? $this->order_type;

        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . "= :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . "!= :" . $key . " && ";
        }

        $query = trim($query, " && ");

        $query .= " order by $order_column $order_type limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }

    public function first($data, $data_not = [], $order_column = null, $order_type = null)
    {

        $order_column = $order_column ?? $this->order_column;
        $order_type = $order_type ?? $this->order_type;

        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . "= :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . "!= :" . $key . " && ";
        }

        $query = trim($query, " && ");

        $query .= " limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        $result =  $this->query($query, $data);

        if ($result) {
            return $result[0];
        }
        return false;
    }

    public function insert($data)
    {
        // Remove unwanted data
        if (!empty($this->allowedColumns)) {
            $data = array_intersect_key($data, array_flip($this->allowedColumns));
        }

        // Ensure there's valid data to insert
        if (empty($data)) {
            throw new Exception("No valid data provided for insert operation.");
        }

        // Build the SQL query
        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (" . implode(",", $keys) . ") 
                  VALUES (:" . implode(",:", $keys) . ")";

        // Debugging (optional, for development purposes)
        error_log("Insert Query: $query");
        error_log("Data: " . print_r($data, true));

        // Execute the query
        $this->query($query, $data);

        // Indicate success
        return true;
    }


    public function update($id, $data, $id_column = 'id')
    {

        /** remove unwanted data */

        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "update $this->table set ";

        foreach ($keys as $key) {
            $query .= $key . "= :" . $key . " , ";
        }

        $query = trim($query, ", ");

        $query .= " where $id_column = :$id_column ";

        $data[$id_column] = $id;

        $this->query($query, $data);
        return false;
    }

    public function delete($id, $id_column = 'id')
    {

        $data[$id_column] = $id;

        $query = "delete from $this->table where $id_column = :$id_column";

        $this->query($query, $data);

        return false;
    }
}
