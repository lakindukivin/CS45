<?php

class CSmanagerProfileModel
{
    use Model;

    protected $table = 'staff'; // Primary table for CS manager
    protected $allowedColumns = [
        'staff_id',
        'name',
        'address',
        'phone',
        'image',
        'role_id',
        'user_id',
        'status'
    ];
    
    /**
     * Begin a database transaction
     * @return bool Success status
     */
    public function beginTransaction()
    {
        // Get the database connection from the Model trait
        $db = $this->getConnection();
        return $db->beginTransaction();
    }
    
    /**
     * Commit the active database transaction
     * @return bool Success status
     */
    public function commit()
    {
        $db = $this->getConnection();
        return $db->commit();
    }
    
    /**
     * Rollback the active database transaction
     * @return bool Success status
     */
    public function rollback()
    {
        $db = $this->getConnection();
        return $db->rollback();
    }
    
    /**
     * Get the database connection
     * @return PDO Database connection
     */
    private function getConnection()
    {
        // This method should return the PDO connection instance
        // Implement based on how your Model trait accesses the database
        return $this->db ?? $this->connect();
    }

    /**
     * Get Customer Service Manager profile data
     * @param int $userId User ID
     * @return object|false Profile data or false if not found
     */
    public function getProfileData($userId)
    {
        $query = "SELECT s.*, u.email, r.role as role_name 
                  FROM staff s
                  JOIN user u ON s.user_id = u.user_id
                  JOIN role r ON u.role_id = r.role_id
                  WHERE s.user_id = :user_id AND u.role_id = 4";
        
        $params = [
            'user_id' => $userId
        ];
        
        $result = $this->query($query, $params);
        return $result[0] ?? false;
    }

    /**
     * Update Customer Service Manager profile
     * @param int $userId User ID
     * @param array $data Profile data to update
     * @return bool Success status
     */
    public function updateProfile($userId, $data)
    {
        if (method_exists($this, 'beginTransaction')) {
            $this->beginTransaction();
        } else {
            throw new Exception("Undefined method 'beginTransaction'. Ensure the Model trait or class defines this method.");
        }
        
        try {
            // Update staff table
            $staff_data = [
                'name' => $data['name'],
                'address' => $data['address'],
                'phone' => $data['phone']
            ];
            
            // Add image to update if provided
            if (!empty($data['image'])) {
                // Store the exact path as provided without modifications
                $staff_data['image'] = $data['image'];
            }
            
            // Get the staff record first to ensure it exists
            $staff = $this->first(['user_id' => $userId]);
            
            if (!$staff) {
                // If no staff record exists, we need to create one
                $staff_data['user_id'] = $userId;
                $staff_data['role_id'] = 4; // Customer Service Manager role
                $staff_data['status'] = 1;
                $staff_update = $this->insert($staff_data);
            } else {
                // Update existing staff record
                $staff_update = $this->update($userId, $staff_data, 'user_id');
            }
            
            return true;
        } catch (Exception $e) {
            error_log("Profile update error: " . $e->getMessage());
            return false;
        }
    }
    
    
    /**
     * Change user password without using User model
     * @param int $userId User ID
     * @param string $currentPassword Current password
     * @param string $newPassword New password
     * @return bool|string True on success, error message on failure
     */
    public function changePassword($userId, $currentPassword, $newPassword)
    {
        // Get current user password directly
        $query = "SELECT password FROM user WHERE user_id = :user_id AND role_id = 4";
        $params = ['user_id' => $userId];
        
        $result = $this->query($query, $params);
        if (empty($result)) {
            return "User not found";
        }
        
        $storedPassword = $result[0]->password;
        
        // Verify password based on format (hashed or plain)
        $passwordCorrect = false;
        if (strlen($storedPassword) >= 60 && strpos($storedPassword, '$2y$') === 0) {
            // Password is hashed
            $passwordCorrect = password_verify($currentPassword, $storedPassword);
        } else {
            // Password is plain text
            $passwordCorrect = ($currentPassword === $storedPassword);
        }
        
        if (!$passwordCorrect) {
            return "Current password is incorrect";
        }
        
        // Hash new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        // Update password
        $update_query = "UPDATE user SET password = :password WHERE user_id = :user_id";
        $update_params = [
            'password' => $hashedPassword,
            'user_id' => $userId
        ];
        
        $this->query($update_query, $update_params);
        return true;
    }
}
