<?php

/**
 * sales manager home class
 */

class LegalIssues
{
    use Controller;
    
    public function index()
    {
        // Assuming you have a model for issues, e.g., IssueModel
        $issueModel = new Issues();

        // Fetch all issues from the database
        $issues = $issueModel->getAllIssues();

        // Pass the issues data to the view
        $this->view('admin/legalIssues', ['issues' => $issues]);
    }
}
