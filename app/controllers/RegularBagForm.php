<?php

class RegularBagForm
{
    use Controller;

    public function index()
    {
        $product_id = 1; 

        $model = new RegularBagModel();
        $data = $model->getProductDetails($product_id);

        if (!$data) {
            $this->view('404');
            return;
        }


        $this->view('customer/regularBagForm', $data);
    }
}
