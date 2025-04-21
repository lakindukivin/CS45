<?php

/**
 * User Class
 */
class User
{
    use Model;

    protected $table = 'user';
    protected $allowedColumns = ['email', 'password', 'role_id'];

    public $errors = [];
    public $processedData = [];

    public function validate($data)
    {
        $this->errors = []; // Reset errors

        // Email validation
        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid";
        } else {
            // Check if email already exists
            $arr['email'] = $data['email'];
            $existingCustomer = $this->first($arr);
            if ($existingCustomer) {
                $this->errors['email'] = "Email is already in use";
            }
        }

        // Password validation
        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required";
        }

        // If validation passes, set processed data without hashing the password
        if (empty($this->errors)) {
            $this->processedData = [
                'email' => $data['email'],
                'password' => $data['password'], // Plain text password (not secure)
                'role_id' => $data['role_id'] ?? null, // Optional role_id
            ];
            return true;
        }

        return false;
    }

    public function addUser($data)
    {
        try {
            $this->insert($data);
            $user_id = $this->get_row("SELECT user_id FROM user WHERE email = :email", ['email' => $data['email']])->user_id;
            return $user_id;
            
        // Return the inserted user ID
        } catch (Exception $e) {
            error_log("Error adding user: " . $e->getMessage());
            return false;
        }
    }


}
