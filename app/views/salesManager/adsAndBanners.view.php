<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/adsAndBanners.css" />
    <title>Ads/Banners</title>
</head>

<body>

    <?php
    if (isset($_SESSION['user_id'])) {
        $profileLink = ROOT . '/profile';
    } else {
        $profileLink = ROOT . '/login';
    }
    ?>
    <nav id="sidebar">
        <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
            <img src="<?= ROOT ?>/assets/images/menu.svg" alt="menu" />
        </button>
        <div class="sidebar-container">
            <div class="prof-picture">
                <img src="<?= ROOT ?>/assets/images/profile-circle.svg" alt="profile" />
            </div>
            <div>
                <span class="user-title">Sales and Marketing Manager</span>
            </div>

            <div>
                <ul>
                    <li>
                        <a href="<?= ROOT ?>/salesManagerHome">
                            <img src="<?= ROOT ?>/assets/images/dashboard.svg" alt="dashboard" />
                            <span class="sidebar-titles">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/carbonFootprint">
                            <img src="<?= ROOT ?>/assets/images/carbon-footprint.svg" alt="carbon footprint" />
                            <span class="sidebar-titles">Carbon Footprint</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/discounts">
                            <img src="<?= ROOT ?>/assets/images/discount.svg" alt="discounts" />
                            <span class="sidebar-titles">Discounts</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/products">
                            <img src="<?= ROOT ?>/assets/images/product.svg" alt="products" />
                            <span class="sidebar-titles">Products</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/adsAndBanners" class="sidebar-active">
                            <img src="<?= ROOT ?>/assets/images/ads.svg" alt="ads/banners" />
                            <span class="sidebar-titles">Ads/Banners</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/generateReports">
                            <img src="<?= ROOT ?>/assets/images/report.svg" alt="reports" />
                            <span class="sidebar-titles">Generate Reports</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <header>
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="Waste360" />
                <h1>Waste360</h1>
            </div>
            <div class="page-title">
                <p>Ads/Banners</p>
            </div>
            <nav class="header-nav">
                <a href="#"><img src="<?= ROOT ?>/assets/images/notifications.svg" alt="" /></a>
                <a href="#">Profile</a>
                <a href="#">Log Out</a>
            </nav>
        </header>

        <div id="ad-management" class="form-container">
            <h2>Ad/Banner Management</h2>

            <!-- Ad Form Section -->
            <div id="adForm" class="input-container">
                <form id="adFormContent">
                    <div class="form-group">
                        <label>Title:
                            <input type="text" id="adTitle" placeholder="Ad Title" required />
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Description:
                            <textarea id="adDescription" placeholder="Ad Description" required></textarea>
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Target Audience:
                            <input type="text" id="adAudience" placeholder="E.g., Customers, Teens, Professionals"
                                required />
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Display Settings:
                            <input type="text" id="adSettings" placeholder="E.g., Homepage, Sidebar, Banner" required />
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Upload Banner File:
                            <input type="file" id="adFile" accept="image/*" required />
                        </label>
                    </div>
                    <button type="submit" class="action-btn">Save & Preview</button>
                </form>
            </div>

            <!-- Existing Ads Section -->
            <div id="adTableSection" class="table-container">
                <div class="table-title">
                    <h3>Existing Ads/Banners</h3>
                </div>
                <table id="adTable">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Target Audience</th>
                            <th>Display Settings</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows dynamically added -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- <footer>
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="Waste360" />
            </div>
            <p>&copy; 2024 Waste360. All rights reserved.</p>
        </footer> -->
    </main>
    <script src="<?= ROOT ?>/assets/js/salesManager/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/salesManager/adsAndBanners.js"></script>
</body>

</html>