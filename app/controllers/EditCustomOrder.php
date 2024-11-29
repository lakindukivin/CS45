<?php

/**
 * Edit Order class
 */

class EditCustomOrder
{
    use Controller;

    public function index($orderId)
    {

        $order = $this->getOrderById($orderId);

        // Check if the order exists
        if ($order) {

            $this->view('customer/editCustomOrder', ['order' => $order]);
        } else {

            echo "Order not found.";
        }
    }

    // Method to fetch the order from the database
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
