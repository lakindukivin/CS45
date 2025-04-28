<?php

class SupplyRequestModel{
    use Model; 
    protected $table = 'stock';
    protected $allowedColumns = [
        'stock_id',
        'product_id',
        'pack_id',
        'bag_id',
        'total',
        'status'
        ];
    protected $primaryKey = 'stock_id';

    public function getLowStockItems() {
        return $this->query("
            SELECT s.product_id, s.pack_id, s.bag_id, p.productName, ps.pack_size, bs.bag_size
            FROM stock s JOIN product p ON s.product_id = p.product_id
            JOIN pack_size ps ON s.pack_id = ps.pack_id
            JOIN bag_size bs ON s.bag_id = bs.bag_id
            WHERE s.status = 'Low Stock'
            ORDER BY s.total ASC
        ");
    }

    public function addToStock($productId, $packId, $bagId, $quantityToAdd) {
        // First get the current stock record
        $currentStock = $this->first([
            'product_id' => $productId,
            'pack_id' => $packId,
            'bag_id' => $bagId
        ]);
        
        if ($currentStock) {
            // Calculate new total
            $newTotal = $currentStock->total + (int)$quantityToAdd;
            
            // Determine new status
            $newStatus = ($newTotal > 10) ? 'In Stock' : 'Low Stock';
            
            // Update the record
            return $this->update($currentStock->stock_id, [
                'total' => $newTotal,
                'status' => $newStatus
            ],'stock_id');
        }
        
        return false;
    }
    
}
