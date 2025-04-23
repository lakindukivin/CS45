<?php


class EditCustomOrder
{
    use Controller;

    public function index($orderId)
    {

        $order = $this->getOrderById($orderId);

        if ($order) {

            $this->view('customer/editCustomOrder', ['order' => $order]);
        } else {

            echo "Order not found.";
        }
    }

   
    private function getOrderById($orderId)
    {

        return (object)[
            'order_id' => $orderId,
            'company_name' => '',
            'quantity' => null,
            'email' => '',
            'phone' => '',
            'type' => '',
            'specifications' => ''
        ];
    }
}
