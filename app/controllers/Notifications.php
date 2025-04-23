<?php

trait Controller
{
    // Other methods

    public function loadModel($model)
    {
        $modelPath = '../app/models/' . $model . '.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model();
        }
        throw new Exception("Model $model not found.");
    }
}

class Notifications 
{
    use Controller;
    
    private $giveawayModel;
    private $returnModel;
    private $orderModel;
    private $reviewModel;

    public function __construct()
    {
        // Initialize models
        $this->giveawayModel = $this->loadModel('GiveawayModel');
        $this->returnModel = $this->loadModel('ReturnModel');
        $this->orderModel = $this->loadModel('ManageOrderModel');
        $this->reviewModel = $this->loadModel('Review');
    }

    public function index()
    {
        // Restrict access to Customer Service Manager only
        if (!isset($_SESSION['USER']) || $_SESSION['USER']->role_id != 4) {
            redirect('login');
        }

        $this->view('customerServiceManager/notifications');
    }

    public function getNotifications()
    {
        // Restrict access to Customer Service Manager only
        if (!isset($_SESSION['USER']) || $_SESSION['USER']->role_id != 4) {
            echo json_encode(['error' => 'Unauthorized access']);
            return;
        }

        $notifications = [];

        // Get pending giveaway requests
        $giveawayRequests = $this->giveawayModel->getPendingGiveaways();
        foreach ($giveawayRequests as $request) {
            $notifications[] = [
                'id' => 'giveaway_' . $request->giveaway_id,
                'type' => 'giveaway',
                'message' => "New giveaway request from {$request->name}",
                'details' => "Request details: {$request->details}",
                'date' => $request->request_date,
                'url' => ROOT . '/GiveAwayRequest/view/' . $request->giveaway_id
            ];
        }

        // Get pending return requests
        $returnRequests = $this->returnModel->getPendingReturns();
        foreach ($returnRequests as $request) {
            $notifications[] = [
                'id' => 'return_' . $request->return_id,
                'type' => 'return',
                'message' => "New return request for Order #{$request->order_id}",
                'details' => "Reason: {$request->returnDetails}, Customer wants: {$request->cus_requirements}",
                'date' => $request->date,
                'url' => ROOT . '/Returns/view/' . $request->return_id
            ];
        }

        // Get pending orders
        $pendingOrders = $this->orderModel->getPendingOrders();
        foreach ($pendingOrders as $order) {
            $notifications[] = [
                'id' => 'order_' . $order->order_id,
                'type' => 'order',
                'message' => "New order #{$order->order_id} from {$order->name}",
                'details' => "Product: {$order->productName}, Quantity: {$order->quantity}",
                'date' => $order->orderDate,
                'url' => ROOT . '/ManageOrders/view/' . $order->order_id
            ];
        }

        // Get pending reviews
        $pendingReviews = $this->reviewModel->getPendingReviews();
        foreach ($pendingReviews as $review) {
            $notifications[] = [
                'id' => 'review_' . $review->review_id,
                'type' => 'review',
                'message' => "New review from {$review->name}",
                'details' => "Rating: {$review->rating}/5, Comment: {$review->comment}",
                'date' => $review->date,
                'url' => ROOT . '/ManageReviews/view/' . $review->review_id
            ];
        }

        // Sort notifications by date (newest first)
        usort($notifications, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        echo json_encode($notifications);
    }
}