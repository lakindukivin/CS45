<?php

/**
 * ads and banners class
 */

class AdsAndBanners
{
    use Controller;

    private $AdsAndBannersModel;

    public function __construct()
    {
        $this->AdsAndBannersModel = new AdsAndBannersModel();
    }
    public function index()
    { // Ensure session is active
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
        $limit = 5;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        if ($search !== '') {
            $adsAndBanners = $this->AdsAndBannersModel->searchAds($search, $limit, $offset);
            $totaladsAndBanners = $this->AdsAndBannersModel->searchAdsCount($search);
        } else {
            $adsAndBanners = $this->AdsAndBannersModel->getAdsPaginated($limit, $offset);
            $totaladsAndBanners = $this->AdsAndBannersModel->getAdsCount();
        }
        $totalPages = ceil($totaladsAndBanners / $limit);

        $this->view('salesManager/adsAndBanners', [
            'adsAndBanners' => $adsAndBanners,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'search' => $search,
        ]);
    }

    //Get single ad/banner 
    public function getSingleAd()
    {

        if (isset($_POST['adId'])) {
            $model = new AdsAndBannersModel();
            $singleAd = $model->findById($_POST['adId']);
            echo json_encode($singleAd);
            exit;
        }

    }

    // Add ad/banner

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [

                'title' => $_POST['title'],
                'image' => $_POST['adImage'],
                'description' => $_POST['description'],
                'start_date' => $_POST['startDate'],
                'end_date' => $_POST['endDate'],
                'status' => 1
            ];


            if ($this->AdsAndBannersModel->addAdsAndBanners($data)) {
                $_SESSION['success'] = "Successfully Added!";
                header("Location: " . ROOT . "/adsAndBanners");
                exit();
            }
        }
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['adId'])) {
                $data = [

                    'ad_id' => $_POST['adId'],
                    'title' => $_POST['title'],
                    'image' => $_POST['adImage'],
                    'description' => $_POST['description'],
                    'start_date' => $_POST['startDate'],
                    'end_date' => $_POST['endDate'],
                    'status'=> $_POST['status']
                ];

                if ($this->AdsAndBannersModel->editAdsAndBanners($_POST['adId'], $data)) {
                    $_SESSION['success'] = "Successfully updated!";
                    header("Location: " . ROOT . "/adsAndBanners");
                    exit();
                }

            }
        }
    }

    public function delete()
    {

        if (isset($_POST['adId'])) {

            if ($this->AdsAndBannersModel->deleteAdsAndBanners($_POST['adId'])) {
                $_SESSION['success'] = "Successfully deleted!";
                header("Location: " . ROOT . "/adsAndBanners");
                exit();
            }
        }


    }
}