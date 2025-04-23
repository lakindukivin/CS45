<?php

class StaffModel {
    use Model;

    protected $table = 'staff';

    /**
     * Get staff profile by user ID regardless of role
     * 
     * @param int $user_id The user ID
     * @return object|bool The staff profile data or false if not found
     */
    public function getStaffProfileById($user_id) {
        // Change r.role to r.role_name if that's the correct column name in your database
        $query = "SELECT u.*, s.*, r.role as role_name, r.role as role
                  FROM user u 
                  JOIN staff s ON u.user_id = s.user_id 
                  JOIN role r ON u.role_id = r.role_id 
                  WHERE u.user_id = :user_id";
        
        $result = $this->query($query, ['user_id' => $user_id]);
        
        if ($result) {
            // For debugging
            error_log("Staff profile found: " . print_r($result[0], true));
            return $result[0];
        }
        
        error_log("No staff profile found for user ID: $user_id");
        return false;
    }
    
    /**
     * Get staff profile by role name
     * 
     * @param string $role_name The role name
     * @return array The staff profiles for the given role
     */
    public function getStaffByRole($role_name) {
        $query = "SELECT u.*, s.*, r.role
                  FROM user u 
                  JOIN staff s ON u.user_id = s.user_id 
                  JOIN role r ON u.role_id = r.role_id 
                  WHERE r.role_name = :role_name";
        
        return $this->query($query, ['role_name' => $role_name]);
    }
    
    /**
     * Get all available roles
     * 
     * @return array All roles in the system
     */
    public function getAllRoles() {
        $query = "SELECT * FROM role ORDER BY role_id";
        return $this->query($query);
    }
    
    /**
     * Update staff profile details
     * 
     * @param int $user_id The user ID
     * @param array $data Profile data to update
     * @return bool Success status
     */
    public function updateStaffProfile($user_id, $data) {
        try {
            // Update user table
            $userQuery = "UPDATE user SET email = :email WHERE user_id = :user_id";
            $this->query($userQuery, [
                'email' => $data['email'],
                'user_id' => $user_id
            ]);
            
            // Update staff table
            $staffQuery = "UPDATE staff SET 
                          name = :name,
                          phone = :phone,
                          address = :address";
                          
            $params = [
                'name' => $data['name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'user_id' => $user_id
            ];
            
            // Add image if provided
            if (!empty($data['image'])) {
                $staffQuery .= ", image = :image";
                $params['image'] = $data['image'];
            }
            
            $staffQuery .= " WHERE user_id = :user_id";
            $this->query($staffQuery, $params);
            
            // If we got here without exceptions, the update was successful
            return true;
        } catch (Exception $e) {
            // Log the error
            error_log("Profile update error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Change staff password
     * 
     * @param int $user_id The user ID
     * @param string $new_password The new password (already hashed)
     * @return bool Success status
     */
    public function changePassword($user_id, $new_password) {
        $query = "UPDATE user SET password = :password WHERE user_id = :user_id";
        return $this->query($query, [
            'password' => $new_password,
            'user_id' => $user_id
        ]);
    }
}