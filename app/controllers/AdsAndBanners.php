<?php

/**
 * sales manager home class
 */

class AdsAndBanners
{
    use Controller;
    public function index()
    {
        //get all ad and banners
        $adsBannerss = new AdsAndBannersModel();
        $adsBannerss = $adsBannerss->getAdsAndBanners();
        $this->view('salesManager/adsAndBanners',[]);
    }
}
