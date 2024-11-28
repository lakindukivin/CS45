<?php

/**
 * admin home class
 */

class AdminHome
{
    use Controller;
    public function index()
    {
        $this->view('admin/adminHome');
    }
}
