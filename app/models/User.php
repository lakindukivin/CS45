<?php

/**
 * User Class
 */
class User
{
    use Model;

    protected $table = 'user';
    protected $allowedColumns = ['email', 'password', 'role'];

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
                'role' => 'customer',
            ];
            return true;
        }

        return false;
    }
}
