<?php

class CartModel
{
    use Model;

    protected $table = 'cart';
    protected $allowedColumns = [
        'cart_id',
        'user_id',
        'product_id',
        'quantity',
        'pack_size',
        'bag_size',
        'created_at'
    ];

    public $order_column = 'created_at';
    public $order_type = 'desc';
    protected $limit = 100;

    public function getCartWithProducts($user_id)
    {
        $query = "SELECT c.*, p.name, p.price, p.image_path, 
                 (p.price * c.quantity) as subtotal 
                 FROM $this->table c
                 JOIN products p ON c.product_id = p.product_id
                 WHERE c.user_id = :user_id
                 ORDER BY c.created_at DESC";

        return $this->query($query, ['user_id' => $user_id]);
    }

    public function getCartTotal($user_id)
    {
        $query = "SELECT SUM(p.price * c.quantity) as total 
                 FROM $this->table c
                 JOIN products p ON c.product_id = p.product_id
                 WHERE c.user_id = :user_id";

        $result = $this->query($query, ['user_id' => $user_id]);
        return $result[0]->total ?? 0;
    }

    public function addToCart($data)
    {
        // Check if item already exists
        $existing = $this->first([
            'user_id' => $data['user_id'],
            'product_id' => $data['product_id'],
            'pack_size' => $data['pack_size'],
            'bag_size' => $data['bag_size']
        ]);

        if ($existing) {
            // Update quantity
            return $this->update($existing->cart_id, [
                'quantity' => $existing->quantity + $data['quantity']
            ], 'cart_id');
        }

        // Add new item
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->insert($data);
    }

    public function updateCartItem($cart_id, $user_id, $quantity)
    {
        // Verify item belongs to user
        if (!$this->first(['cart_id' => $cart_id, 'user_id' => $user_id])) {
            throw new Exception("Cart item not found or doesn't belong to user");
        }

        return $this->update($cart_id, ['quantity' => $quantity], 'cart_id');
    }

    public function removeFromCart($cart_id, $user_id)
    {
        // Verify ownership before deletion
        if (!$this->first(['cart_id' => $cart_id, 'user_id' => $user_id])) {
            throw new Exception("Cart item not found or doesn't belong to user");
        }

        return $this->delete($cart_id, 'cart_id');
    }
}
