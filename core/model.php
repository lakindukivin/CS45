<?php

class Model {
    protected $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=your_db", "username", "password");
    }
}
