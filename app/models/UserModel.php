<?php

class UserModel {
    use Model;

    protected $table = 'user';

    /**
     * Verify user password
     * 
     * @param int $user_id User ID
     * @param string $password Password to verify
     * @return bool Whether password is correct
     */
    public function verifyPassword($user_id, $password) {
        $query = "SELECT password FROM user WHERE user_id = :user_id";
        $result = $this->query($query, ['user_id' => $user_id]);
        
        if (!$result) {
            return false;
        }
        
        $hashedPassword = $result[0]->password;
        return password_verify($password, $hashedPassword);
    }
    
    /**
     * Get user by ID
     * 
     * @param int $user_id User ID
     * @return object|bool User data or false
     */
    public function getUserById($user_id) {
        $query = "SELECT * FROM user WHERE user_id = :user_id";
        $result = $this->query($query, ['user_id' => $user_id]);
        return $result ? $result[0] : false;
    }
    
    /**
     * Get user by email
     * 
     * @param string $email User email
     * @return object|bool User data or false
     */
    public function getUserByEmail($email) {
        $query = "SELECT * FROM user WHERE email = :email";
        $result = $this->query($query, ['email' => $email]);
        return $result ? $result[0] : false;
    }

    /**
     * Change user password
     * 
     * @param int $user_id User ID
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