<?php

/**
 * sales manager home class
 */

class AdsAndBanners
{
    use Controller;

    private $AdsAndBannersModel;

    public function __construct()
    {
        $this->AdsAndBannersModel = new AdsAndBannersModel();
    }
    public function index()
    {
        //get all ad and banners

        $adsBanners = $this->AdsAndBannersModel->getAdsAndBanners();
        $this->view('salesManager/adsAndBanners', [
            'adsAndBanners' => $adsBanners
        ]);
    }

    //Get single ad/banner 
    public function getSingleAd()
    {

        if (isset($_POST['ad_id'])) {
            $model = new ProductModel();
            $singleAd = $model->findById($_POST['ad_id']);
            echo json_encode($singleAd);
            exit;
        }

    }

    // Add ad/banner

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [

                'title' => $_POST['title'],
                'image' => $_POST['adImage'],
                'description' => $_POST['description'],
                'start_date' => $_POST['startDate'],
                'end_date' => $_POST['endDate'],
                'status' => 1
            ];


            if ($this->AdsAndBannersModel->addAdsAndBanners($data)) {
                $_SESSION['success'] = "Successfully Added!";
                header("Location: " . ROOT . "/adsAndBanners");
                exit();
            }
        }
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['adId'])) {
                $data = [

                    'ad_id' => $_POST['adId'],
                    'title' => $_POST['title'],
                    'image' => $_POST['adImage'],
                    'description' => $_POST['description'],
                    'start_date' => $_POST['startDate'],
                    'end_date' => $_POST['endDate']
                ];

                if ($this->AdsAndBannersModel->editAdsAndBanners($_POST['adId'], $data)) {
                    $_SESSION['success'] = "Successfully updated!";
                    header("Location: " . ROOT . "/adsAndBanners");
                    exit();
                }

            }
        }
    }

    public function delete()
    {

        if (isset($_POST['adId'])) {

            if ($this->AdsAndBannersModel->deleteAdsAndBanners($_POST['adId'])) {
                $_SESSION['success'] = "Successfully deleted!";
                header("Location: " . ROOT . "/adsAndBanners");
                exit();
            }
        }


    }
}