<?php

class CarbonFootprint
{
    use Controller;

    private $carbonFootprintModel;

    public function __construct()
    {
        $this->carbonFootprintModel = new CarbonFootprintModel();
    }
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Redirect to login if user is not authenticated
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
        }

        // Check if the user has the right role to access this page
        if ($_SESSION['role_id'] != 2) {
            redirect('login');
        }

        // Pagination setup
        $limit = 10;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        if ($search !== '') {
            $carbonFootprint = $this->carbonFootprintModel->searchCarbonFootprint($search, $limit, $offset);
            $totalcarbonFootprint = $this->carbonFootprintModel->searchCarbonFootprintCount($search);
        } else {
            $carbonFootprint = $this->carbonFootprintModel->getCarbonFootprintPaginated($limit, $offset);
            $totalcarbonFootprint = $this->carbonFootprintModel->getCarbonFootprintCount();
        }
        $totalPages = ceil($totalcarbonFootprint / $limit);

        $this->view('salesManager/carbonFootprint', [
            'carbonFootprints' => $carbonFootprint,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'search' => $search,
        ]);
    }
        

        // Pass the data to the view
       
}