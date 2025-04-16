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
        $products = $this->productModel->getAllProducts();

        $this->view('salesManager/products', [
            'products' => $products,
        ]);
    }

    //Get single product 
    public function getSingleProduct()
    {

        if (isset($_POST['Product_id'])) {
            $model = new ProductModel();
            $singleProduct = $model->findById($_POST['Product_id']);
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
                // 'productPrice' => $_POST['productPrice'],
                'productDescription' => $_POST['description'],
                'productStatus' => 1
            ];

            if ($this->productModel->addNewProduct($data)) {
                $_SESSION['success'] = "Successfully Added!";
                header("Location: " . ROOT . "/products");
                exit();
            }
        }
    }

    //Update product 
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['Product_id'])) {
                $data = [
                    'Product_id' => $_POST['Product_id'],
                    'productName' => $_POST['productName'],
                    'productImage' => $_POST['img'],
                    'productDescription' => $_POST['description']
                ];

                if ($this->productModel->updateProduct($_POST['Product_id'], $data)) {
                    $_SESSION['success'] = "Successfully updated!";
                    header("Location: " . ROOT . "/products");
                    exit();
                }

            }
        }
    }

    //Delete product
    public function delete()
    {

        if (isset($_POST['Product_id'])) {

            if ($this->productModel->DeleteProduct($_POST['Product_id'])) {
                $_SESSION['success'] = "Successfully deleted!";
                header("Location: " . ROOT . "/products");
                exit();
            }

        }


    }

    public function restore()
    {

        if (isset($_POST['Product_id'])) {

            if ($this->productModel->RestoreProduct($_POST['Product_id'])) {
                $_SESSION['success'] = "Successfully deleted!";
                header("Location: " . ROOT . "/products");
                exit();
            }

        }


    }

}