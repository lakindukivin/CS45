<?php


class Home extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {

        $model = new Model;
        $arr['customer_name'] = 'Nethmi';
        $arr['customer_address'] = 'danne naha';

        $result = $model->update(1, $arr, 'customer_id');

        show($result);



        $this->view('home');
    }
}
