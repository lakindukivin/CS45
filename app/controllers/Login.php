<?php

class Login
{
    use Controller;

    public function index($data)
    {
        $user = new User();


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            session_unset();
            session_destroy();
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $arr['email'] = $_POST['email'];

                $existingUser = $user->first($arr);

                if ($existingUser) {
                    if ($_POST['password'] === $existingUser->Password) {

                        session_start();
                        $_SESSION['user_id'] = $existingUser->User_id;
                        $_SESSION['email'] = $existingUser->Email;
                        $_SESSION['role'] = $existingUser->Role_id; //! fix this role name shoule be passed

                        if ($_SESSION['role'] === 'customer') {
                            redirect('profile');
                        } elseif ($_SESSION['role'] === 1) {
                            redirect('adminHome');
                        } elseif ($_SESSION['role'] === 'productionManager') {
                            redirect('productionManagerHome');
                        } elseif ($_SESSION['role'] === 'salesManager') {
                            redirect('salesManagerHome');
                        } elseif ($_SESSION['role'] === 'customerServiceManager') {
                            redirect('cSManagerHome');
                        }
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
