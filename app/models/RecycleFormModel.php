<?php

class RecycleFormModel
{
    use Model;

    protected $table = 'giveawayrequests';

    protected $allowedColumns = [
        'customer_id',
        'request_date',
        'giveawayStatus',
        'details'
    ];

    protected $defaultStatus = 'pending';

    public function createRequest($data)
    {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception('You must be logged in to submit a giveaway request');
        }

        $customerModel = new Customer();
        $customer = $customerModel->getCustomerByUserId($_SESSION['user_id']);

        if (!$customer) {
            throw new Exception('Customer profile not found. Please complete your customer profile first.');
        }

        $data['customer_id'] = $customer->customer_id;

        if (!isset($data['giveawayStatus'])) {
            $data['giveawayStatus'] = $this->defaultStatus;
        }

        return $this->insert($data);
    }
}
