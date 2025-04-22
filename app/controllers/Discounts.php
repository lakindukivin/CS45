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
            $model = new DiscountModel();
            $singleDiscount = $model->findById($_POST['discount_id']);
            echo json_encode($singleDiscount);
            exit;
        }

    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $data = [
                'product_id' => $_POST['product_id'],
                'discount_percentage' => $_POST['discount_percentage'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'status' => $_POST['status'],

            ];
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