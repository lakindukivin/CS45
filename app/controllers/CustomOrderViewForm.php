<?php

class CustomOrderList
{
    use Controller;

    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            // Initialize the CustomerModel to fetch customer_id using user_id
            $customerModel = new Customer();

            // Fetch the customer record based on user_id
            $customer = $customerModel->first(['user_id' => $user_id]);

            if ($customer) {
                // Get the customer_id from the customer record
                $customer_id = $customer->customer_id;

                // Now initialize the CustomOrderListModel to fetch the custom orders for the customer
                $customOrderModel = new CustomOrderListModel();

                // Fetch custom orders for the customer using the customer_id
                $customOrders = $customOrderModel->where(
                    ['customer_id' => $customer_id], // Use customer_id to filter orders
                    [],
                    'customOrder_id', // Or use your table's primary key if different
                    'asc'
                );

                // Pass the custom orders to the view
                $this->view('customer/customOrderList', ['customOrders' => $customOrders]);
            } else {
                // Handle error if no customer found
                echo "Customer not found.";
            }
        } else {
            // Redirect to login if not logged in
            header('Location: ' . ROOT . '/login');
            exit();
        }
    }

    public function editOrder($order_id)
    {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            // Initialize the CustomerModel to fetch customer_id using user_id
            $customerModel = new Customer();

            // Fetch the customer record based on user_id
            $customer = $customerModel->first(['user_id' => $user_id]);

            if ($customer) {
                // Get the customer_id from the customer record
                $customer_id = $customer->customer_id;

                // Initialize the CustomOrderListModel to fetch the custom order details
                $customOrderModel = new CustomOrderListModel();

                // Fetch the order details based on order_id and customer_id
                $order = $customOrderModel->first(['customOrder_id' => $order_id, 'customer_id' => $customer_id]);

                if ($order) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        // Handle form submission to update the order
                        $data = [
                            'company_name' => $_POST['company_name'],
                            'quantity' => $_POST['quantity'],
                            'email' => $_POST['email'],
                            'phone' => $_POST['phone'],
                            'type' => $_POST['type'],
                            'specifications' => $_POST['specifications']
                        ];

                        // Update the order in the database
                        $updateSuccess = $customOrderModel->update($order_id, $data, 'customOrder_id');

                        if ($updateSuccess) {
                            // Redirect to the custom order list after update
                            header('Location: ' . ROOT . '/customOrderList');
                            exit();
                        }
                    }

                    // Show the edit order view with the current order details
                    $this->view('customer/editOrder', ['order' => $order]);
                } else {
                    // If order not found, show error
                    echo "Order not found.";
                }
            } else {
                // Handle error if no customer found
                echo "Customer not found.";
            }
        } else {
            // Redirect to login if not logged in
            header('Location: ' . ROOT . '/login');
            exit();
        }
    }
}
