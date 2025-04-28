<?php
class PelletesModel
{
    use Model;

    protected $table = "pellet_pricing";
    protected $allowedColumns = ['id', 'product_id', 'price'];


    public function getProductsPaginated($limit, $offset)
    {
        try {
            $this->limit = $limit;
            $this->offset = $offset;
            return $this->findAll('product_id');
        } catch (Exception $e) {
            error_log("Error fetching paginated products: " . $e->getMessage());
            return false;
        }
    }

    public function getProductsCount()
    {
        try {
            $query = "SELECT COUNT(*) as count FROM $this->table";
            $result = $this->query($query);
            return $result ? $result[0]->count : 0;
        } catch (Exception $e) {
            error_log("Error counting products: " . $e->getMessage());
            return 0;
        }
    }
    public function add($data)
    {
        try {
            $this->insert($data);
            return true;
        } catch (Exception $e) {
            error_log("Error adding price and weight: " . $e->getMessage());
            return false;
        }
    }

    public function updateTable($id, $data)
    {
        try {
            $this->update($id, $data, 'id');
            return true;
        } catch (Exception $e) {
            error_log("Error updating price and weight: " . $e->getMessage());
            return false;
        }
    }
}
?>