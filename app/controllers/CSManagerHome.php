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

        // Pass the counts to the view
        $this->view('customerServiceManager/cSManagerHome', [
            'giveaways' => $giveaways,
            'returns' => $returns,
            'orders' => $orders,
            'reviews' => $reviews,
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
