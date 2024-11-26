<?php


class Home extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {

        $model = new Model;
        $arr['customer_name'] = "sajani";
        $arr['customer_contact'] = "123456123";
        $arr['customer_address'] = "abcdefgh";

        $result = $model->insert($arr);

        //show($result);



        $this->view('home');
    }
}
