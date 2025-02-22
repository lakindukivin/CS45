<?php

/**
 * sales manager home class
 */

class manageStaffAccounts
{
    use Controller;
    public function index()
    {
        $this->view('admin/manageStaffAccounts');
    }
}
