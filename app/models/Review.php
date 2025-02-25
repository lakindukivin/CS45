<?php
class Review {
    
    use Model;
    
    protected $table = 'review';
    protected $allowedColumns = ['review_id', 'rating', 'comment', 'customer_id', 'order_id', 'date'];
    
    // Define ordering properties to avoid undefined variable errors
    

    public function getAllPendingReviews() {
        return $this->query(
            "SELECT r.*, c.name AS customer_name, o.order_id 
            FROM $this->table r 
            JOIN customer c ON r.customer_id = c.customer_id 
            JOIN orders o ON r.order_id = o.order_id 
            LEFT JOIN reply rp ON r.review_id = rp.review_id 
            WHERE rp.reply_id IS NULL 
            ORDER BY r.date DESC"
        );
    }

    public function getReview($review_id) {
        return $this->first(['review_id' => $review_id]);
    }

    public function getReviewDetails($review_id) {
        $sql = "SELECT r.review_id, r.rating, r.comment, r.date,
                c.customer_id, c.name as customer_name,
                o.order_id
                FROM review r
                JOIN customer c ON r.customer_id = c.customer_id
                JOIN orders o ON r.order_id = o.order_id
                WHERE r.review_id = :review_id";
                
        $result = $this->query($sql, ['review_id' => $review_id]);
        return $result[0] ?? false;
    }
    

    public function getRepliedReviews() {
        return $this->query(
            "SELECT r.*, c.name AS customer_name, o.order_id, rp.reply, rp.date AS reply_Date
            FROM $this->table r 
            JOIN customer c ON r.customer_id = c.customer_id 
            JOIN orders o ON r.order_id = o.order_id 
            JOIN reply rp ON r.review_id = rp.review_id 
            ORDER BY r.$this->order_column $this->order_type"
        );
    }

    public function addReply($data) {
        $sql = "INSERT INTO reply (review_id, reply, date) VALUES (:review_id, :reply, NOW())";
        return $this->query($sql, [
            'review_id' => $data['review_id'],
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
