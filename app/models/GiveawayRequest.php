<?php

class GiveawayRequest
{
    public function getByDate($date)
    {
        $query = "SELECT * FROM giveawayrequests WHERE DATE(request_date) = :date";
        return $this->query($query, ['date' => $date]);
    }

    private function query($query, $params)
    {
        // Example implementation of the query method
        // Replace this with actual database interaction logic
        return "Executing query: $query with parameters: " . json_encode($params);
    }
}