<?php

/**
 * contact class
 */
class Contact
{
    use Controller;

    private $issuesModel;

    public function __construct()
    {
        $this->issuesModel = new IssuesModel();
    }
    public function index()
    {
        $this->view('customer/contact');
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'description' => $_POST['description'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'status' => 0,
                'action_taken' => 'none',
                'created_at' => date('Y-m-d'),
                'updated_at'=> date('Y-m-d'),
            ];
            if ($_POST['reason'] == 'general') {
                if ($this->issuesModel->addIssues($data)) {
                    $_SESSION['success'] = "Issue Successfully Reported";
                    header("Location: " . ROOT . "/contact");
                    exit();
                } else {
                    $_SESSION['error'] = "Failed to add ";
                    header("Location: " . ROOT . "/contact");
                    exit();
                }


            }
        }
    }
}