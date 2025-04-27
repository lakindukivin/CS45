<?php

class SupplyRequestModel{
    use Model; 
    protected $table = 'stock';
    protected $allowedColumns = [
        'product_id',
        'pack_id',
        'bag_id',
        'total',
        'status'
        ];
    protected $primaryKey = 'stock_id';

    public function getLowStockItems() {
        return $this->query("
            SELECT s.product_id, p.productName, ps.pack_size, bs.bag_size
            FROM stock s JOIN product p ON s.product_id = p.product_id
            JOIN pack_size ps ON s.pack_id = ps.pack_id
            JOIN bag_size bs ON s.bag_id = bs.bag_id
            WHERE s.status = 'Low Stock'
            ORDER BY s.total ASC
        ");
    }
    
}
