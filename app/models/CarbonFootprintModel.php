<?php

class CarbonFootprintModel
{
    use Model;

    protected $table = 'carbon_footprint'; // Table to store carbon footprint data
    protected $allowedColumns = ['id', 'customer_id', 'carbon_footprint_type_id', 'name', 'amount'];


    public function getAllCarbonFootprints()
    {
        try {
            return $this->findAll();
        } catch (Exception $e) {
            error_log("Error fetching data: " . $e->getMessage());
            return false;
        }
    }


    //pagination funtions
    public function getCarbonFootprintPaginated($limit, $offset)
    {
        try {
            $this->limit = $limit;
            $this->offset = $offset;
            $query = "SELECT cf.id, c.name as customer_name, t.type, cf.name, cf.amount FROM carbon_footprint cf JOIN customer c ON cf.customer_id = c.customer_id JOIN carbon_footprint_type t ON cf.carbon_footprint_type_id = t.id ORDER BY cf.id DESC LIMIT $limit OFFSET $offset";
            return $this->query($query);


        } catch (Exception $e) {
            error_log("Error fetching paginated CarbobFootprint: " . $e->getMessage());
            return false;
        }
    }

    public function getCarbonFootprintCount()
    {
        try {
            $query = "SELECT COUNT(*) as count FROM $this->table";
            $result = $this->query($query);
            return $result ? $result[0]->count : 0;
        } catch (Exception $e) {
            error_log("Error counting CarbobFootprint: " . $e->getMessage());
            return 0;
        }
    }

    public function addCarbonFootprint($data)
    {
        try {
            $this->insert($data);
            return true;
        } catch (Exception $e) {
            error_log("Error adding carbon footprint: " . $e->getMessage());
            return false;
        }
    }

    public function deleteCarbonFootprint($footprintId)
    {
        try {
            return $this->delete($footprintId);
        } catch (Exception $e) {
            error_log("Error deleting carbon footprint: " . $e->getMessage());
            return false;
        }
    }

    public function calculateCarbonFootprint($product_id, $bag_id = null, $pack_id = null, $quantity)
    {
        try {

            $query = "SELECT weight FROM product_has_bag_sizes WHERE product_id = :product_id AND bag_id = :bag_id";
            $params = [
                'product_id' => $product_id,
                'bag_id' => $bag_id,
            ];
            $result = $this->query($query, $params);
            $query2 = "SELECT pack_size FROM pack_size WHERE pack_id = :pack_id";
            $params2 = [
                'pack_id' => $pack_id,
            ];
            $result2 = $this->query($query2, $params2);

            if ($result && $result2) {
                $weight = $result[0]->weight;
                $pack_size = $result2[0]->pack_size;
                $carbonFootprint = $weight * $pack_size * $quantity;
                return $carbonFootprint;
            } else {
                return 0;
            }

        } catch (Exception $e) {
            error_log("Error calculating carbon footprint: " . $e->getMessage());
            return false;
        }

    }

    public function searchCarbonFootprint($search, $limit, $offset)
    {
        $search = '%' . $search . '%';
        $limit = (int) $limit;
        $offset = (int) $offset;
        $query = "SELECT * FROM $this->table WHERE  title LIKE :search OR description LIKE :search OR start_date LIKE :search OR end_date LIKE :search ORDER BY ad_id DESC LIMIT $limit OFFSET $offset";
        $params = [
            'search' => $search
        ];
        return $this->query($query, $params);
    }

    public function searchCarbonFootprintCount($search)
    {
        $search = '%' . $search . '%';
        $query = "SELECT COUNT(*) as count FROM $this->table WHERE title LIKE :search OR description LIKE :search OR start_date LIKE :search OR end_date LIKE :search";
        $params = ['search' => $search];
        $result = $this->query($query, $params);
        return $result ? $result[0]->count : 0;
    }


}