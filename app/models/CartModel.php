<?php

class CartModel
{
    use Model;

    protected $table = 'cart';
    protected $allowedColumns = [
        'cart_id',
        'customer_id',
        'product_id',
        'quantity',
        'pack_size',
        'bag_size',
        'created_at'
    ];

    protected $limit = 100;

    public function __construct()
    {
        $this->order_column = 'created_at';
        $this->order_type = 'desc';
    }

    public function getCartWithProducts($customer_id)
    {
        $query = "SELECT c.*, p.productName, pb.price, p.productImage, b.bag_size,
                  (pb.price * c.quantity) AS subtotal 
                  FROM {$this->table} c
                  JOIN product p ON c.product_id = p.product_id
                  JOIN product_has_bag_sizes pb ON c.product_id = pb.product_id AND c.bag_id = pb.bag_id
                  JOIN bag_size b ON c.bag_id = b.bag_id
                  WHERE c.customer_id = :customer_id
                  ORDER BY c.created_at DESC";

        return $this->query($query, ['customer_id' => $customer_id]);
    }



    public function getCartTotal($customer_id)
    {
        $query = "SELECT SUM(p.price * c.quantity) AS total 
                 FROM {$this->table} c
                 JOIN products p ON c.product_id = p.product_id
                 WHERE c.customer_id = :customer_id";

        $result = $this->query($query, ['customer_id' => $customer_id]);
        return $result[0]->total ?? 0;
    }

    public function addToCart($data)
    {
        $existing = $this->first([
            'customer_id' => $data['customer_id'],
            'product_id' => $data['product_id'],
            'pack_size' => $data['pack_size'],
            'bag_size' => $data['bag_size']
        ]);

        if ($existing) {
            $newQuantity = $existing->quantity + $data['quantity'];
            $this->update($existing->cart_id, ['quantity' => $newQuantity], 'cart_id');
            return true;
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->insert($data);
    }

    public function updateCartItem($cart_id, $customer_id, $quantity)
    {
        $item = $this->first([
            'cart_id' => $cart_id,
            'customer_id' => $customer_id
        ]);

        if (!$item) {
            throw new Exception("Cart item not found or doesn't belong to customer.");
        }

        return $this->update($cart_id, ['quantity' => $quantity], 'cart_id');
    }

    public function removeFromCart($cart_id, $customer_id)
    {
        $item = $this->first([
            'cart_id' => $cart_id,
            'customer_id' => $customer_id
        ]);

        if (!$item) {
            throw new Exception("Cart item not found or doesn't belong to customer.");
        }

        return $this->delete($cart_id, 'cart_id');
    }
}
