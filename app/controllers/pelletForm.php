<?php

/**
 * pellet form class
 */

class PelletForm
{
    use Controller;
    public function index()
    {
        $this->view('customer/pelletForm');
    }
}
