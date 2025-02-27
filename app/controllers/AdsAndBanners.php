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
        // if (!Auth::isLoggedIn() || !Auth::isSalesManager()) {
        //         redirect('login');
        //     }

        $this->AdsAndBannersModel = new AdsAndBannersModel();
    }
    public function index()
    {
        //get all ad and banners
       
        $adsBanners = $this->AdsAndBannersModel->getAdsAndBanners();
        $this->view('salesManager/adsAndBanners',[
            'adsAndBanners' => $adsBanners
        ]);
    }
}
