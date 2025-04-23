<?php
class Discounts
{
    use Controller;
    private $discountModel;

    public function __construct()
    {

        $this->discountModel = new DiscountModel();
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
        if ($_SESSION['role_id'] != 2) {
            redirect('login');
        }

        // Get all products for the add discount form
        $products = new ProductModel();
        $allProducts = $products->getAllProducts();

        // Get all discounts with product information
        $limit = 10;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        if ($search !== '') {
            $discounts = $this->discountModel->searchDiscount($search, $limit, $offset);
            $totalDiscounts = $this->discountModel->searchDiscountCount($search);
        } else {
            $discounts = $this->discountModel->getDiscountsPaginated($limit, $offset);
            $totalDiscounts = $this->discountModel->getDiscountsCount();
        }
        $totalPages = ceil($totalDiscounts / $limit);

        $this->view('salesManager/discounts', [
            'discounts' => $discounts,
            'products' => $allProducts,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'search' => $search,
        ]);

    }

    public function getSingleDiscount()
    {

        if (isset($_POST['discount_id'])) {
            $singleDiscount = $this->discountModel->findById($_POST['discount_id']);
            echo json_encode($singleDiscount);
            exit;
        }

    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $data = [
                'product_id' => $_POST['productId'],
                'discount_percentage' => $_POST['discountPercentage'],
                'start_date' => $_POST['startDate'],
                'end_date' => $_POST['endDate'],
                'status' => 1,

            ];

            if ($this->discountModel->addDiscount($data)) {
                $_SESSION['success'] = "Successfully Added!";
                header("Location: " . ROOT . "/discounts");
                exit();
            } else {
                $_SESSION['error'] = "Failed to add !";
                header("Location: " . ROOT . "/discounts");
                exit();
            }
        }
    }

    
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'discount_id' => $_POST['editDiscountId'],
                'product_id' => $_POST['editProductId'],
                'discount_percentage' => $_POST['editDiscountPercentage'],
                'start_date' => $_POST['editStartDate'],
                'end_date' => $_POST['editEndDate'],
                'status' => $_POST['editStatus'],

            ];

            if ($this->discountModel->updateDiscount($_POST['editDiscountId'], $data)) {
                $_SESSION['success'] = "Successfully Updated!";
                header("Location: " . ROOT . "/discounts");
                exit();
            } else {
                $_SESSION['error'] = "Failed to update !";
                header("Location: " . ROOT . "/discounts");
                exit();
            }
        }
    }

    public function delete(){
        if (isset($_POST['deleteDiscountId'])) {
            if ($this->discountModel->delete($_POST['deleteDiscountId'])) {
                $_SESSION['success'] = "Successfully deleted!";
                header("Location: " . ROOT . "/discounts");
                exit();
            } else {
                $_SESSION['error'] = "Failed to delete discount!";
                header("Location: " . ROOT . "/discounts");
                exit();
            }
        }
    }
     


    public function setActive()
    {
        if (isset($_GET['discount_id'])) {
            if ($this->discountModel->setActive($_GET['discount_id'])) {
                $_SESSION['success'] = "Successfully activated!";
                header("Location: " . ROOT . "/discounts");
                exit();
            } else {
                $_SESSION['error'] = "Failed to activate product!";
                header("Location: " . ROOT . "/discounts");
                exit();
            }
        }

    }

    public function setInactive()
    {
        if (isset($_GET['discount_id'])) {
            if ($this->discountModel->setInactive($_GET['discount_id'])) {
                $_SESSION['success'] = "Successfully deactivated!";
                header("Location: " . ROOT . "/discounts");
                exit();
            } else {
                $_SESSION['error'] = "Failed to deactivate product!";
                header("Location: " . ROOT . "/discounts");
                exit();
            }
        }

    }
}