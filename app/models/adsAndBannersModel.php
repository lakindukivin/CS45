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
            error_log("Error fetching Ads: " . $e->getMessage());
            return false;
        }
    }


    //pagination funtions
    public function getAdsPaginated($limit, $offset)
    {
        try {
            $this->limit = $limit;
            $this->offset = $offset;
            return $this->findAll('ad_id');
        } catch (Exception $e) {
            error_log("Error fetching paginated Ads: " . $e->getMessage());
            return false;
        }
    }

    public function getAdsCount()
    {
        try {
            $query = "SELECT COUNT(*) as count FROM $this->table";
            $result = $this->query($query);
            return $result ? $result[0]->count : 0;
        } catch (Exception $e) {
            error_log("Error counting Ads: " . $e->getMessage());
            return 0;
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
            $this->delete($id, 'ad_id');
            return true;
        } catch (Exception $e) {
            error_log("Error deleting Ads: " . $e->getMessage());
            return false;
        }
    }

    //search functions
    public function searchAds($search, $limit, $offset)
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

    public function searchAdsCount($search)
    {
        $search = '%' . $search . '%';
        $query = "SELECT COUNT(*) as count FROM $this->table WHERE title LIKE :search OR description LIKE :search OR start_date LIKE :search OR end_date LIKE :search";
        $params = ['search' => $search];
        $result = $this->query($query, $params);
        return $result ? $result[0]->count : 0;
    }



    //toggle status 
    public function setActive($id)
    {
        try {
            $query = 'UPDATE ads_and_banners SET status =1 WHERE ad_id = :id;';
            $params = ['id' => $id];
            $this->query($query, $params);
            return true;

        } catch (Exception $e) {
            error_log("Error changing status: " . $e->getMessage());
            return false;
        }


    }

    public function setInactive($id)
    {
        try {
            $query = 'UPDATE ads_and_banners SET status =0 WHERE ad_id = :id;';
            $params = ['id' => $id];
            $this->query($query, $params);
            return true;

        } catch (Exception $e) {
            error_log("Error changing status: " . $e->getMessage());
            return false;
        }

    }


}