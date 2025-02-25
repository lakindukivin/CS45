<?php

class Login
{
    use Controller;

    public function index($data)
    {
        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['Email']) && isset($_POST['Password'])) {
                $arr['Email'] = $_POST['Email'];

                $existingUser = $user->first($arr);

                if ($existingUser) {
                    // Debugging: Check if the correct user is retrieved
                    // var_dump($existingUser);
                    // exit();

                    // Password check (adjust if using plain text or hashed passwords)
                    if ($_POST['Password'] === $existingUser->password) { // Use password_verify() if passwords are hashed

                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }

                        $_SESSION['User_id'] = $existingUser->user_id;
                        $_SESSION['Email'] = $existingUser->email;
                        $_SESSION['Role_id'] = $existingUser->role_id;

                        // Debugging: Check if session variables are set
                        // var_dump($_SESSION);
                        // exit();

                        // Redirect based on numeric Role_id
                        switch ($_SESSION['Role_id']) {
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