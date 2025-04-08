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
        } elseif (strlen($data['password']) < 8) {
            $this->errors['password'] = "Password must be at least 8 characters";
        }

        // If validation passes, set processed data with hashed password
        if (empty($this->errors)) {
            $this->processedData = [
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'role_id' => 3, // Default to customer role (numeric)
            ];
            return true;
        }

        return false;
    }
}
