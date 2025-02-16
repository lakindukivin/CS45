<?php

class Product {
    use Controller;

    public function index() {
        $this->view('products/product');
    }
  }