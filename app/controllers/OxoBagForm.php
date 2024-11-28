<?php

/**
 * oxo bag form class
 */

class OxoBagForm
{
    use Controller;
    public function index()
    {
        $this->view('customer/oxoBagForm');
    }
}
