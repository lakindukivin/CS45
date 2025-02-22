<?php

/**
 * sales manager home class
 */

class SitePerformance
{
    use Controller;
    public function index()
    {
        $this->view('admin/sitePerformance');
    }
}
