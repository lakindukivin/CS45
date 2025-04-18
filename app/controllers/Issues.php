<?php

/**
 * issues class
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
        // Fetch all issues from the database
        $issues = $this->IssueModel->getAllIssues();

        $this->view('admin/issues', ['issues' => $issues]);
    }

    //Get single issue 
    public function getSingleIssue()
    {

        if (isset($_POST['editIssueId'])) {
            $model = new IssuesModel();
            $singleIssue = $model->findById($_POST['editIssueId']);
            echo json_encode($singleIssue);
            exit;
        }

    }

    //add issue

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [

                'title' => $_POST['issueId'],
                'description' => $_POST['description'],
                'status' => 'Pending',
                'action_taken' => 'None'

            ];


            if ($this->IssueModel->addIssues($data)) {
                $_SESSION['success'] = "Successfully Added!";
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
                    'description' => $_POST['description'] ?? '',
                    'status' => $_POST['status']?? null,
                    'action_taken' => $_POST['actionsTaken']?? null

                ];

                if ($this->IssueModel->editIssues($_POST['editIssueId'], $data)) {
                    $_SESSION['success'] = "Successfully updated!";
                    header("Location: " . ROOT . "/issues");
                    exit();
                }
            }
        }

    }

    public function delete()
    {

        if (isset($_POST['deleteIssueId'])) {

            if ($this->IssueModel->deleteIssues($_POST['deleteIssueId'])) {
                $_SESSION['success'] = "Successfully deleted!";
                header("Location: " . ROOT . "/issues");
                exit();
            }
        }


    }
}