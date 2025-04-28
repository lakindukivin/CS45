<?php
class Review {
    
    use Model;
    
    protected $table = 'review';
    
    public function getAllPendingReviews() {
        $query = "SELECT r.*, c.name as customerName, c.phone, c.address, p.productName
        FROM review r
        JOIN orders o ON r.order_id = o.order_id 
        JOIN product p ON o.product_id = p.product_id
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
        $query = "SELECT rp.*, r.customer_id, r.order_id, r.comment, r.rating, r.date, r.dateModified,c.name as customerName, p.productName
        FROM reply rp 
        JOIN review r ON rp.review_id = r.review_id
        JOIN orders o ON r.order_id = o.order_id
        JOIN product p ON o.product_id = p.product_id
        JOIN customer c ON r.customer_id = c.customer_id";
        return $this->query($query);
    }

    public function getRecentReviews($limit = 8) {
        // Convert $limit to an integer to prevent SQL injection
        $limit = (int) $limit;
        
        // Modified to get only pending reviews
        $query = "SELECT r.*, c.name
                  FROM review r 
                  JOIN customer c ON r.customer_id = c.customer_id
                  WHERE r.status = 'pending'
                  ORDER BY r.date DESC
                  LIMIT $limit";
                  

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

    public function getPendingReviews()
    {
        $query = "SELECT r.*, c.name FROM review r 
                  JOIN customer c ON r.customer_id = c.customer_id 
                  WHERE r.status = 'pending' 
                  ORDER BY r.date DESC";
        return $this->query($query);
    }

    public function getFilteredPendingReviews($name = null, $date = null) {
        $query = "SELECT r.*, c.name as customerName, c.phone, c.address, p.productName
                FROM review r
                JOIN orders o ON r.order_id = o.order_id 
                JOIN product p ON o.product_id = p.product_id
                JOIN customer c ON r.customer_id = c.customer_id
                WHERE r.status = 'pending'";
                
        $params = [];
        
        if (!empty($name)) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = "%$name%";
        }
        
        if (!empty($date)) {
            $query .= " AND DATE(r.date) = :date";
            $params['date'] = $date;
        }
        
        return $this->query($query, $params);
    }

    public function getFilteredRepliedReviews($name = null, $date = null) {
        $query = "SELECT rp.*, c.name as customerName, c.phone, c.address, p.productName, r.rating, r.comment, r.date, r.dateModified
                  FROM reply rp
                  JOIN review r ON rp.review_id = r.review_id
                  JOIN orders o ON r.order_id = o.order_id
                  JOIN product p ON o.product_id = p.product_id
                  JOIN customer c ON r.customer_id = c.customer_id
                  WHERE r.status = 'replied'";

                  $params = [];

        if (!empty($name)) {
            $query .= " AND c.name LIKE :name";
            $params['name'] = "%$name%";
        }

        if (!empty($date)) {
            $query .= " AND DATE(r.date) = :date";
            $params['date'] = $date;
        }
         
        return $this->query($query, $params);
    }
    
    public function deleteReply($replyId) {
        $query = "DELETE FROM reply WHERE reply_id = :reply_id";
        $params = ['reply_id' => $replyId];
        return $this->query($query, $params);
    }
}
