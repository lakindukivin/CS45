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
        // Get all products for the add discount form
        $products = new ProductModel();
        // $allProducts = $products->findAll();

        // Get all discounts with product information
        $discounts = $this->discountModel->getDiscountWithProduct();

        $this->view('salesManager/discounts', [
            'discounts' => $discounts,
            // 'products' => $allProducts
        ]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'Product_id' => $_POST['Product_id'],
                'discount_percentage' => $_POST['discount_percentage'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date']
            ];

            if ($this->discountModel->addDiscount($data)) {
                redirect('discounts');
            }
        }
        redirect('discounts');
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'discount_percentage' => $_POST['discount_percentage'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date']
            ];

            if ($this->discountModel->editDiscount($_POST['Discount_id'], $data)) {
                redirect('discounts');
            }
        }
        redirect('discounts');
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->discountModel->deleteDiscount($_POST['Discount_id'])) {
                redirect('discounts');
            }
        }
        redirect('discounts');
    }
}
