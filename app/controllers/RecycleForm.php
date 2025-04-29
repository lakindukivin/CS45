<?php

class RecycleForm
{
    use Controller;

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'request_date' => trim($_POST['request_date']),
                'details' => trim($_POST['details']),
                'errors' => [],
                'success' => false
            ];

            // Validation
            if (empty($data['request_date']) || strtotime($data['request_date']) < strtotime('today')) {
                $data['errors']['request_date'] = 'Please select a valid future date';
            }

            if (empty($data['details']) || strlen($data['details']) < 10) {
                $data['errors']['details'] = 'Please provide more details (at least 10 characters)';
            }

            if (empty($data['errors'])) {
                $giveawayModel = new RecycleFormModel();

                try {
                    if ($giveawayModel->createRequest($data)) {
                        $data['success'] = true;
                        $data['success_message'] = 'Your giveaway request has been submitted successfully!';
                    }
                } catch (Exception $e) {
                    $data['errors']['submit'] = $e->getMessage();

                    if (strpos($e->getMessage(), 'complete your customer profile') !== false) {
                        $data['errors']['profile_link'] = ROOT . '/profile';
                    }
                }
            }

            $this->view('customer/recycleForm', $data);
        } else {
            // GET request: just show empty form
            $this->view('customer/recycleForm');
        }
    }
}
