<?php

/**
 * sales manager home class
 */

class AdsAndBanners
{
    use Controller;
    public function index()
    {
        $this->view('salesManager/adsAndBanners');
    }
}
