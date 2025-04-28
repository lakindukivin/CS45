<?php

class OxoBagForm
{
    use Controller;

    public function index()
    {
        $product_id = 2;

        $model = new OxoBiodegradableBagModel();
        $data = $model->getProductDetails($product_id);

        if (!$data) {
            $this->view('404');
            return;
        }


        $this->view('customer/oxoBagForm', $data);
    }
}
