<?php

/**
 * sales manager home class
 */

class arbonFootprint
{
    use Controller;
    public function index()
    {
        $this->view('salesManager/carbonFootprint');
    }
}
