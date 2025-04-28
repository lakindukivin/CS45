<?php


class IssuesModel
{
    use Model;

    protected $table = 'issue'; // The table this model interacts with
    protected $allowedColumns = ['issue_id', 'description', 'email', 'phone', 'status', 'action_taken'];

    //get all issues in db
    public function getAllIssues()
    {

        try {
            return $this->findAll('issue_id');
        } catch (Exception $e) {
            error_log("Error fetching Issues: " . $e->getMessage());
            return false;
        }
    }

    //get all issues in db with pagination
    public function getIssuesPaginated($limit, $offset)
    {
        try {
            $this->limit = $limit;
            $this->offset = $offset;
            return $this->findAll('issue_id');
        } catch (Exception $e) {
            error_log("Error fetching paginated Issues: " . $e->getMessage());
            return false;
        }
    }

    public function getIssuesCount()
    {
        try {
            $query = "SELECT COUNT(*) as count FROM $this->table";
            $result = $this->query($query);
            return $result ? $result[0]->count : 0;
        } catch (Exception $e) {
            error_log("Error counting Issues: " . $e->getMessage());
            return 0;
        }
    }
    //get one issue by id
    public function findById($issueId)
    {
        return $this->first(['issue_id' => $issueId]);
    }

    //customers add issues
    public function addIssues($data)
    {
        try {
            $this->insert($data);
            return true;


        } catch (Exception $e) {
            error_log("Error reporting an issue: " . $e->getMessage());
            return false;
        }
    }
    // sales manager update details of issues
    public function editIssues($id, $data)
    {
        // Ensure only allowed columns are updated
        try {
            $this->update($id, $data, 'issue_id');
            return true;
        } catch (Exception $e) {
            error_log("Error editing: " . $e->getMessage());
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

    public function searchIssues($search, $limit, $offset)
    {
        $search = '%' . $search . '%';
        $limit = (int) $limit;
        $offset = (int) $offset;
        $query = "SELECT * FROM $this->table WHERE description LIKE :search OR action_taken LIKE :search ORDER BY issue_id DESC LIMIT $limit OFFSET $offset";
        $params = [
            'search' => $search
        ];
        return $this->query($query, $params);
    }

    public function searchIssuesCount($search)
    {
        $search = '%' . $search . '%';
        $query = "SELECT COUNT(*) as count FROM $this->table WHERE description LIKE :search OR action_taken LIKE :search";
        $params = ['search' => $search];
        $result = $this->query($query, $params);
        return $result ? $result[0]->count : 0;
    }

    public function getRecentIssues($limit = 8)
    {
        // Convert $limit to an integer to prevent SQL injection
        $limit = (int) $limit;

        // Query to get recent issues
        // Assuming there's a created_at or similar timestamp field
        // If your table has a different date/time field, replace 'created_at' with that field name
        $query = "SELECT * FROM $this->table 
                  WHERE status = 0 
                  ORDER BY created_at DESC 
                  LIMIT $limit";

        return $this->query($query);
    }
}