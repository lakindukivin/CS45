<?php

/**
 * sales manager home class
 */

class LegalIssues
{
    use Controller;
    public function index()
    {
        $this->view('admin/legalIssues');
    }
}
