<?php
class ManageStaffAccountsModel
{
    use Model;

    protected $table = "staff";
    protected $allowedColumns = ['staff_id', 'name', 'address', 'phone', 'image', 'role_id', 'user_id', 'status'];

    //get all staff accounts
    public function getAllStaff($limit, $offset)
    {
        $query = "SELECT s.staff_id,s.name,s.address,s.phone,r.role,u.email,s.status,s.image
                  FROM staff s JOIN role r JOIN user u ON s.role_id=r.role_id AND s.user_id=u.user_id order by staff_id  limit $limit offset $offset";
        return $this->query($query);
    }
    public function getStaffPaginated($limit, $offset)
    {
        try {
            $this->limit = $limit;
            $this->offset = $offset;
            return $this->getAllStaff($limit, $offset);
        } catch (Exception $e) {
            error_log("Error fetching paginated staff: " . $e->getMessage());
            return false;
        }
    }

    public function getStaffCount()
    {
        try {
            $query = "SELECT COUNT(*) as count FROM $this->table";
            $result = $this->query($query);
            return $result ? $result[0]->count : 0;
        } catch (Exception $e) {
            error_log("Error counting staff: " . $e->getMessage());
            return 0;
        }
    }
    //Getting single staff in the database by staff id
    public function findById($staff_id)
    {
        return $this->first(['staff_id' => $staff_id]);

    }



    //Add new staff
    public function addStaff($data)
    {
        try {
            $this->insert($data);
            return true;
        } catch (Exception $e) {
            error_log("Error adding the person: " . $e->getMessage());
            return false;
        }


    }

    //Update Existing staff
    public function updateStaff($staff_id, $data)
    {
        try {
            $this->update($staff_id, $data, 'staff_id');
            return true;
        } catch (Exception $e) {
            error_log("Error updating staff: " . $e->getMessage());
            return false;
        }
    }

    //Delete staff
    public function DeleteStaff($staff_id)
    {
        try {
            $query = 'UPDATE staff SET status = 0 WHERE staff_id = :staff_id;';
            $params = ['staff_id' => $staff_id];
            $this->query($query, $params);
            return true;
        } catch (Exception $e) {
            error_log("Error deleting staff: " . $e->getMessage());
            return false;
        }
    }

    //Restore staff
    public function RestoreStaff($staff_id)
    {
        try {
            $query = 'UPDATE staff SET status = 1 WHERE staff_id = :staff_id;';
            $params = ['staff_id' => $staff_id];
            $this->query($query, $params);
            return true;
        } catch (Exception $e) {
            error_log("Error restoring staff: " . $e->getMessage());
            return false;
        }
    }

    public function searchStaff($search, $limit, $offset)
    {
        $search = '%' . $search . '%';
        $limit = (int) $limit;
        $offset = (int) $offset;
        $query = "SELECT * FROM staff s JOIN role r JOIN user u ON s.role_id=r.role_id AND s.user_id=u.user_id WHERE s.name LIKE :search OR u.email LIKE :search OR r.role LIKE :search ORDER BY staff_id DESC LIMIT $limit OFFSET $offset";
        $params = [
            'search' => $search
        ];
        return $this->query($query, $params);
    }

    public function searchStaffCount($search)
    {
        $search = '%' . $search . '%';
        $query = "SELECT COUNT(*) as count FROM staff s JOIN role r JOIN user u ON s.role_id=r.role_id AND s.user_id=u.user_id WHERE s.name LIKE :search OR u.email LIKE :search OR r.role LIKE :search";
        $params = ['search' => $search];
        $result = $this->query($query, $params);
        return $result ? $result[0]->count : 0;
    }
}
?>