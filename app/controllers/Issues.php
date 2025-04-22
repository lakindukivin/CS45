<?php

/**
 * issues contoller class
 */

class Issues
{
    use Controller;

    private $IssueModel;

    public function __construct()
    {
        $this->IssueModel = new IssuesModel();
    }

    public function index()
    {
        // Ensure session is active
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Redirect to login if user is not authenticated
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
        }

        // Check if the user has the right role to access this page
        if ($_SESSION['role_id'] != 1) {
            redirect('login');
        }

        $limit = 10;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        if ($search !== '') {
            $issues = $this->IssueModel->searchIssues($search, $limit, $offset);
            $totalIssues = $this->IssueModel->searchIssuesCount($search);
        } else {
            $issues = $this->IssueModel->getIssuesPaginated($limit, $offset);
            $totalIssues = $this->IssueModel->getIssuesCount();
        }
        $totalPages = ceil($totalIssues / $limit);

        // // Fetch all issues from the database
        // $issues = $this->IssueModel->getAllIssues();

        $this->view('admin/issues', [
            'issues' => $issues,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'search' => $search,
        ]);
    }

    //Get single issue 
    public function getSingleIssue()
    {

        if (isset($_POST['issueId'])) {
            $model = new IssuesModel();
            $singleIssue = $model->findById($_POST['issueId']);
            echo json_encode($singleIssue);
            exit;
        }

    }

    //add issue
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [

                'description' => $_POST['description'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'status' => 0,
                'action_taken' => 'None'
            ];


            if ($this->IssueModel->addIssues($data)) {
                $_SESSION['success'] = "Successfully Added!";
                header("Location: " . ROOT . "/issues");
                exit();
            } else {
                $_SESSION['error'] = "Failed to add issue!";
                header("Location: " . ROOT . "/issues");
                exit();
            }
        }
    }

    //edit issue 
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['editIssueId'])) {
                $data = [

                    'issue_id' => $_POST['editIssueId'],
                    'description' => $_POST['description'],
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone'],
                    'status' => $_POST['status'],
                    'action_taken' => $_POST['actionsTaken']

                ];

                if ($this->IssueModel->editIssues($_POST['editIssueId'], $data)) {
                    $_SESSION['success'] = "Successfully updated!";
                    header("Location: " . ROOT . "/issues");
                    exit();
                } else {
                    $_SESSION['error'] = "Failed to update issue!";
                    header("Location: " . ROOT . "/issues");
                    exit();
                }
            }
        }

    }

    //delete issue
    public function delete()
    {

        if (isset($_POST['deleteIssueId'])) {

            if ($this->IssueModel->deleteIssues($_POST['deleteIssueId'])) {
                $_SESSION['success'] = "Successfully deleted!";
                header("Location: " . ROOT . "/issues");
                exit();
            } else {
                $_SESSION['error'] = "Failed to delete issue!";
                header("Location: " . ROOT . "/issues");
                exit();
            }
        }
    }
}