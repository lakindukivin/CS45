<?php
/**
 * sales manager home class
 */
class Products
{
    use Controller;

    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    // Send data to view page
    public function index()
    {
        $products = $this->productModel->getAllProducts();
        $this->view('salesManager/products', ['products' => $products]);
    }

    // Get single product 
    public function getSingleProduct()
    {
        if (isset($_POST['product_id'])) {
            $singleProduct = $this->productModel->findById($_POST['product_id']);
            echo json_encode(['success' => true, 'data' => $singleProduct]);
            exit;
        }
        echo json_encode(['success' => false, 'message' => 'Product ID not provided']);
        exit;
    }

    // Add product
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'productName' => $_POST['productName'],
                'productPrice' => $_POST['productPrice'],
                'productDescription' => $_POST['description'],
                'productStatus' => 1 // Assuming 1 means active
            ];
            
            // Handle file upload
            if (isset($_FILES['img'])) {
                $uploadDir = 'assets/uploads/products/';
                $uploadPath = $uploadDir . basename($_FILES['img']['name']);
                
                if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadPath)) {
                    $data['productImage'] = '/' . $uploadPath;
                } else {
                    echo json_encode(['success' => false, 'message' => 'File upload failed']);
                    exit;
                }
            }
            
            $result = $this->productModel->insert($data);
            
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add product']);
            }
            exit;
        }
    }

    // Update product 
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $data = [
                'productName' => $_POST['product_name'],
                'productPrice' => $_POST['product_price'],
                'productDescription' => $_POST['description']
            ];
            
            // Handle file upload if a new image was provided
            if (isset($_FILES['product_image']) && $_FILES['product_image']['size'] > 0) {
                $uploadDir = 'assets/uploads/products/';
                $uploadPath = $uploadDir . basename($_FILES['product_image']['name']);
                
                if (move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadPath)) {
                    $data['productImage'] = '/' . $uploadPath;
                } else {
                    echo json_encode(['success' => false, 'message' => 'File upload failed']);
                    exit;
                }
            } elseif (isset($_POST['existing_image'])) {
                $data['productImage'] = $_POST['existing_image'];
            }
            
            $result = $this->productModel->update($_POST['product_id'], $data, 'product_id');
            
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update product']);
            }
            exit;
        }
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
        exit;
    }

    // Delete product
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $result = $this->productModel->DeleteProduct($_POST['product_id']);
            
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete product']);
            }
            exit;
        }
        echo json_encode(['success' => false, 'message' => 'Product ID not provided']);
        exit;
    }
}