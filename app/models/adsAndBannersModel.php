<?php

class AdsAndBannersModel
{
    use Model;

    protected $table = 'ads_and_banners';
    protected $allowedColumns = ['ad_id', 'title', 'image', 'description', 'status', 'start_date', 'end_date'];

    public function getAdsAndBanners()
    {

        try {
            return $this->findAll('ad_id');
        } catch (Exception $e) {
            error_log("Error fetching products: " . $e->getMessage());
            return false;
        }
    }
    //get a single ad  in the database by category id

    public function findById($adId)
    {
        return $this->first(['ad_id' => $adId]);
    }


    // add new adsAndBanners

    public function addAdsAndBanners($data)
    {
        try {
            $this->insert($data);
            return true;


        } catch (Exception $e) {
            error_log("Error adding ad/banner: " . $e->getMessage());
            return false;
        }
    }

    // edit existing adsAndBanners
    public function editAdsAndBanners($id, $data)
    {
        // Ensure only allowed columns are updated
        try {
            $this->update($id, $data, 'ad_id');
            return true;
        } catch (Exception $e) {
            error_log("Error adding ad/banner: " . $e->getMessage());
            return false;
        }
    }

    //delete exisiting adsAndBanners
    public function deleteAdsAndBanners($id)
    {
        try {
            $this->delete($id,'ad_id');
            return true;
        } catch (Exception $e) {
            error_log("Error adding products: " . $e->getMessage());
            return false;
        }
    }
}