<?php

/**
 * sales manager home class
 */

class SitePerformance
{
    use Controller;

    private $issuesModel;

    public function __construct()
    {
        $this->issuesModel = new IssuesModel(); // Need to create or use existing issues model
    }
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

        $recentIssues = $this->issuesModel->getRecentIssues(8);

        // Process issues into notification format
        $notifications = [];
        if (!empty($recentIssues)) {
            foreach ($recentIssues as $issue) {
                $notifications[] = [
                    'type' => 'issue',
                    'id' => $issue->issue_id,
                    'timestamp' => strtotime($issue->created_at ?? date('Y-m-d H:i:s')),
                    'message' => "New issue reported: " . substr($issue->description, 0, 50) . "...",
                    'status' => $issue->status == 1 ? 'Resolved' : 'Pending',
                    'email' => $issue->email
                ];
            }
        }

        $this->view('admin/admin',[
            'notifications' => $notifications
        ]);
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
