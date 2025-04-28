<?php

class RegularBagModel
{
    use Model;

    protected $table = 'product';
    protected $allowedColumns = ['product_id', 'productName', 'productDescription'];

    public function getProductDetails($product_id)
    {
        // Fetch the product
        $query = "SELECT * FROM {$this->table} WHERE product_id = :product_id AND productStatus = 1 LIMIT 1";
        $product = $this->query($query, ['product_id' => $product_id]);

        if (!$product) return false;

        // Fetch available pack sizes
        $query = "SELECT * FROM pack_size ORDER BY pack_id";
        $packs = $this->query($query);

        // Fetch bag sizes, weight, and prices for this product
        $query = "SELECT bs.bag_id, bs.bag_size, phb.weight, phb.price
                  FROM product_has_bag_sizes phb
                  JOIN bag_size bs ON phb.bag_id = bs.bag_id
                  WHERE phb.product_id = :product_id
                  ORDER BY bs.bag_id";
        $bag_sizes = $this->query($query, ['product_id' => $product_id]);

        return [
            'product' => $product[0],
            'packs' => $packs,
            'bag_sizes' => $bag_sizes
        ];
    }
}
