<?php
class GenerateReports
{
    use Controller;

    private $reportModel;

    public function __construct()
    {
        $this->reportModel = new GenerateReportsModel();
    }

    // Main method to display the generate reports page
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
        if ($_SESSION['role_id'] != 2) { // Assuming role_id 2 is for Sales Manager
            redirect('login');
        }

        // Handle form submission for generating reports
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $reportType = $_POST['reportType'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];

            // Fetch report data based on type
            switch ($reportType) {
                case 'sales':
                    $reportData = $this->reportModel->getSalesReport($startDate, $endDate);
                    break;
                case 'discounts':
                    $reportData = $this->reportModel->getDiscountsReport($startDate, $endDate);
                    break;
                case 'adsbanners':
                    $reportData = $this->reportModel->getAdsBannersReport($startDate, $endDate);
                    break;
                case 'polythene_collection':
                    $reportData = $this->reportModel->getPolytheneCollectionReport($startDate, $endDate);
                    break;
                case 'returned_items':
                    $reportData = $this->reportModel->getReturnedItemsReport($startDate, $endDate);
                    break;
                case 'carbon_footprint':
                    $reportData = $this->reportModel->getCarbonFootprintReport($startDate, $endDate);
                    break;
                default:
                    $reportData = [];
            }

            // Pass data to the view
            $this->view('salesManager/generateReports', [
                'reportData' => $reportData,
                'reportType' => $reportType,
                'startDate' => $startDate,
                'endDate' => $endDate
            ]);
            return;
        }

        // Default view without report data
        $this->view('salesManager/generateReports', []);
    }
}