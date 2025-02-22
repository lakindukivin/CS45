<?php
class Review {
    
    use Model;
    
    protected $table = 'review';
    protected $allowedColumns = ['Review_id', 'Rating', 'Comment', 'customer_id', 'order_id', 'Date'];

    public function getAllPendingReviews() {
        return $this->query(
            "SELECT r.*, c.name AS customer_name, o.order_id 
            FROM $this->table r 
            JOIN customer c ON r.customer_id = c.customer_id 
            JOIN orders o ON r.order_id = o.order_id 
            LEFT JOIN reply rp ON r.Review_id = rp.Review_id 
            WHERE rp.reply_id IS NULL 
            ORDER BY r.Date DESC"
        );
    }

    public function getReview($Review_id) {
        return $this->first(['Review_id' => $Review_id]);
    }

    public function getReviewDetails($Review_id) {
        $sql = "SELECT r.review_id, r.rating, r.comment, r.date,
                c.customer_id, c.name as customer_name,
                o.order_id
                FROM review r
                JOIN customer c ON r.customer_id = c.customer_id
                JOIN orders o ON r.order_id = o.order_id
                WHERE r.review_id = :id";
                
        $result = $this->query($sql, ['id' => $Review_id]);
        return $result[0] ?? false;
    }
    
    

    public function getRepliedReviews() {
        return $this->query(
            "SELECT r.*, c.name AS customer_name, o.order_id, rp.reply, rp.date AS reply_date
            FROM $this->table r 
            JOIN customer c ON r.customer_id = c.customer_id 
            JOIN orders o ON r.order_id = o.order_id 
            JOIN reply rp ON r.Review_id = rp.Review_id 
            ORDER BY r.$this->order_column $this->order_type"
        );
    }

    public function addReply($data) {
        $sql = "INSERT INTO reply (Review_id, reply, date) VALUES (:Review_id, :reply, NOW())";
        return $this->query($sql, [
            'Review_id' => $data['Review_id'],
            'reply' => $data['reply']
        ]);
    }

    public function editReply($data) {
        $query = "UPDATE reply SET reply = :reply WHERE reply_id = :reply_id";
        return $this->query($query, [
            'reply' => $data['reply'],
            'reply_id' => $data['reply_id']
        ]);
    }

    public function removeReply($reply_id) {
        $query = "DELETE FROM reply WHERE reply_id = :reply_id";
        return $this->query($query, ['reply_id' => $reply_id]);
    }
}
