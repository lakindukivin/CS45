<?php

class CarbonFootprintModel
{
    use Model;

    protected $table = 'carbon_footprint'; // Table to store carbon footprint data
    protected $allowedColumns = ['footprint_id', 'month', 'amount']; // Columns allowed for insertion/update

    // /**
    //  * Calculate and save the monthly carbon footprint.
    //  * 
    //  * @return bool - Returns true if the calculation and insertion are successful, false otherwise.
    //  */
    // public function calculateAndSaveMonthlyCarbonFootprint()
    // {
    //     try {
    //         // Fetch total giveaway quantity from the giveaway table
    //         $giveawayQuery = "SELECT SUM(quantity) as total_giveaway FROM polythenegiveaway WHERE MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())";
    //         $giveawayResult = $this->query($giveawayQuery);
    //         $totalGiveaway = $giveawayResult[0]['total_giveaway'] ?? 0;

    //         // Fetch total order quantity from the order table
    //         $orderQuery = "SELECT SUM(quantity) as total_order FROM `orders` WHERE MONTH(order_date) = MONTH(CURRENT_DATE()) AND YEAR(order_date) = YEAR(CURRENT_DATE())";
    //         $orderResult = $this->query($orderQuery);
    //         $totalOrder = $orderResult[0]['total_order'] ?? 0;

    //         // Calculate the total carbon footprint saved
    //         $carbonFootprintSaved = $totalGiveaway + $totalOrder;

    //         // Prepare data for insertion
    //         $data = [
    //             'value' => $carbonFootprintSaved,
    //             'unit' => 'kg',
    //             'date' => date('Y-m-d H:i:s') // Current timestamp
    //         ];

    //         // Insert the calculated carbon footprint into the carbon_footprint table
    //         return $this->insert($data);
    //     } catch (Exception $e) {
    //         error_log("Error calculating and saving carbon footprint: " . $e->getMessage());
    //         return false;
    //     }
    // }

    /**
     * Get the latest carbon footprint data.
     * 
     * @return array|bool - Returns the latest carbon footprint data or false on failure.
     */
    // public function getCurrentCarbonFootprint()
    // {
    //     try {
    //         // Fetch the latest carbon footprint data
    //         $query = "SELECT value, unit FROM {$this->table} ORDER BY date DESC LIMIT 1";
    //         $result = $this->query($query);

    //         if ($result && count($result) > 0) {
    //             return $result[0]; // Return the latest record
    //         }

    //         return false; // Return false if no data is found
    //     } catch (Exception $e) {
    //         error_log("Error fetching carbon footprint data: " . $e->getMessage());
    //         return false;
    //     }
    // }


    public function getAllCarbonFootprints()
    {
        // Fetch all carbon footprint data
        $query = "SELECT * FROM {$this->table}";
        return $this->query($query);
    }
}