<?php
class Schedule {
    use Controller;
    private $scheduleModel;

    public function __construct() {
        $this->scheduleModel = new ScheduleModel();
    }

    public function index() {
        $data = [];
        // Load existing schedules from database
        $data['schedules'] = $this->scheduleModel->findAll('collection_date');
        $data['success'] = $_SESSION['success'] ?? '';
        $data['error'] = $_SESSION['error'] ?? '';
        unset($_SESSION['success'], $_SESSION['error']);
        $this->view('productionManager/schedule', $data);
    }

    public function addSchedule() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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