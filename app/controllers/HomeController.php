<?php

require_once '../core/controller.php';

class HomeController extends Controller {
    public function index() {
        $data = ['title' => 'Welcome to My Framework'];
        $this->render('home/index.php', $data);
    }
}
