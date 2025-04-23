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

            $imagePath = '';
            if (isset($_FILES['adImage']) && $_FILES['adImage']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/adsAndBanners/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = uniqid() . '_' . basename($_FILES['adImage']['name']);
                $targetFile = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES['adImage']['tmp_name'], $targetFile)) {
                    $imagePath = '/' . $targetFile; // Save relative path
                }
            }

            $data = [

                'title' => $_POST['title'],
                'image' => $imagePath,
                'description' => $_POST['description'],
                'start_date' => $_POST['startDate'],
                'end_date' => $_POST['endDate'],
                'status' => 1
            ];


            if ($this->AdsAndBannersModel->addAdsAndBanners($data)) {
                $_SESSION['success'] = "Successfully Added!";
                header("Location: " . ROOT . "/adsAndBanners");
                exit();
            }else {
                $_SESSION['error'] = "Failed to add ad/banner!";
                header("Location: " . ROOT . "/adsAndBanners");
                exit();
            }
        }
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['editAdId'])) {

                $imagePath = $_POST['existingImagePath'] ?? '';
                if (isset($_FILES['editAdImage']) && $_FILES['editAdImage']['error'] == UPLOAD_ERR_OK) {
                    $uploadDir = 'uploads/adsAndBanners/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $fileName = uniqid() . '_' . basename($_FILES['editAdImage']['name']);
                    $targetFile = $uploadDir . $fileName;
                    if (move_uploaded_file($_FILES['editAdImage']['tmp_name'], $targetFile)) {
                        $imagePath = '/' . $targetFile;
                    }
                }
                $data = [

                    'ad_id' => $_POST['editAdId'],
                    'title' => $_POST['editAdTitle'],
                    'image' => $imagePath,
                    'description' => $_POST['editAdDescription'],
                    'start_date' => $_POST['editAdStartDate'],
                    'end_date' => $_POST['editAdEndDate'],
                    'status' => $_POST['editStatus']
                ];

                if ($this->AdsAndBannersModel->editAdsAndBanners($_POST['editAdId'], $data)) {
                    $_SESSION['success'] = "Successfully updated!";
                    header("Location: " . ROOT . "/adsAndBanners");
                    exit();
                }else {
                    $_SESSION['error'] = "Failed to update ad/banner!";
                    header("Location: " . ROOT . "/adsAndBanners");
                    exit();
                }

            }
        }
    }

    public function delete()
    {

        if (isset($_POST['deleteAdId'])) {

            if ($this->AdsAndBannersModel->deleteAdsAndBanners($_POST['deleteAdId'])) {
                $_SESSION['success'] = "Successfully deleted!";
                header("Location: " . ROOT . "/adsAndBanners");
                exit();
            }else{
                $_SESSION['error'] = "Failed to delete ad/banner!";
                header("Location: " . ROOT . "/adsAndBanners");
                exit();
            }
        }


    }

    public function setActive()
    {
        if (isset($_GET['ad_id'])) {
            if ($this->AdsAndBannersModel->setActive($_GET['ad_id'])) {
                $_SESSION['success'] = "Successfully activated!";
                header("Location: " . ROOT . "/adsAndBanners");
                exit();
            } else {
                $_SESSION['error'] = "Failed to activate product!";
                header("Location: " . ROOT . "/adsAndBanners");
                exit();
            }
        }

    }

    public function setInactive()
    {
        if (isset($_GET['ad_id'])) {
            if ($this->AdsAndBannersModel->setInactive($_GET['ad_id'])) {
                $_SESSION['success'] = "Successfully deactivated!";
                header("Location: " . ROOT . "/adsAndBanners");
                exit();
            } else {
                $_SESSION['error'] = "Failed to deactivate product!";
                header("Location: " . ROOT . "/adsAndBanners");
                exit();
            }
        }

    }

    
}