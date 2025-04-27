<?php

/**
 * sales manager home class
 */

class SitePerformance
{
    use Controller;
    public function index()
    {
        // Ensure session is active
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Redirect to login if user is not authenticated
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
        }

        // Check if the user has the right role to access this page
        if ($_SESSION['role_id'] != 1) {
            redirect('login');
        }

        $this->view('admin/sitePerformance');
    }

    public function trafficData()
    {
        header('Content-Type: application/json');
        $model = new SitePerformanceModel();

        $totalVisits = $model->getTotalVisits24h();
        $uniqueVisitors = $model->getUniqueVisitors24h();
        $avgTime = $model->getAverageSessionTime24h();
        $visitsLast7Days = $model->getVisitsLast7Days();

        $labels = [];
        $data = [];
        foreach ($visitsLast7Days as $row) {
            $labels[] = date('D', strtotime($row['day']));
            $data[] = (int) $row['visits'];
        }

        echo json_encode([
            'totalVisits' => $totalVisits,
            'uniqueVisitors' => $uniqueVisitors,
            'avgTime' => $avgTime,
            'trend' => [
                'labels' => $labels,
                'data' => $data
            ]
        ]);
        exit;
    }
}
