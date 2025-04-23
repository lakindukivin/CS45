<?php

/**
 * User Class
 */
class User
{
    use Model;

    protected $table = 'user';
    protected $allowedColumns = ['email', 'password', 'role_id'];
    protected $beforeInsert = ['hashPassword'];

    public $errors = [];
    public $processedData = [];

    public function validate($data)
    {
        $this->errors = [];

        // Email validation
        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid";
        } else {
            // Check if email exists (case-insensitive)
            $existingUser = $this->first(['email' => strtolower($data['email'])]);
            if ($existingUser) {
                $this->errors['email'] = "Email is already in use";
            }
        }

        // Password validation
        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required";
        } elseif (strlen($data['password']) < 8) {
            $this->errors['password'] = "Password must be at least 8 characters";
        }

        // Role validation (if provided)
        if (isset($data['role_id']) && !in_array($data['role_id'], [1, 2, 3, 4, 5])) {
            $this->errors['role_id'] = "Invalid role specified";
        }

        if (empty($this->errors)) {
            $this->processedData = [
                'email' => strtolower(trim($data['email'])),
                'password' => $data['password'], // Will be hashed by beforeInsert hook
                'role_id' => $data['role_id'] ?? 3, // Default to Customer role
            ];
            return true;
        }

        return false;
    }

    // Automatically hash passwords before insertion
    protected function hashPassword($data)
    {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function addUser($data)
    {
        try {
            // Use the insert method from the Model trait
            if ($this->insert($data)) {
                // Alternative way to get last insert ID if $db isn't available
                $result = $this->first(['email' => $data['email']]);
                return $result ? $result->user_id : false;
            }
            return false;
        } catch (Exception $e) {
            error_log("Error adding user: " . $e->getMessage());
            return false;
        }
    }
}
