<?php

/**
 * sales manager home class
 */

class manageCustomerAccounts
{
    use Controller;
    public function index()
    {
        $this->view('admin/manageCustomerAccounts');
    }
}
