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
        $allProducts = $products->getAllProducts();

        // Get all discounts with product information
        $discounts = $this->discountModel->getDiscountWithProduct();

        $this->view('salesManager/discounts', [
            'discounts' => $discounts,
            'products' => $allProducts
        ]);
    }

    public function getSingleDiscount()
    {

        if (isset($_POST['ad_id'])) {
            $model = new DiscountModel();
            $singleDiscount = $model->findById($_POST['Discount_id']);
            echo json_encode($singleDiscount);
            exit;
        }

    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            
            $data = [
                'product_id' => $_POST['Product_id'],
                'discount_percentage' => $_POST['discount_percentage'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'product_id_err' => '',
                'discount_percentage_err' => '',
                'start_date_err' => '',
                'end_date_err' => ''
            ];

            // Validate data
            if (empty($data['product_id'])) {
                $data['product_id_err'] = 'Please select a product';
            } else {
                // Check if the product exists in the database
                $productModel = new ProductModel();
                if (!$productModel->findById($data['product_id'])) {
                    $data['product_id_err'] = 'Selected product does not exist';
                } else {
                    // Check for overlapping discount dates for this product
                    $existingDiscounts = $this->discountModel->findById($data['product_id']);

                    if (!empty($existingDiscounts)) {
                        foreach ($existingDiscounts as $discount) {
                            // Check if date ranges overlap
                            $newStartDate = strtotime($data['start_date']);
                            $newEndDate = strtotime($data['end_date']);
                            $existingStartDate = strtotime($discount->start_date);
                            $existingEndDate = strtotime($discount->end_date);

                            if (
                                    // New start date falls within existing range
                                ($newStartDate >= $existingStartDate && $newStartDate <= $existingEndDate) ||
                                    // New end date falls within existing range
                                ($newEndDate >= $existingStartDate && $newEndDate <= $existingEndDate) ||
                                    // Existing range falls completely within new range
                                ($existingStartDate >= $newStartDate && $existingEndDate <= $newEndDate)
                            ) {
                                $data['start_date_err'] = 'Discount dates overlap with an existing discount for this product';
                                $data['end_date_err'] = 'Discount dates overlap with an existing discount for this product';
                                break;
                            }
                        }
                    }
                }
            }


            if (empty($data['discount_percentage']) || $data['discount_percentage'] < 0 || $data['discount_percentage'] > 1) {
                $data['discount_percentage_err'] = 'Please enter a valid discount percentage between 0 and 1';
            }

            if (empty($data['start_date'])) {
                $data['start_date_err'] = 'Please select a start date';
            }

            if (empty($data['end_date'])) {
                $data['end_date_err'] = 'Please select an end date';
            }
            // Compare dates
            if (!empty($data['start_date']) && !empty($data['end_date'])) {
                if (strtotime($data['start_date']) > strtotime($data['end_date'])) {
                    $data['end_date_err'] = 'End date must be after start date';
                }
            }

            // Create errors array to check if there are any errors
            $errors = [];
            if (!empty($data['product_id_err']))
                $errors[] = $data['product_id_err'];
            if (!empty($data['discount_percentage_err']))
                $errors[] = $data['discount_percentage_err'];
            if (!empty($data['start_date_err']))
                $errors[] = $data['start_date_err'];
            if (!empty($data['end_date_err']))
                $errors[] = $data['end_date_err'];

            // Make sure there are no errors
            if (empty($errors)) {
                // Remove the error fields before insertion
                unset($data['product_id_err']);
                unset($data['discount_percentage_err']);
                unset($data['start_date_err']);
                unset($data['end_date_err']);

                // Call the addDiscount method from your model
                if ($this->discountModel->addDiscount($data)) {
                    $_SESSION['success_msg'] = 'Discount added successfully';
                    redirect('discounts');
                } else {
                    $_SESSION['error_msg'] = 'Something went wrong adding the discount';
                    redirect('discounts');
                }
            } else {
                // Set error message
                $_SESSION['error_msg'] = implode('<br>', $errors);
                redirect('discounts');
            }

            // if ($this->discountModel->addDiscount($data)) {
            //     redirect('discounts');
            // }

            echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        die();
        }
        redirect('discounts');
    }

    // public function edit()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $data = [
    //             'discount_percentage' => $_POST['discount_percentage'],
    //             'start_date' => $_POST['start_date'],
    //             'end_date' => $_POST['end_date']
    //         ];

    //         if ($this->discountModel->editDiscount($_POST['discount_id'], $data)) {
    //             redirect('discounts');
    //         }
    //     }
    //     redirect('discounts');
    // }

    // public function delete()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         if ($this->discountModel->deleteDiscount($_POST['discount_id'])) {
    //             redirect('discounts');
    //         }
    //     }
    //     redirect('discounts');
    // }
}
