<?php

class AdsAndBannersModel
{
    use Model;

    protected $table = 'adsAndBanners';
    protected $allowedColumns = ['adsAndBanners_id', 'adsAndBannersName', 'adsAndBannersImage', 'adsAndBannersLink', 'adsAndBannersStatus', 'adsAndBannersStartDate', 'adsAndBannersEndDate'];

    public function getAdsAndBanners()
    {
        // Fixed SQL query with proper table aliases and selected columns
        $query = "SELECT adsAndBanners_id, adsAndBannersName, adsAndBannersImage, adsAndBannersLink, adsAndBannersStatus, adsAndBannersStartDate, adsAndBannersEndDate 
                 FROM adsAndBanners";
        return $this->query($query);
    }
    //get single product

    public function getSingleAdsAndBanners($adsAndBanners_id)
    {
        return $this->first(['adsAndBanners_id' => $adsAndBanners_id]);
    }

    // Get adsAndBanners by adsAndBanners ID
    public function getAdsAndBannersById($adsAndBanners_id)
    {
        $query = "SELECT * FROM adsAndBanners  WHERE adsAndBanners_id = :adsAndBanners_id";
        $params = ['adsAndBanners_id' => $adsAndBanners_id];
        return $this->query($query, $params);
    }

    // Check if a adsAndBanners exists by its ID
    public function findById($adsAndBanners_id)
    {
        return $this->first(['adsAndBanners_id' => $adsAndBanners_id]);
    }

    // add new adsAndBanners

    public function addAdsAndBanners($data)
    {
        return $this->insert($data);
    }

    // edit existing adsAndBanners
    public function editAdsAndBanners($id, $data, $id_column = 'adsAndBanners_id')
    {
        // Ensure only allowed columns are updated
        if (!empty($this->allowedColumns)) {
            $data = array_intersect_key($data, array_flip($this->allowedColumns));
        }
        //save the edited data
        return $this->update($id, $data, $id_column);
    }

    //delete exisiting adsAndBanners
    public function deleteAdsAndBanners($id)
    {
        return $this->delete($id);
    }}