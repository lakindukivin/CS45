<?php

/**
 * regular bag form class
 */

class RegularBagForm
{
    use Controller;
    public function index()
    {
        $this->view('customer/regularBagForm');
    }
}
