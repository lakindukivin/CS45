<?php

class Login
{
    use Controller;

    public function index($data)
    {
        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $arr['email'] = $_POST['email'];

                $existingUser = $user->first($arr);

                if ($existingUser) {
                    // Debugging: Check if the correct user is retrieved
                    // var_dump($existingUser);
                    // exit();

                    // Password check (adjust if using plain text or hashed passwords)
                    if ($_POST['password'] === $existingUser->password) { // Use password_verify() if passwords are hashed

                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }

                        $_SESSION['user_id'] = $existingUser->user_id;
                        $_SESSION['email'] = $existingUser->email;
                        $_SESSION['role_id'] = $existingUser->role_id;

                        // Debugging: Check if session variables are set
                        // var_dump($_SESSION);
                        // exit();

                        // Redirect based on numeric Role_id
                        switch ($_SESSION['role_id']) {
                            case 1:  // Admin
                                header("Location: adminHome");
                                break;
                            case 2:  // Sales Manager
                                header("Location: salesManagerHome");
                                break;
                            case 3:  // Customer
                                header("Location: ProductionManagerHome");
                                break;
                            case 4:  // Production Manager
                                header("Location: CSManagerHome");
                                break;
                            case 5:  // Customer Service Manager
                                header("Location: profile");
                                break;
                            default:
                                echo "Invalid role.";
                                exit();
                        }
                        exit();
                    } else {
                        $data['errors'][] = "Invalid password.";
                    }
                } else {
                    $data['errors'][] = "No account found with that email.";
                }
            } else {
                $data['errors'][] = "Email and Password are required.";
            }
        }

        $this->view('customer/login', $data);
    }
}