<?php

class Logout
{
    use Controller;

    public function index()
    {
        // Check if session is already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Destroy the session only if the user explicitly clicks the logout button
        // if (isset($_GET['logout'])) {
            // Unset all session variables
            session_unset();
            // Destroy the session
            session_destroy();

            // Redirect the user to the login page
            header('Location: ' . ROOT . '/login');
            exit();
        // }
    }
}
