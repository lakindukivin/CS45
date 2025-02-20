<?php

/**
 * sales manager home class
 */

class CarbonFootprint
{
    use Controller;
    public function index()
    {
        $this->view('salesManager/carbonFootprint');
    }
}
