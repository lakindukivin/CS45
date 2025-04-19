<?php

class IssuesModel
{
    use Model;

    protected $table = 'issue'; // The table this model interacts with
    protected $allowedColumns = ['issue_id', 'description', 'status','action_taken'];

   //get all issues in db
    public function getAllIssues()
    {
    
        try {
            return $this->findAll('issue_id');
        } catch (Exception $e) {
            error_log("Error fetching products: " . $e->getMessage());
            return false;
        }
    }
//get one issue by id
    public function findById($issueId)
    {
        return $this->first(['issue_id' => $issueId]);
    }

    //customers add issues
    public function addIssues($data){
        try {
            $this->insert($data);
            return true;


        } catch (Exception $e) {
            error_log("Error reporting an issue: " . $e->getMessage());
            return false;
        }
    }

    // public function editIssues($id, $data)
    // {
    //     // Ensure only allowed columns are updated
    //     try {
    //         $this->update($id, $data, 'issue_id');
    //         return true;
    //     } catch (Exception $e) {
    //         error_log("Error editing: " . $e->getMessage());
    //         return false;
    //     }

    // }

    public function editIssues($id, $data)
    {
        // Only allow status and action_taken to be updated
        $allowedFields = ['status', 'action_taken'];
        $setParts = [];
        $params = [];

        foreach ($allowedFields as $field) {
            if (isset($data[$field])) {
                $setParts[] = "$field = :$field";
                $params[$field] = $data[$field];
            }
        }

        if (empty($setParts)) {
            return false; // Nothing to update
        }

        $sql = "UPDATE {$this->table} SET " . implode(', ', $setParts) . " WHERE issue_id = :issue_id";
        $params['issue_id'] = $id;

        try {
            $this->query($sql, $params);
            return true;
        } catch (Exception $e) {
            error_log("Error updating issue: " . $e->getMessage());
            return false;
        }
    }

    //delete a record
    public function deleteIssues($id)
    {
        try {
            $this->delete($id, 'issue_id');
            return true;
        } catch (Exception $e) {
            error_log("Error deleting issue updates: " . $e->getMessage());
            return false;
        }
    }
}