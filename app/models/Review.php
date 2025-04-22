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

    public function updateReply($replyId, $replyText) {
        $query = "UPDATE reply 
                  SET reply = :reply, dateModified = NOW() 
                  WHERE reply_id = :reply_id";
        $params = [
            'reply_id' => $replyId,
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
        $query = "SELECT rp.*, r.customer_id, r.order_id, r.comment, r.rating, r.date, r.dateModified,c.name, c.phone, c.address
        FROM reply rp 
        JOIN review r ON rp.review_id = r.review_id
        JOIN customer c ON r.customer_id = c.customer_id";
        return $this->query($query);
    }

    
    
    public function countByDate($date)
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            throw new Exception("Invalid date format. Expected YYYY-MM-DD.");
        }
        $query = "SELECT COUNT(review_id) as count FROM review WHERE DATE(date) = :date";
        $result = $this->query($query, ['date' => $date]);

        // Access the result as an object
        if (isset($result[0]->count)) {
            return $result[0]->count;
        }

        return 0; // Default to 0 if no valid result is found
    }
    
}
