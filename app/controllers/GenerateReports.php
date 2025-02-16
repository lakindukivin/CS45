<?php

/**
 * sales manager home class
 */

class GenerateReports
{
    use Controller;
    public function index()
    {
        $this->view('salesManager/generateReports');
    }
}
