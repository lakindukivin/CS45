<?php

/**
 * ManageCustomerAccounts class
 */

class ManageCustomerAccounts
{
    use Controller;

    private $manageCustomerAccountsModel;

    public function __construct()
    {
        $this->manageCustomerAccountsModel = new ManageCustomerAccountsModel();
    }
    public function index()
    {
        $customerAccounts = $this->manageCustomerAccountsModel->getAllCustomer();
        $this->view('admin/manageCustomerAccounts', [
            'customerAccounts' => $customerAccounts,
        ]);
    }

    public function getSingleCustomer()
    {

        if (isset($_POST['customer_id'])) {
            $singleCustomer = $this->manageCustomerAccountsModel->findById($_POST['customer_id']);
            echo json_encode($singleCustomer);
            exit;
        }

    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'address' => $_POST['address'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'status' => 1

            ];

            if ($this->manageCustomerAccountsModel->addCustomer($data)) {
                $_SESSION['success'] = "Successfully Added!";
                header("Location: " . ROOT . "/manageCustomerAccounts");
                exit();
            }
        }
    }

    //update customer details
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['customer_id'])) {
                $data = [
                    'customer_id' => $_POST['customer_id'],
                    'name' => $_POST['name'],
                    'address' => $_POST['address'],
                    'phone' => $_POST['phone'],
                    'email' => $_POST['email'],
                    'status' => $_POST['status']
                ];

                if ($this->manageCustomerAccountsModel->updateCustomer($_POST['customer_id'], $data)) {
                    $_SESSION['success'] = "Successfully updated!";
                    header("Location: " . ROOT . "/manageCustomerAccounts");
                    exit();
                }
            }
        }
    }

    //Delete customer
    public function delete()
    {
        if (isset($_POST['customer_id'])) {
            if ($this->manageCustomerAccountsModel->DeleteCustomer($_POST['customer_id'])) {
                $_SESSION['success'] = "Successfully deleted!";
                header("Location: " . ROOT . "/manageCustomerAccounts");
                exit();
            }
        }
    }

    public function restore()
    {
        if (isset($_POST['customer_id'])) {
            if ($this->manageCustomerAccountsModel->RestoreCustomer($_POST['customer_id'])) {
                $_SESSION['success'] = "Successfully restored!";
                header("Location: " . ROOT . "/manageCustomerAccounts");
                exit();
            }
        }
    }
}