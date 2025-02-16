<?php

class RecycledPolythene {

    use Controller;
    private $polytheneModel;

    public function __construct() {
        $this->polytheneModel = new PolytheneAmount();
    }

    public function index() {
        $data['success'] = isset($_SESSION['success']) ? $_SESSION['success'] : '';
        unset($_SESSION['success']);
        $this->view('productionManager/recycled_polythene', $data);
    }

    public function updateAmount() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'amount' => $_POST['amount'],
                'message' => $_POST['message'],
                'month' => $_POST['month']
            ];

            if($this->polytheneModel->updateAmount($data)) {
                $_SESSION['success'] = "Successfully updated!";
                header("Location: " . ROOT . "/RecycledPolythene");
                exit();
            }
        }
    }
}
