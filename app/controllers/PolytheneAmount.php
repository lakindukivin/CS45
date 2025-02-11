<?php
class PolytheneAmount {
    use Controller;
    private $polytheneModel;

    public function __construct() {
        $this->polytheneModel = new PolytheneAmountViewModel();
    }

    public function index() {
        $data['amounts'] = $this->polytheneModel->getAllAmounts();
        $this->view('productionManager/polythene_amount', $data);
    }
}
