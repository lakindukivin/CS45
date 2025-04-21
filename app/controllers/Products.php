<?php

/**
 * product class
 */

class Products
{
    use Controller;

    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }


    // Send data to vie page
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

        // Pagination setup
        $limit = 5;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        if ($search !== '') {
            $products = $this->productModel->searchProducts($search, $limit, $offset);
            $totalProducts = $this->productModel->searchProductsCount($search);
        } else {
            $products = $this->productModel->getProductsPaginated($limit, $offset);
            $totalProducts = $this->productModel->getProductsCount();
        }
        $totalPages = ceil($totalProducts / $limit);

        $this->view('salesManager/products', [
            'products' => $products,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'search' => $search,
        ]);


    }

    //Get single product 
    public function getSingleProduct()
    {

        if (isset($_POST['product_id'])) {
            $model = new ProductModel();
            $singleProduct = $model->findById($_POST['product_id']);
            echo json_encode($singleProduct);
            exit;
        }

    }

    //Add product
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'productName' => $_POST['productName'],
                'productImage' => $_POST['img'],
                'productDescription' => $_POST['description'],
                'productStatus' => 1
            ];

            if ($this->productModel->addNewProduct($data)) {
                $_SESSION['success'] = "Successfully Added!";
                header("Location: " . ROOT . "/products");
                exit();
            } else {
                $_SESSION['error'] = "Failed to add product!";
                header("Location: " . ROOT . "/products");
                exit();
            }
        }
    }

    //Update product 
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['editProductID'])) {
                $data = [
                    'product_id' => $_POST['editProductID'],
                    'productName' => $_POST['editProductName'],
                    // 'productImage' => $_POST['editImage'],
                    'productDescription' => $_POST['editDescription'],
                    'productStatus' => $_POST['editStatus']
                ];

                if ($this->productModel->updateProduct($_POST['editProductID'], $data)) {
                    $_SESSION['success'] = "Successfully updated!";
                    header("Location: " . ROOT . "/products");
                    exit();
                } else {
                    $_SESSION['error'] = "Failed to update product!";
                    header("Location: " . ROOT . "/products");
                    exit();
                }

            }
        }
    }

    //Delete product
    public function delete()
    {

        if (isset($_POST['deleteProductID'])) {

            if ($this->productModel->DeleteProduct($_POST['deleteProductID'])) {
                $_SESSION['success'] = "Successfully deleted!";
                header("Location: " . ROOT . "/products");
                exit();
            } else {
                $_SESSION['error'] = "Failed to delete product!";
                header("Location: " . ROOT . "/products");
                exit();
            }

        }


    }

    public function restore()
    {

        if (isset($_POST['product_id'])) {

            if ($this->productModel->RestoreProduct($_POST['product_id'])) {
                $_SESSION['success'] = "Successfully deleted!";
                header("Location: " . ROOT . "/products");
                exit();
            }

        }


    }

}