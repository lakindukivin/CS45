<?php

/**
 * sales manager home class
 */

class SotePerformance
{
    use Controller;
    public function index()
    {
        $this->view('admin/sitePerformance');
    }
}
