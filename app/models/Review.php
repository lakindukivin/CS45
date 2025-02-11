<?php
class Review {
    use Model;
    
    protected $table = 'review';

    public function getAllPendingReviews() {
        $sql = "SELECT r.review_id, r.rating, r.date, 
                c.customer_id, o.order_id 
                FROM review r 
                JOIN customer c ON r.customer_id = c.customer_id 
                JOIN orders o ON r.order_id = o.order_id 
                LEFT JOIN reply rr ON r.review_id = rr.review_id 
                WHERE rr.reply_id IS NULL 
                ORDER BY r.date DESC";
        return $this->query($sql);
    }

    public function getRepliedReviews() {
        $sql = "SELECT r.review_id, r.rating, r.date, 
                c.customer_id, o.order_id, rr.reply 
                FROM review r 
                JOIN customer c ON r.customer_id = c.customer_id 
                JOIN orders o ON r.order_id = o.order_id 
                JOIN reply rr ON r.review_id = rr.review_id 
                ORDER BY r.date DESC";
        return $this->query($sql);
    }

    public function addReply($data) {
        $sql = "INSERT INTO reply (review_id, reply, date) 
                VALUES (:review_id, :reply, NOW())";
        return $this->query($sql, [
            'review_id' => $data['review_id'],
            'reply' => $data['reply']
        ]);
    }

    public function updateReply($data) {
        $sql = "UPDATE reply 
                SET reply = :reply 
                WHERE reply_id = :reply_id";
        return $this->query($sql, [
            'reply' => $data['reply'],
            'reply_id' => $data['reply_id']
        ]);
    }

    public function deleteReply($reply_id) {
        $sql = "DELETE FROM reply 
                WHERE reply_id = :reply_id";
        return $this->query($sql, ['reply_id' => $reply_id]);
    }
}