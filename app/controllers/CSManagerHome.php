<?php

/**
 * custom service manager home class
 */

class CSManagerHome
{
    use Controller;

    // Add the model method to load models dynamically
    public function model($model)
    {
        $modelPath = "../app/models/" . $model . ".php";
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model();
        } else {
            throw new Exception("Model file not found: " . $model);
        }
    }

    public function index()
    {
        // Get today's date in YYYY-MM-DD format
        $today = date('Y-m-d');

        // Fetch counts for today's date using the models
        $giveaways = $this->model('GiveAwayModel')->countByDate($today);
        $returns = $this->model('ReturnModel')->countByDate($today);
        $orders = $this->model('ManageOrderModel')->countByDate($today);
        $reviews = $this->model('Review')->countByDate($today);

        // Get recent notifications (8 most recent combined from all sources)
        $recentOrders = $this->model('ManageOrderModel')->getRecentOrders(8);
        $recentGiveaways = $this->model('GiveAwayModel')->getRecentGiveaways(8);
        $recentReviews = $this->model('Review')->getRecentReviews(8);
        $recentReturns = $this->model('ReturnModel')->getRecentReturns(8);

        // Combine all notifications
        $allNotifications = [];
        
        // Process orders - update message to show these are pending orders
        foreach($recentOrders as $order) {
            $allNotifications[] = [
                'type' => 'order',
                'id' => $order->order_id,
                'date' => $order->orderDate,
                'timestamp' => strtotime($order->orderDate),
                'message' => "Pending order from {$order->customerName}",
                'status' => $order->orderStatus
            ];
        }
        
        // Process giveaways - update message to show these are pending giveaways
        foreach($recentGiveaways as $giveaway) {
            $allNotifications[] = [
                'type' => 'giveaway',
                'id' => $giveaway->giveaway_id,
                'date' => $giveaway->request_date,
                'timestamp' => strtotime($giveaway->request_date),
                'message' => "Pending giveaway request from {$giveaway->name}",
                'status' => $giveaway->giveawayStatus
            ];
        }
        
        // Process reviews - update message to show these are pending reviews
        foreach($recentReviews as $review) {
            $allNotifications[] = [
                'type' => 'review',
                'id' => $review->review_id,
                'date' => $review->date,
                'timestamp' => strtotime($review->date),
                'message' => "Pending review from {$review->name}",
                'status' => $review->status
            ];
        }
        
        // Process returns - update message to show these are pending returns
        foreach($recentReturns as $return) {
            $allNotifications[] = [
                'type' => 'return',
                'id' => $return->return_id, 
                'date' => $return->date,
                'timestamp' => strtotime($return->date),
                'message' => "Pending return request from {$return->name}",
                'status' => $return->returnStatus
            ];
        }
        
        // Sort by timestamp (most recent first)
        usort($allNotifications, function($a, $b) {
            return $b['timestamp'] - $a['timestamp'];
        });
        
        // Get only the 8 most recent
        $recentNotifications = array_slice($allNotifications, 0, 8);

        // Pass the counts and notifications to the view
        $this->view('customerServiceManager/cSManagerHome', [
            'giveaways' => $giveaways,
            'returns' => $returns,
            'orders' => $orders,
            'reviews' => $reviews,
            'notifications' => $recentNotifications
        ]);
    }

    public function getDayData()
    {
        if (isset($_GET['date']) && !empty($_GET['date'])) {
            $date = $_GET['date'];

            try {
                // Get counts for each type
                $giveawayCount = $this->model('GiveAwayModel')->countByDate($date);
                $returnCount = $this->model('ReturnModel')->countByDate($date);
                $orderCount = $this->model('ManageOrderModel')->countByDate($date);
                $reviewCount = $this->model('Review')->countByDate($date);

                // Return the counts as JSON
                header('Content-Type: application/json');
                echo json_encode([
                    'giveaways' => $giveawayCount,
                    'returns' => $returnCount,
                    'orders' => $orderCount,
                    'reviews' => $reviewCount,
                ]);
                exit;
            } catch (Exception $e) {
                header('Content-Type: application/json');
                echo json_encode(['error' => $e->getMessage()]);
                exit;
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Invalid or missing date parameter.']);
            exit;
        }
    }
}
