<?php
require_once '../models/Product.php';

class ProductController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    // Get All Products controller
    public function fetchProducts()
    {
        try {
            $products = $this->productModel->getAllProducts();

            foreach ($products as &$product) {
                $product['product_img_url'] = "http://localhost/cs45/app/uploads/" . $product['product_img'];
            }
            header('Content-Type: application/json');
            echo json_encode($products);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to fetch products.']);
        }
    }

    // Get a single Product controller
    public function viewProductDetails()
    {
        $product_id = $_GET['product_id'] ?? null;

        if (!$product_id) {
            http_response_code(400);
            echo json_encode(['error' => 'Product ID not provided']);
            return;
        }

        $product = $this->productModel->getProductById($product_id);

        if ($product) {
            $product['product_img_url'] = "http://localhost/cs45/app/uploads/" . $product['product_img'];
            echo json_encode($product);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Product not found']);
        }
    }


    // Add product controller
    public function addProduct()
    {
        try {
            $targetDir = "../uploads/";
            $imageName = "default.png"; // Default image name

            // Check if an image file is uploaded
            if (!empty($_FILES['img']['name'])) {
                $imageName = basename($_FILES['img']['name']);
                $targetFile = $targetDir . $imageName;

                // Move uploaded file
                if (!move_uploaded_file($_FILES['img']['tmp_name'], $targetFile)) {
                    throw new Exception("Failed to upload image");
                }
            }

            $data = [
                'productName' => $_POST['productName'],
                'productImg' => $imageName,
                'productPrice' => $_POST['productPrice'],
                'description' => $_POST['description'],
                'packSize' => $_POST['packSize'],
                'bagSize' => $_POST['bagSize']
            ];

            if ($this->productModel->addProduct($data)) {
                echo json_encode(['success' => true, 'message' => 'Product added successfully']);
                // header("Location : products.html")
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add product']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'An error occurred while adding the product.']);
        }
    }

    // Edit product controller
    public function editProduct()
    {
        try {
            $targetDir = "../uploads/";
            $imageName = $_POST['existing_image']; // Default to existing image

            // Check if a new image file is uploaded
            if (!empty($_FILES['product_image']['name'])) {
                $imageName = basename($_FILES['product_image']['name']);
                $targetFile = $targetDir . $imageName;

                // Move uploaded file
                if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile)) {
                    throw new Exception("Failed to upload image");
                }
            }

            $data = [
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_img' => $imageName,
                'product_price' => $_POST['product_price'],
                'description' => $_POST['description'],
                'pack_size' => $_POST['pack_size'],
                'bag_size' => $_POST['bag_size']
             ];

            if ($this->productModel->updateProduct($data)) {
                echo json_encode(['success' => true, 'message' => 'Product added successfully']);

            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add product']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'An error occurred while updating the product.']);
        }
    }

    // Delete product controller
    public function deleteProduct()
    {
        try {
            $id = $_POST['product_id'];

            if ($this->productModel->deleteProduct($id)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete product']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'An error occurred while deleting the product.']);
        }
    }

}

// Request handler
// Get the request's action
$action = $_GET['action'] ?? null;

// Instantiate the relevant controller
$controller = new ProductController();

// Route the request based on the action
if ($action) {
    switch ($action) {
        case 'fetch':
            $controller->fetchProducts();
            break;
        case 'add':
            $controller->addProduct();
            break;
        case 'delete':
            $controller->deleteProduct();
            break;
        case 'edit':
            $controller->editProduct();
            break;
        case 'view':
            $controller->viewProductDetails();
            break;
        default:
            http_response_code(404);
            echo json_encode(['error' => 'Action not found']);
            break;
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'No action specified']);
}
?>