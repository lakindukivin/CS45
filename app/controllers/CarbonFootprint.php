<?php

class CarbonFootprint
{
    use Controller;

    public function index()
    {
        // // Redirect to login if the user is not logged in
        // if (!isset($_SESSION['user_id'])) {
        //     redirect('login');
        // }

        // Load the CarbonFootprintModel
        $carbonFootprintModel = new CarbonFootprintModel();

        // Calculate and save the monthly carbon footprint
        $carbonFootprintModel->calculateAndSaveMonthlyCarbonFootprint();

        // Fetch the current carbon footprint data
        $data = $carbonFootprintModel->getCurrentCarbonFootprint();

        // Pass the data to the view
        $this->view('salesManager/carbonFootprint', $data);
    }
}