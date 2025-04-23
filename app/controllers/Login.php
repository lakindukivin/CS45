<?php

class Login
{
    use Controller;

    const ROLE_ADMIN = 1;
    const ROLE_SALES_MANAGER = 2;
    const ROLE_CUSTOMER = 3;
    const ROLE_PRODUCTION_MANAGER = 5;
    const ROLE_CS_MANAGER = 4;

    public function index($data = [])
    {
        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (empty($_POST['email']) || empty($_POST['password'])) {
                $data['errors'][] = "Email and Password are required.";
            } else {
                $email = trim($_POST['email']);
                $password = $_POST['password'];

                $arr['email'] = $email;
                $existingUser = $user->first($arr);

                if ($existingUser) {
                    // Check both hashed and plain text passwords
                    $passwordMatch = false;

                    // First try password_verify for hashed passwords
                    if (password_verify($password, $existingUser->password)) {
                        $passwordMatch = true;
                    }
                    // If that fails, check plain text match (for legacy accounts)
                    elseif ($password === $existingUser->password) {
                        $passwordMatch = true;
                        // Upgrade to hashed password
                        $this->upgradePassword($existingUser->user_id, $password);
                    }

                    if ($passwordMatch) {
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                            session_regenerate_id(true);
                        }

                        $_SESSION['user_id'] = $existingUser->user_id;
                        $_SESSION['email'] = $existingUser->email;
                        $_SESSION['role_id'] = $existingUser->role_id;

                        $this->redirectBasedOnRole($existingUser->role_id);
                    } else {
                        $data['errors'][] = "Invalid email or password.";
                    }
                } else {
                    $data['errors'][] = "Invalid email or password.";
                }
            }
        }

        $this->view('customer/login', $data);
    }

    protected function upgradePassword($user_id, $password)
    {
        $user = new User();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user->update($user_id, ['password' => $hashedPassword], 'user_id');
    }

    protected function redirectBasedOnRole($roleId)
    {
        switch ($roleId) {
            case self::ROLE_ADMIN:
                header("Location: adminHome");
                break;
            case self::ROLE_SALES_MANAGER:
                header("Location: salesManagerHome");
                break;
            case self::ROLE_CUSTOMER:
                header("Location: Home");
                break;
            case self::ROLE_PRODUCTION_MANAGER:
                header("Location: productionManagerHome");
                break;
            case self::ROLE_CS_MANAGER:
                header("Location: csManagerHome");
                break;
            default:
                $_SESSION['error'] = "Invalid user role";
                header("Location: login");
                exit();
        }
        exit();
    }
}
