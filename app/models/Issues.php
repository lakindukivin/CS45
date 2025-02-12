<?php

class Issues
{
    use Model;

    protected $table = 'issues'; // The table this model interacts with
    protected $allowedColumns = ['issue_id', 'description', 'status', 'actions_taken'];

    /**
     * Get all issues from the database.
     * 
     * @return array|bool - Returns an array of issues or false on failure.
     */
    public function getAllIssues()
    {
        try {
            return $this->findAll();
        } catch (Exception $e) {
            error_log("Error fetching issues: " . $e->getMessage());
            return false;
        }
    }
}