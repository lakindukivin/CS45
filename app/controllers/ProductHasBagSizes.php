<?php

class ProductHasBagSizes
{
    use Controller;
    private $productHasBagSizesModel;
    private $productModel;
    public function __construct()
    {
        $this->productHasBagSizesModel = new ProductHasBagSizesModel();
        $this->productModel = new ProductModel();
    }


    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'product_id' => $_POST['product_id'],
                'bag_id' => $_POST['bag_id'],
                'weight' => $_POST['weight'],
                'price' => $_POST['price']
            ];

            if ($this->productHasBagSizesModel->addSize($data)) {
                $this->productModel->setActive($_POST['product_id']);
                $_SESSION['success'] = "Successfully Added!";
                header("Location: " . ROOT . "/products");
                exit();
            }
        } else {
            $_SESSION['error'] = "Failed to add product!";
            header("Location: " . ROOT . "/products");
            exit();
        }
    }


    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $product_id = $_POST['editProductID'];
            $bag_id = $_POST['editBagID'];
            $weight = $_POST['editWeight'];
            $price = $_POST['editPrice'];


            if ($this->productHasBagSizesModel->updateSize($product_id, $bag_id, $weight, $price)) {
                $_SESSION['success'] = "Successfully Updated!";
                header("Location: " . ROOT . "/products");
                exit();
            }
        } else {
            $_SESSION['error'] = "Failed to update product!";
            header("Location: " . ROOT . "/products");
            exit();
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_id = $_POST['product_id'];
            $bag_id = $_POST['bag_id'];

            if ($this->productHasBagSizesModel->deleteSize($product_id, $bag_id)) {
                $_SESSION['success'] = "Successfully Deleted!";
                header("Location: " . ROOT . "/products");
                exit();
            }
        } else {
            $_SESSION['error'] = "Failed to delete product!";
            header("Location: " . ROOT . "/products");
            exit();
        }
    }

}




?>