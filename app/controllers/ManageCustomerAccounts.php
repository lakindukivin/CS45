<?php

/**
 * ManageCustomerAccounts class
 */

class ManageCustomerAccounts
{
    use Controller;

    private $manageCustomerAccountsModel;
    private $userModel;

    public function __construct()
    {
        $this->manageCustomerAccountsModel = new ManageCustomerAccountsModel();
        $this->userModel = new User();
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
            $customers = $this->manageCustomerAccountsModel->searchCustomers($search, $limit, $offset);
            $totalCustomers = $this->manageCustomerAccountsModel->searchCustomersCount($search);
        } else {
            $customers = $this->manageCustomerAccountsModel->getCustomersPaginated($limit, $offset);
            $totalCustomers = $this->manageCustomerAccountsModel->getCustomersCount();
        }
        $totalPages = ceil($totalCustomers / $limit);
        $this->view('admin/manageCustomerAccounts', [
            'customerAccounts' => $customers,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'search' => $search,

        ]);
    }
    // Update customer details
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['editCustomerId'])) {
                $data = [
                    'customer_id' => $_POST['editCustomerId'],
                    'name' => $_POST['editCustomerName'],
                    'image' => $_POST['editCustomerImage'] ?? null,
                    'phone' => $_POST['editCustomerContactNo'],
                    'address' => $_POST['editCustomerAddress'],
                    'status' => $_POST['editCustomerStatus']
                ];

                if ($this->manageCustomerAccountsModel->updateCustomer($_POST['editCustomerId'], $data)) {
                    $_SESSION['success'] = "Successfully updated!";
                    header("Location: " . ROOT . "/manageCustomerAccounts");
                    exit();
                }
            }
        }
    }

    // Delete customer (soft delete)
    public function delete()
    {
        if (isset($_POST['deleteCustomerId'])) {
            if ($this->manageCustomerAccountsModel->DeleteCustomer($_POST['deleteCustomerId'])) {
                $_SESSION['success'] = "Successfully deleted!";
                header("Location: " . ROOT . "/manageCustomerAccounts");
                exit();
            }
        }
    }

    // Restore customer
    public function restore()
    {
        if (isset($_POST['restoreCustomerId'])) {
            if ($this->manageCustomerAccountsModel->RestoreCustomer($_POST['restoreCustomerId'])) {
                $_SESSION['success'] = "Successfully restored!";
                header("Location: " . ROOT . "/manageCustomerAccounts");
                exit();
            }
        }
    }
}
?>