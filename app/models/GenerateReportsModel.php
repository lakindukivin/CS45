<?php
class GenerateReportsModel
{
    use Model;

    // Fetch sales report data
    public function getSalesReport($startDate, $endDate)
    {
        $query = "SELECT * FROM orders WHERE orderDate BETWEEN :startDate AND :endDate";
        return $this->query($query, ['startDate' => $startDate, 'endDate' => $endDate]);
    }

    // Fetch discounts report data
    public function getDiscountsReport($startDate, $endDate)
    {
        $query = "SELECT * FROM discount WHERE start_date <= :endDate AND end_date >= :startDate";
        return $this->query($query, ['startDate' => $startDate, 'endDate' => $endDate]);
    }

    // Fetch ads/banners report data
    public function getAdsBannersReport($startDate, $endDate)
    {
        $query = "SELECT ad_id,title,description,start_date,end_date FROM ads_and_banners WHERE status=1 AND start_date <= :endDate AND end_date >= :startDate";
        return $this->query($query, ['startDate' => $startDate, 'endDate' => $endDate]);
    }

    // Fetch polythene collection report data
    public function getPolytheneCollectionReport($startDate, $endDate)
    {
        $query = "SELECT * FROM polythenecollection WHERE collection_date BETWEEN :startDate AND :endDate";
        return $this->query($query, ['startDate' => $startDate, 'endDate' => $endDate]);
    }

    // Fetch returned items report data
    public function getReturnedItemsReport($startDate, $endDate)
    {
        $query = "SELECT * FROM return_item WHERE date BETWEEN :startDate AND :endDate";
        return $this->query($query, ['startDate' => $startDate, 'endDate' => $endDate]);
    }

    // Fetch carbon footprint report data
    public function getCarbonFootprintReport($startDate, $endDate)
    {
        $query = "SELECT * FROM carbon_footprint WHERE date BETWEEN :startDate AND :endDate";
        return $this->query($query, ['startDate' => $startDate, 'endDate' => $endDate]);
    }
}