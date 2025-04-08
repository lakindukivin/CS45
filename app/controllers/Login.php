<?php

class Login
{
    use Controller;

    public function index($data = [])
    {
        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (empty($_POST['email']) || empty($_POST['password'])) {
                $data['errors'] = ["Email and Password are required."];
            } else {
                $arr['email'] = $_POST['email'];
                $existingUser = $user->first($arr);

                if ($existingUser) {
                    // Verify password (hashed)
                    if (password_verify($_POST['password'], $existingUser->password)) {
                        // Start session if not already started
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }

                        $_SESSION['user_id'] = $existingUser->user_id;
                        $_SESSION['email'] = $existingUser->email;
                        $_SESSION['role_id'] = $existingUser->role_id;

                        // Redirect based on role_id
                        switch ($_SESSION['role_id']) {
                            case 1:  // Admin
                                header("Location: adminHome");
                                break;
                            case 2:  // Sales Manager
                                header("Location: salesManagerHome");
                                break;
                            case 3:  // Customer
                                header("Location: customerHome.php");
                                break;
                            case 4:  // Production Manager
                                header("Location: productionManagerHome.php");
                                break;
                            case 5:  // Customer Service Manager
                                header("Location: csManagerHome.php");
                                break;
                            default:
                                $data['errors'] = ["Invalid user role."];
                                $this->view('customer/login', $data);
                                exit();
                        }
                        exit();
                    } else {
                        $data['errors'] = ["Invalid email or password."];
                    }
                } else {
                    $data['errors'] = ["Invalid email or password."];
                }
            }
        }

        $this->view('customer/login', $data);
    }
}
