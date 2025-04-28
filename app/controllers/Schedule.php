<?php
class Schedule {
    use Controller;
    private $scheduleModel;

    private $validAreas = [
        'Colombo', 'Dehiwala-Mount Lavinia', 'Moratuwa',
        'Sri Jayawardenepura Kotte', 'Negombo', 'Wattala',
        'Kaduwela', 'Kolonnawa', 'Kesbewa', 'Maharagama',
        'Kotikawatta', 'Homagama', 'Piliyandala', 'Nugegoda',
        'Boralesgamuwa', 'Ratmalana', 'Avissawella', 'Panadura', 'Kalutara'
    ];
    public function __construct() {
        $this->scheduleModel = new ScheduleModel();
    }

    public function index() {
        $data = [];

        // Pagination setup
        $page = $_GET['page'] ?? 1;
        $limit = 10; // Number of items per page
        $offset = ($page - 1) * $limit;
        $totalSchedules = $this->scheduleModel->query("SELECT COUNT(*) as count FROM polythenecollection")[0]->count;

        $data['schedules'] = $this->scheduleModel->query(
            "SELECT * FROM polythenecollection 
             ORDER BY collection_date DESC, collection_time DESC LIMIT $limit OFFSET $offset"
        );

        $data['currentPage'] = $page;
        $data['totalPages'] = ceil($totalSchedules / $limit);
        $data['success'] = $_SESSION['success'] ?? '';
        $data['error'] = $_SESSION['error'] ?? '';
        $data['validAreas'] = $this->validAreas; // Pass to view for dropdown
        
        unset($_SESSION['success'], $_SESSION['error']);
        $this->view('productionManager/schedule', $data);
    }

    public function addSchedule() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate area is in our allowed list
            if (!in_array($_POST['area'], $this->validAreas)) {
                $_SESSION['error'] = "Invalid area selected";
                redirect('schedule');
                return;
            }

            $data = [
                'area' => $_POST['area'],
                'collection_date' => $_POST['date'], // Map to correct column
                'collection_time' => $_POST['time']   // Map to correct column
            ];
            
            if ($this->scheduleModel->insert($data)) {
                $_SESSION['success'] = "Schedule added successfully";
            } else {
                $_SESSION['error'] = "Failed to add schedule";
            }
            
            redirect('schedule');
        }
    }
}