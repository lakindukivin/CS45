<?php
class Review {
    
    use Model;
    
    protected $table = 'review';
    
    public function getAllPendingReviews() {
        $query = "SELECT r.*, r.customer_id, r.order_id, r.comment, r.rating, r.date, r.dateModified,c.name, c.phone, c.address
        FROM review r 
        JOIN customer c ON r.customer_id = c.customer_id
        WHERE r.status = 'pending'";
        return $this->query($query);
    }

    public function addReply($reviewId, $replyText) {
        $query = "INSERT INTO reply (review_id, reply, date, dateModified) 
              VALUES (:review_id, :reply, NOW(), NOW())";
        $params = [
        'review_id' => $reviewId,
        'reply' => $replyText
        ];
        return $this->query($query, $params);
    }

    public function updateReply($reviewId, $replyText) {
        $query = "UPDATE reply 
                  SET reply = :reply, dateModified = NOW() 
                  WHERE review_id = :review_id";
        $params = [
            'review_id' => $reviewId,
            'reply' => $replyText
        ];
        return $this->query($query, $params);
    }

    public function updateReviewStatus($reviewId, $status) {
        $query = "UPDATE review 
                  SET status = :status, dateModified = NOW() 
                  WHERE review_id = :review_id";
        $params = [
            'review_id' => $reviewId,
            'status' => $status
        ];
        return $this->query($query, $params);
    }

    public function getAllCompletedReviews() {
        $query = "SELECT r.*, r.customer_id, r.order_id, r.comment, r.rating, r.date, r.dateModified,c.name, c.phone, c.address
        FROM review r 
        JOIN customer c ON r.customer_id = c.customer_id
        WHERE r.status = 'replied'";
        return $this->query($query);
    }
    
}
